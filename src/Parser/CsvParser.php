<?php

namespace App\Parser;

class CsvParser
{
    private static $headerMap = [
        'brand_name'    => 'make',
        'model_name'    => 'model',
        'colour_name'   => 'colour',
        'gb_spec_name'  => 'capacity',
        'network_name'  => 'network',
        'grade_name'    => 'grade',
        'condition_name'=> 'condition',
    ];

    public static function parse($filepath)
    {
        $delimiter = self::detectDelimiter($filepath);
        $handle = fopen($filepath, 'r');
        if (!$handle) {
            throw new \Exception("Cannot open file: $filepath");
        }

        $headers = fgetcsv($handle, 0, $delimiter);
        $headers = array_map('trim', $headers);
        $headers = array_map(fn($h) => strtolower(str_replace('"', '', $h)), $headers);

        $mapped = [];
        foreach ($headers as $i => $header) {
            $mapped[$i] = self::$headerMap[$header] ?? null;
        }

        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            $productData = [];

            foreach ($row as $i => $val) {
                $key = $mapped[$i];
                if ($key !== null) {
                    $productData[$key] = trim(str_replace('"', '', $val));
                }
            }

            yield $productData;
        }

        fclose($handle);
    }

    private static function detectDelimiter($file)
    {
        $line = fgets(fopen($file, 'r'));
        return substr_count($line, "\t") > substr_count($line, ",") ? "\t" : ",";
    }
}
