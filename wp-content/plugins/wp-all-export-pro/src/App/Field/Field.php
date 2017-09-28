<?php


namespace Wpae\App\Field;


use Wpae\App\Feed\Feed;
use Wpae\WordPress\Filters;

abstract class Field
{
    const CUSTOM_VALUE_TEXT = 'customValue';

    const SELECT_FROM_WOOCOMMERCE_PRODUCT_ATTRIBUTES = 'selectFromWooCommerceProductAttributes';

    protected $entry;
    
    /**
     * @var Filters
     */
    private $filters;
    
    /**
     * @var Feed
     */
    protected $feed;

    public function __construct($entry, Filters $filters, Feed $feed)
    {
        $this->entry = $entry;
        $this->filters = $filters;
        $this->feed = $feed;
    }

    public function getFieldValue($snippetData)
    {
        return strip_tags($this->getValue($snippetData));
    }

    public function getFieldFilter()
    {
        return 'pmxe_'.$this->getFieldName();
    }

    protected function isCustomValue($value)
    {
        return $value == self::CUSTOM_VALUE_TEXT;
    }

    protected function replaceSnippetsInValue($value, $snippets) {


        foreach ($snippets as $key => $fieldValue) {
            if($key == 'id') {
                $key = 'ID';
            }

            $fieldKey = '{' . $key . '}';

            $value = str_replace($fieldKey, $fieldValue, $value);
        }

        // Replace strong tags used on the frontend
        $value = str_replace(array('<strong>', '</strong>'), '', $value);

        foreach(\XmlExportEngine::$exportOptions['snippets'] as $snippet) {
            $value = str_replace('{' . $snippet . '}','', $value);
        }


        return $value;
    }


    /**
     * @param array $mappings
     * @param string $value
     * @return string
     */
    protected function replaceMappings($mappings, $value)
    {
        foreach ($mappings as $mapping) {
            if (isset($mapping['mapFrom']) && isset($mapping['mapTo'])) {
                $value = str_replace($mapping['mapFrom'], $mapping['mapTo'], $value);
            }
        }
        return $value;
    }

    abstract function getFieldName();

    abstract function getValue($snippetData);
}