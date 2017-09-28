<?php

namespace Wpae\App\Feed;


class Feed
{
    private $feedData;

    public function __construct($feedData)
    {
        $this->feedData = $feedData;
    }

    public function getFeedData()
    {
        return $this->feedData;
    }

    public function getSectionFeedData($section)
    {
        if(isset($this->feedData[$section])) {
            return $this->feedData[$section];
        } else {
            throw new \Exception('Unknown feed section '.$section);
        }
    }
}