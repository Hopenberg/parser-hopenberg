<?php

namespace Parser\SiteElement;

use DOMDocument;

class NteSiteElement implements SiteElement
{
    private DOMDocument $domDoc;
    private int $order = 6;

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
        $nte = $this->domDoc->getElementById('nte');
        $nteValue = $nte->nodeValue;
        return [floatval(filter_var($nteValue, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION))];
    }

    public function extractTitle(): array
    {
        return ['NTE'];
    }
}