<?php
namespace App;

use App\Parser\CsvParser;

class ProductProcessor
{
    public function process(string $file, string $outputFile)
    {
        $combinations = [];

        $mapping = [
            'brand_name'    => 'make',
            'model_name'    => 'model',
            'colour_name'   => 'colour',
            'gb_spec_name'  => 'capacity',
            'network_name'  => 'network',
            'grade_name'    => 'grade',
            'condition_name'=> 'condition',
        ];

        foreach (CsvParser::parse($file, $mapping) as $data) {
            $product = new Product($data);
            //echo $product . PHP_EOL;
            
            $key = $product->getKey();
            if (!isset($combinations[$key])) {
                $combinations[$key] = ['product' => $product, 'count' => 0];
            }
            $combinations[$key]['count']++;
        }

        $handle = fopen($outputFile, 'w');
        fputcsv($handle, ['make', 'model', 'colour', 'capacity', 'network', 'grade', 'condition', 'count']);

        foreach ($combinations as $item) {
            $p = $item['product'];
            fputcsv($handle, [
                $p->make, $p->model, $p->colour, $p->capacity,
                $p->network, $p->grade, $p->condition, $item['count']
            ]);
        }

        fclose($handle);
    }
}

