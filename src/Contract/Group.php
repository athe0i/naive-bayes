<?php
namespace Athe0i\NaiveBayes\Contract;

/*
 * This means "Class" in Bayesian methods, though to avoid confusion rename it
 */

use Athe0i\NaiveBayes\Common\ParameterBag;

/**
 * Represent the Group(class)
 * @package Athe0i\NaiveBayes\Contract
 */
interface Group
{
    /**
     * @param KnowledgeBase $knowledgeBase
     * @return void
     */
    public function setKnowledgeBase(KnowledgeBase $knowledgeBase);

    /**
     * @return KnowledgeBase
     */
    public function getKnowledgeBase();

    /**
     * @param ParameterBag $parameterBag
     * @return float
     */
    public function getEstimation(ParameterBag $parameterBag);

    /**
     * @return float
     */
    public function getGroupPrior();
}
