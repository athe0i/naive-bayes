<?php
namespace Athe0i\NaiveBayes\Contract;


/**
 * Representing one of the parameters of the Group(Class)
 * @package Athe0i\NaiveBayes\Contract
 */
interface Parameter
{
    /**
     * @return mixed
     */
    public function getValue();

    public function getId();
}
