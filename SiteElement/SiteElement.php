<?php

namespace Parser\SiteElement;

interface SiteElement
{
    public function extractValue(): array;
    public function extractTitle(): array;
    public function getOrder(): int;
}