<?php

namespace Iqbalatma\TemplateReplacement\Abstracts;

use Iqbalatma\TemplateReplacement\Interfaces\InformationInterface;
use Iqbalatma\TemplateReplacement\Traits\HasInformation;

abstract class BaseInformation implements InformationInterface
{
    use HasInformation;
    public function __construct(array $methodParams = [])
    {
        $this->methodParams = $methodParams;
    }
}
