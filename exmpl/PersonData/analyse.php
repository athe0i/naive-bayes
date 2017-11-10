<?php
require('../../vendor/autoload.php');

function main() {
    $teacher = new \Athe0i\NaiveBayes\Example\PersonData\PersonDataTeacher();
    $dataSource = new \Athe0i\NaiveBayes\Example\PersonData\Parser();
    $knowledgeBase = $teacher->getKnowledge($dataSource);

    $groupBag = new \Athe0i\NaiveBayes\Common\GroupBag([
        new \Athe0i\NaiveBayes\Generic\Group('gt_50_k', $knowledgeBase),
        new \Athe0i\NaiveBayes\Generic\Group('lt_eq_50_k', $knowledgeBase),
    ]);

    $classifier = new \Athe0i\NaiveBayes\Generic\Classifier($groupBag);

    $analyser = new \Athe0i\NaiveBayes\Example\PersonData\PersonDataAnalyser();

    $rawData = $dataSource->parse(__DIR__ . '/pers_data.txt', 10000);
    $analyser->analyse($classifier, $rawData);
}

main();
