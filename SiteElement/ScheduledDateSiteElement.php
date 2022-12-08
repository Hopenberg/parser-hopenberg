<?php

namespace Parser\SiteElement;

use DateTime;
use DOMDocument;

class ScheduledDateSiteElement implements SiteElement
{
    private DOMDocument $domDoc;
    private int $order = 3;

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
        $dateScheduled = $this->domDoc->getElementById('scheduled_date');
        $dateScheduledValue = $dateScheduled->nodeValue;

        $sanitizedValue = trim(preg_replace('/\s+/', ' ', $dateScheduledValue));


        $dateObject = DateTime::createFromFormat('F d, Y h:i A', $sanitizedValue);
        if ($dateObject) {
            return [$dateObject->format('Y-m-d H:i')];
        } else {
            return [''];
        }
    }

    public function extractTitle(): array
    {
        return ['Scheduled'];
    }
}