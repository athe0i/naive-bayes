<?php
namespace Athe0i\NaiveBayes\Contract;

use Athe0i\NaiveBayes\Common\ParameterBag;

/**
 * Represents some Sample to be classified
 * @package Athe0i\NaiveBayes\Contract
 */
interface Sample
{
    /**
     * @return ParameterBag
     */
    public function getParametersBag();


    /**
     * Set parameters of the sample
     * @param ParameterBag $parameterBag
     * @return void
     */
    public function setParametersBag(ParameterBag $parameterBag);
}
