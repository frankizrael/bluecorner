<?php

namespace Wpae\App\Field;


class SizeType extends Field
{
    const SECTION = 'detailedInformation';

    public function getValue($snippetData)
    {
        $detailedInformationData = $this->feed->getSectionFeedData(self::SECTION);

        $sizeType = $detailedInformationData['sizeType'];
        $sizeType = $this->replaceSnippetsInValue($sizeType, $snippetData);

        $mappings = $detailedInformationData['sizeTypeMappings'];

        $sizeType = $this->replaceMappings($mappings, $sizeType);

        return $sizeType;
    }

    public function getFieldName()
    {
        return 'size_type';
    }
}