<?php

namespace Wpae\App\Service;

use Wpae\App\Feed\Feed;
use Wpae\App\Field\FieldFactory;
use Wpae\WordPress\Filters;
use XmlExportEngine;

class GoogleMerchantsDataProcessor
{

    public $exportFieldSlugs = array(
        
        'id',
        'title',
        'description',
        'link',
        'image_link',
        'additional_image_link',
        'availability',
        'availability_date',
        'sale_price_effective_date',
        'price',
        'sale_price',
        'product_type',
        'google_product_category',
        'brand',
        'gtin',
        'mpn',
        'identifier_exists',
        'condition',
        'is_bundle',
        'age_group',
        'color',
        'gender',
        'material',
        'pattern',
        'size',
        'item_group_id',
        'shipping',
        'size_type',
        'size_system',
        'shipping_label',
        'adult',
        'multipack',
        'mobile_link',
        'custom_label_0',
        'custom_label_1',
        'custom_label_2',
        'custom_label_3',
        'custom_label_4',
        'unit_pricing_measure',
        'unit_pricing_base_measure',
        'expiration_date',
        'energy_efficiency_class',
        'promotion_id',
        'adwords_redirect'
    );

    /**
     * @var Filters
     */
    private $filters;

    /**
     * @var FieldFactory
     */
    private $fieldFactory;

    private $snippets;

    /**
     * @var Feed
     */
    private $feed;

    public function __construct(Filters $filters, FieldFactory $fieldFactory, Feed $feed)
    {
        $this->filters = $filters;
        $this->fieldFactory = $fieldFactory;

        $snippets = XmlExportEngine::$exportOptions['snippets'];

        $engine = new XmlExportEngine(XmlExportEngine::$exportOptions);
        $engine->init_available_data();
        $engine->init_additional_data();
        $this->snippets = $engine->get_fields_options($snippets);
        $this->feed = $feed;

        $uniqueIdentifiers = $this->feed->getSectionFeedData('uniqueIdentifiers');
        $advancedAttributes = $this->feed->getSectionFeedData('advancedAttributes');

        if(empty($uniqueIdentifiers['brand'])) {
            $this->removeField('brand');
        }

        if(empty($uniqueIdentifiers['gtin'])) {
            $this->removeField('gtin');
        }

        if(empty($uniqueIdentifiers['mpn'])) {
            $this->removeField('mpn');
        }

        if(empty($advancedAttributes['unitPricingBaseMeasure'])) {
            $this->removeField('unit_pricing_base_measure');
        }

    }

    public function processData($entry)
    {
        $article = array();
        $woo = array();
        $woo_order = array();
        $implode_delimiter = "\t";

        $articleData = \XmlExportCpt::prepare_data($entry, $this->snippets, array(), $woo, $woo_order, $implode_delimiter, false, false);

        XmlExportEngine::$exportOptions['ids'] = $this->exportFieldSlugs;
        XmlExportEngine::$exportOptions['cc_type'] = $this->exportFieldSlugs;
        XmlExportEngine::$exportOptions['cc_name'] = $this->exportFieldSlugs;

        foreach (XmlExportEngine::$exportOptions['cc_name'] as $ID => $value) {

            $fieldName = XmlExportEngine::$exportOptions['cc_name'][$ID];
            $fieldType = XmlExportEngine::$exportOptions['cc_type'][$ID];

            if (empty($fieldName) || empty($fieldType) || !is_numeric($ID)) {
                continue;
            }

            $field = $this->fieldFactory->createField($fieldType, $entry);
            $value = $field->getFieldValue($articleData);
            
            $val = $this->filters->applyFilters($field->getFieldFilter(), array($value));
            wp_all_export_write_article($article, $field->getFieldName(), $val);
        }

        return $article;
    }

    private function removeField($fieldName)
    {
        $this->exportFieldSlugs = array_diff($this->exportFieldSlugs, array($fieldName));
    }
}