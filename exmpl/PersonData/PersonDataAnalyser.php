<?php
namespace Athe0i\NaiveBayes\Example\PersonData;

use Athe0i\NaiveBayes\Contract\Analyser;
use Athe0i\NaiveBayes\Contract\Classifier;
use Athe0i\NaiveBayes\Contract\DataSource;
use Athe0i\NaiveBayes\Generic\Sample;

class PersonDataAnalyser implements Analyser
{
    public function analyse(Classifier $classifier, array $rawData)
    {
        $tp = 0;
        $tn = 0;
        $fp = 0;
        $fn = 0;

        echo "######### starting analyse #######\n";

        foreach ($rawData as $parsed) {
            $sample = new Sample($parsed);
            $group = $classifier->classify($sample);

            //echo "predict: {$group->getId()} actual: {$parsed['group']} \n";

            if ($group->getId() == $parsed['group'] && $group->getId() == 'gt_50_k') {
                $tp++;
            } else if ($group->getId() == $parsed['group'] && $group->getId() == 'lt_eq_50_k') {
                $fn++;
            } else if ($group->getId() != $parsed['group'] && $group->getId() == 'gt_50_k') {
                $fp++;
            } else if ($group->getId() != $parsed['group'] && $group->getId() == 'lt_eq_50_k') {
                $tn++;
            }
        }

        echo "true-positive: $tp; true-negative: $tn;\nfalse-positive: $fp; false-negative: $fn\n";
    }
}
