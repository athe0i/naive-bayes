<?php
namespace Athe0i\NaiveBayes\Generic;

use Athe0i\NaiveBayes\Contract\Group;
use Athe0i\NaiveBayes\Contract\KnowledgeBase;
use Athe0i\NaiveBayes\Contract\Parameter;

class ArrayKnowledgeBase implements KnowledgeBase
{
    protected $data;
    protected $group;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getParameterEstimate(Parameter $parameter, $groupId)
    {
        if (!isset($this->data[$groupId]['params'][$parameter->getId()][$parameter->getValue()]))
            return false;

        return $this->data[$groupId]['params'][$parameter->getId()][$parameter->getValue()];
    }

    public function getGroupPrior($id)
    {
        return $this->data[$id]['prior'];
    }
}
