<?php

namespace Wpae\App\Field;


class ImageLink extends Field
{
    const SECTION = 'basicInformation';

    public function getValue($snippetData)
    {
        $basicInformationData = $this->feed->getSectionFeedData(self::SECTION);

        if($basicInformationData['itemImageLink'] == self::CUSTOM_VALUE_TEXT) {
            return $this->replaceSnippetsInValue($basicInformationData['itemImageLinkCV'], $snippetData);
        } else {
            if (has_post_thumbnail($this->entry->ID)) {
                $image = $this->getImage($this->entry);

                return $image;
            }

            if($this->entry->post_type == 'product_variation') {
                if($basicInformationData['useVariationImage']) {
                    $variationImage = $this->getImage($this->entry);
                    if(empty($variationImage)) {
                        $variationImage = $this->getImage($this->entry->post_parent);
                        return $variationImage;
                    }
                } else {
                    return $this->getImage($this->entry->post_parent);
                }
            }
        }

        return '';
    }

    public function getFieldName()
    {
        return 'image_link';
    }

    /**
     * @param $entry
     * @return mixed
     */
    private function getImage($entry)
    {
        return wp_get_attachment_url(get_post_thumbnail_id($entry->ID), 'single-post-thumbnail');
    }

}