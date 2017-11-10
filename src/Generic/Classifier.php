<?php
namespace Athe0i\NaiveBayes\Generic;

use Athe0i\NaiveBayes\Common\GroupBag;
use Athe0i\NaiveBayes\Contract\Classifier as ClassifierContract;
use Athe0i\NaiveBayes\Contract\Sample;

/**
 * Implementation of the simple bayesian classifier. Mostly we assume here that algorithm already
 * learned on training data and we can ask KnowledgeBase  about estimates for the params or group priors.
 *
 * Although possibility to make it dynamic (aka learning on fly) remains, but should be resolved in KnowledgeBase.
 *
 * @package Athe0i\NaiveBayes\Generic
 */
class Classifier implements ClassifierContract
{
    /**
     * @var GroupBag
     */
    protected $groupBag;


    /**
     * Classifier constructor.
     * @param GroupBag $groupBag
     */
    public function __construct(GroupBag $groupBag)
    {
        $this->groupBag = $groupBag;
    }

    /**
     * @return GroupBag
     */
    public function getGroupBag()
    {
        return $this->groupBag;
    }

    /**
     * @param GroupBag $groupBag
     */
    public function setGroupBag(GroupBag $groupBag)
    {
        $this->groupBag = $groupBag;
    }


    /**
     * @param Sample $sample
     * @return mixed|null
     */
    public function classify(Sample $sample)
    {
        $currentMax = 0;
        $winnerGroup = null;

        // first get group estimations
        foreach ($this->getGroupBag() as $group) {
            $estimate = $group->getEstimation($sample->getParametersBag());

            //echo "winner estimate: $estimate ";
            if ($estimate >= $currentMax) {
                $winnerGroup = $group;
                $currentMax = $estimate;
            }
        }
        return $winnerGroup;
    }
}
