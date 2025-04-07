<?php
namespace App;

use App\Parser\CsvParser;

class ProductProcessor
{
    public function process(string $file, string $outputFile)
    {
        echo "Opening file: $file\n";
        $combinations = [];

        foreach (CsvParser::parse($file) as $data) {
            echo "Parsing row\n";
            $product = new Product($data);
            echo $product . PHP_EOL;

            $key = $product->getKey();
            if (!isset($combinations[$key])) {
                $combinations[$key] = ['product' => $product, 'count' => 0];
            }
            $combinations[$key]['count']++;
        }

        echo "Saving results to $outputFile\n";
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
        echo "Done.\n";

    }
}
