<?php
namespace Athe0i\NaiveBayes\Generic;

use Athe0i\NaiveBayes\Contract\Parameter as ParameterContract;

class Parameter implements ParameterContract
{

    protected $id;
    protected $value;

    public function __construct($id, $value)
    {
        $this->id = $id;
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getId()
    {
        return $this->id;
    }
}
