<?php

namespace Parser\SiteElement;

class SiteElementManager
{
    static SiteElementManager $sem;

    private array $siteElements;

    public static function getInstance(): SiteElementManager {
        if (isset($sem)) {
            return $sem;
        } else {
            self::$sem = new SiteElementManager();
            return self::$sem;
        }
    }

    private function __construct()
    {
    }

    public function register(SiteElement $siteElement): void {
        $this->siteElements[] = $siteElement;
        usort($this->siteElements, fn($a, $b) => $a->getOrder() <=> $b->getOrder());
    }

    public function remove(string $siteElement): void {
        $indexToDelete = -1;
        foreach ($this->siteElements as $i => $element) {
            if ($element instanceof $siteElement) {
                $indexToDelete = $i;
                break;
            }
        }
        if ($indexToDelete >= 0) {
            unset($this->siteElements[$indexToDelete]);
        }
    }

    public function getSiteElements(): array {
        return $this->siteElements;
    }
}