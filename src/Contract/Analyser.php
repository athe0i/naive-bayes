<?php
namespace Athe0i\NaiveBayes\Contract;

interface Analyser
{
    public function analyse(Classifier $classifier, array $data);
}
