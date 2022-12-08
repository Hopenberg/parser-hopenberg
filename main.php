<?php

require_once __DIR__ . '/vendor/autoload.php';

use Parser\SiteElement\LocationAddressSiteElement;
use Parser\SiteElement\LocationCustomerSiteElement;
use Parser\SiteElement\LocationNameSiteElement;
use Parser\SiteElement\LocationPhoneSiteElement;
use Parser\SiteElement\NteSiteElement;
use Parser\SiteElement\PoNumberSiteElement;
use Parser\SiteElement\ScheduledDateSiteElement;
use Parser\SiteElement\SiteElementManager;
use Parser\SiteElement\TradeSiteElement;
use Parser\SiteElement\WoNumberSiteElement;

$file = file_get_contents('wo_for_parse.html');

$domDoc = new DOMDocument();
$domDoc->loadHTML($file);

$sem = SiteElementManager::getInstance();
$sem->register(new LocationAddressSiteElement($domDoc));
$sem->register(new LocationPhoneSiteElement($domDoc));
$sem->register(new LocationNameSiteElement($domDoc));
$sem->register(new LocationCustomerSiteElement($domDoc));
$sem->register(new NteSiteElement($domDoc));
$sem->register(new PoNumberSiteElement($domDoc));
$sem->register(new ScheduledDateSiteElement($domDoc));
$sem->register(new TradeSiteElement($domDoc));
$sem->register(new WoNumberSiteElement($domDoc));

$list = [];
$titles = [];
foreach ($sem->getSiteElements() as $siteElement) {
    $result = $siteElement->extractValue();
    $resultForTitles = $siteElement->extractTitle();

    if (count($result) > 1) {
        foreach ($result as $singleItem) {
            $list[] = $singleItem;
        }
    } elseif (count($result) === 0) {
        $list[] = '';
    } else {
        $list[] = $result[0];
    }

    if (count($resultForTitles) > 1) {
        foreach ($resultForTitles as $title) {
            $titles[] = $title;
        }
    } elseif (count($resultForTitles) === 0) {
        $titles[] = '';
    } else {
        $titles[] = $resultForTitles[0];
    }
}

$fileStream = fopen('output.csv', 'w');

fputcsv($fileStream, $titles);
fputcsv($fileStream, $list);

fclose($fileStream);
