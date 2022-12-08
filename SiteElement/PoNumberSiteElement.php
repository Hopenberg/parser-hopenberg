<?php

namespace Parser\SiteElement;

use DOMDocument;

class PoNumberSiteElement implements SiteElement
{
    private DOMDocument $domDoc;
    private int $order = 2;

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
        return [$this->domDoc->getElementById('po_number')->nodeValue];
    }

    public function extractTitle(): array
    {
        return ['PO Number'];
    }
}