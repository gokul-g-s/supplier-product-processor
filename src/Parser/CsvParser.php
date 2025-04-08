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

    public static function parse(string $filename, array $mapping = []): \Generator
    {
        //echo "Opening file: $filename\n";
        if (!file_exists($filename)) {
            throw new \Exception("File not found: $filename");
        }
    
        $handle = fopen($filename, 'r');
        $headers = fgetcsv($handle);
    
        // Apply mapping
        if (!empty($mapping)) {
            $headers = array_map(function ($header) use ($mapping) {
                return $mapping[$header] ?? $header;
            }, $headers);
        }
    
        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($headers, $row);
            yield $data;
        }
    
        fclose($handle);
    }
    

    private static function detectDelimiter($file)
    {
        $line = fgets(fopen($file, 'r'));
        return substr_count($line, "\t") > substr_count($line, ",") ? "\t" : ",";
    }
}
