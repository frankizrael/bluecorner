<?php

namespace Wpae\App\Field;


class ShippingLabel extends Field
{
    const SECTION = 'shipping';
    
    public function getValue($snippetData)
    {
        $shippingData = $this->feed->getSectionFeedData(self::SECTION);

        return $this->replaceSnippetsInValue($shippingData['shippingLabel'], $snippetData);
    }

    public function getFieldName()
    {
        return 'shipping_label';
    }
}