<?php

namespace Parser\SiteElement;

use DOMDocument;

class LocationNameSiteElement implements SiteElement
{
    private DOMDocument $domDoc;
    private int $order = 7;

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
        return [$this->domDoc->getElementById('location_name')->nodeValue];
    }

    public function extractTitle(): array
    {
        return ['Store ID'];
    }
}