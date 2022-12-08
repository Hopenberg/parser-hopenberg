<?php

namespace Parser\SiteElement;

use DOMDocument;

class LocationPhoneSiteElement implements SiteElement
{
    private DOMDocument $domDoc;
    private int $order = 9;

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    public function __construct(DOMDocument $domDoc)
    {
        $this->domDoc = $domDoc;
    }

    public function extractValue(): array
    {
        $locationPhone = $this->domDoc->getElementById('location_phone');
        $phoneValue = $locationPhone->nodeValue;
        return [floatval(str_replace('-', '', $phoneValue))];
    }

    public function extractTitle(): array
    {
        return ['Phone'];
    }
}