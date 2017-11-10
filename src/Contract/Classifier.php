<?php
namespace Athe0i\NaiveBayes\Contract;

use Athe0i\NaiveBayes\Common\GroupBag;

/**
 * Interface Classifier
 * @package Athe0i\NaiveBayes\Contract
 */
interface Classifier
{
    /**
     * Get collection of groups(classes)
     * @return GroupBag
     */
    public function getGroupBag();

    /**
     * Set collection of possible groups(classes)
     * @param GroupBag $groupBag
     * @return void
     */
    public function setGroupBag(GroupBag $groupBag);

    /**
     * Find the group with the most probable estimate
     * @param Sample $sample
     * @return Group
     */
    public function classify(Sample $sample);
}
