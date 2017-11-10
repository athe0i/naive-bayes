<?php
namespace Athe0i\NaiveBayes\Contract;


/**
 * Bridge to the info learned before
 * @package Athe0i\NaiveBayes\Contract
 */
interface KnowledgeBase
{
    /**
     * Get parameters estimates
     *
     * @param Parameter $parameter
     * @return float
     */
    public function getParameterEstimate(Parameter $parameter, $groupId);

    /**
     * Get prior of the current group
     *
     * @param $groupId mixed
     * @return float
     */
    public function getGroupPrior($groupId);
}
