<?php

namespace Parser\SiteElement;

use DOMDocument;

class TradeSiteElement implements SiteElement
{
    private DOMDocument $domDoc;
    private int $order = 5;

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
        return [$this->domDoc->getElementById('trade')->nodeValue];
    }

    public function extractTitle(): array
    {
        return ['Trade'];
    }
}