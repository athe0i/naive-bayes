<?php
namespace Athe0i\NaiveBayes\Generic;

use Athe0i\NaiveBayes\Common\ParameterBag;
use Athe0i\NaiveBayes\Contract\Group as GroupContract;
use Athe0i\NaiveBayes\Contract\KnowledgeBase;

class Group implements GroupContract
{
    protected $id;
    protected $knowledgeBase;
    protected $groupPrior;

    public function __construct($id, KnowledgeBase $knowledgeBase)
    {
        $this->id = $id;
        $this->setKnowledgeBase($knowledgeBase);
    }

    public function setKnowledgeBase(KnowledgeBase $knowledgeBase)
    {
        $this->knowledgeBase = $knowledgeBase;
    }

    public function getKnowledgeBase()
    {
        return $this->knowledgeBase;
    }

    public function getEstimation(ParameterBag $parameterBag)
    {
        return 100 * $this->getGroupPrior() * $this->getParametersEstimation($parameterBag);
    }

    public function getParametersEstimation(ParameterBag $parameterBag)
    {
        // not sure this is correct approach, but after first value would be fine i guess
        $est = 1.0;
        // this could be replaced by the array_map, but again - we need to copy inner array
        foreach($parameterBag as $param) {
            if($this->getKnowledgeBase()->getParameterEstimate($param, $this->getId()) === false)
                continue;

            $est *= $this->getKnowledgeBase()->getParameterEstimate($param, $this->getId());
        }

        return $est;
    }

    public function getGroupPrior()
    {
        return $this->getKnowledgeBase()->getGroupPrior($this->getId());
    }

    public function getId()
    {
        return $this->id;
    }
}
