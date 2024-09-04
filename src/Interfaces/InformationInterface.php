<?php

namespace Iqbalatma\TemplateReplacement\Interfaces;

interface InformationInterface
{
    public function __construct(array $methodParams = []);
    public function getParameter(string $key):mixed;
}
