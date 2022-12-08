<?php

namespace Parser\SiteElement;

use DOMDocument;

class WoNumberSiteElement implements SiteElement
{
    private DOMDocument $domDoc;
    private int $order = 1;

    public function __construct(DOMDocument $domDoc)
    {
        $this->domDoc = $domDoc;
    }

    public function extractValue(): array
    {
        return [$this->domDoc->getElementById('wo_number')->nodeValue];
    }

    public function extractTitle(): array
    {
        return ['Tracking Number'];
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }
}