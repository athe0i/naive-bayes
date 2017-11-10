<?php
namespace Athe0i\NaiveBayes\Example\PersonData;


use Athe0i\NaiveBayes\Contract\DataSource;
use Athe0i\NaiveBayes\Contract\Teacher;
use Athe0i\NaiveBayes\Generic\ArrayKnowledgeBase;

class PersonDataTeacher implements Teacher
{

    public function getKnowledge(DataSource $parser)
    {
        $rawData = $parser->parse(__DIR__ . '/pers_data.txt', 1000);

        return $this->loadKnowledgeBase($rawData);
    }

    public function loadKnowledgeBase(
        $raw,
        array $params = [
            'age',
            'race',
            'sex',
            'occupation',
            'education',
            'relationship',
            'native-country'
        ])
    {

        $data = $this->buildData($raw, $params);

        return new ArrayKnowledgeBase($data);
    }


    public function buildData($raw, $params)
    {
        $data = [
            'gt_50_k' => [
                'total' => 0,
                'params' => []
            ],
            'lt_eq_50_k' => [
                'total' => 0,
                'params' => []
            ]
        ];

        //first lets count how namy times all values in each class
        foreach ($raw as $item) {
            $data[$item['group']]['total'] += 1;

            foreach ($params as $param) {
                if(empty($item[$param]))
                    continue;

                if (!isset($data[$item['group']]['params'][$param][$item[$param]])) {
                    $data[$item['group']]['params'][$param][$item[$param]] = 1;
                } else {
                    $data[$item['group']]['params'][$param][$item[$param]] +=1;
                }
            }
        }

        $total = $data['gt_50_k']['total'] + $data['lt_eq_50_k']['total'];
        foreach ($data as $grName => &$group) {
            $group['prior'] = $group['total'] / $total;

            foreach ($group['params'] as $paramName => &$param) {
                if ($paramName == 'total')
                    continue;

                foreach($param as $valueName => &$value) {
                    $value = ($value / $data[$grName]['total']);
                }
            }
        }

        return $data;
    }
}
