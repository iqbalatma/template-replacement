<?php

namespace Iqbalatma\TemplateReplacement\Traits;

use Iqbalatma\TemplateReplacement\Exceptions\MissingRequiredParameterException;

trait HasInformation
{
    protected array $methodParams;

    /**
     * @param string $key
     * @return mixed
     * @throws MissingRequiredParameterException
     */
    public function getParameter(string $key): mixed
    {
        if (isset($this->methodParams[$key])) {
            return $this->methodParams[$key];
        }

        throw new MissingRequiredParameterException("Missing required parameter key $key on ". __FUNCTION__. " from " . __CLASS__);
    }
}
