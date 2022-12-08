<?php

namespace Parser\SiteElement;

use DOMDocument;
use DOMXPath;

class LocationAddressSiteElement implements SiteElement
{
    private DOMDocument $domDoc;
    private int $order = 8;

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
        $xpath = new DOMXPath($this->domDoc);
        $locationAddresses = $xpath->query('//a[@id="location_address"]');
        $locationAddress = $locationAddresses->item(0);
        $locationValue = $locationAddress->nodeValue;

        $matches = [];
        preg_match('/(\r\n|\r|\n)(?<street>.*)(\r\n|\r|\n).*?(?<city>[a-zA-Z]*) +(?<state>[a-zA-Z]{2}) +(?<postalCode>\d{5}).*?(\r\n|\r|\n)/m', $locationValue, $matches);

        return [
            'street' => trim($matches['street']),
            'city' => trim($matches['city']),
            'state' => trim($matches['state']),
            'postalCode' => trim($matches['postalCode'])
        ];
    }

    public function extractTitle(): array
    {
        return ['Street', 'City', 'State', 'Postal Code'];
    }
}