<?php
namespace Athe0i\NaiveBayes\Example\PersonData;

use Athe0i\NaiveBayes\Contract\DataSource;

class Parser implements DataSource
{
    public function parse($filename, $limit, $offset = 0)
    {
        $raw = [];
        $file = fopen($filename, 'r');

        while (($row = fgets($file)) !== false && $limit-- != 0) {
            if ($offset-- > 0) {
                continue;
            }

            $rawRow = $this->parseRow($row);

            if (count($rawRow) != 10)
                continue;

            $raw[] = $rawRow;
        }

        fclose($file);

        return $raw;
    }

    public function parseRow($row)
    {
        $exploded = explode(', ', $row);

        return [
            'age' => $this->rangeAge($exploded[0]),
            'workclass' => $exploded[1],
            // 'fnlwgt' => $exploded[2], // wtf?
            'education' => $exploded[3],
            // 'education-num' => $exploded[4], //wtf?
            'marital-status' => $exploded[5],
            'occupation' => $exploded[6],
            'relationship' => $exploded[7],
            'race' => $exploded[8],
            'sex' => $exploded[9],
            //'capital-gain' => $exploded[10],
            //'capital-loss' => $exploded[11],
            //'hours-per-week' => $exploded[12],
            'native-country' => $exploded[13],
            'group' => $this->getGroup($exploded[14])
        ];
    }

    public function rangeAge($age)
    {
        if ($age < 21) {
            return 'teen';
        } elseif ($age < 30) {
            return 'young';
        } elseif ($age < 45) {
            return 'mid';
        } elseif ($age < 60) {
            return 'mid-old';
        } else {
            return 'old';
        }
    }

    public function getGroup($rawGroup)
    {
        return strpos($rawGroup, '>50K') !== false ? 'gt_50_k' : 'lt_eq_50_k';
    }
}
