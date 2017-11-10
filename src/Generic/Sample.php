<?php
namespace Athe0i\NaiveBayes\Generic;

use Athe0i\NaiveBayes\Common\ParameterBag;
use Athe0i\NaiveBayes\Contract\Sample as SampleContract;

class Sample implements  SampleContract
{
    protected $parameterBag;

    public function __construct(array $plainParams)
    {
        $this->parameterBag = new ParameterBag();

        foreach ($plainParams as $paramId => $paramValue) {
            $this->parameterBag->append(new Parameter($paramId, $paramValue));
        }

    }

    public function setParametersBag(ParameterBag $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function getParametersBag()
    {
        return $this->parameterBag;
    }
}
