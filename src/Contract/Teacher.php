<?php
namespace Athe0i\NaiveBayes\Contract;

/**
 * Teacher - makes teaching stuff
 * @package Athe0i\NaiveBayes\Contract
 */
interface Teacher
{
    /**
     * @param DataSource $dataSource
     * @return KnowledgeBase
     */
    public function getKnowledge(DataSource $dataSource);
}
