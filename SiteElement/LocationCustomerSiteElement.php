<?php

namespace Parser\SiteElement;

use DOMDocument;

class LocationCustomerSiteElement implements SiteElement
{
    private DOMDocument $domDoc;
    private int $order = 4;

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
        return [$this->domDoc->getElementById('location_customer')->nodeValue];
    }

    public function extractTitle(): array
    {
        return ['Customer'];
    }
}