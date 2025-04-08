<?php

use PHPUnit\Framework\TestCase;
use App\ProductProcessor;

class ProductProcessorTest extends TestCase
{
    public function testProcessesAndWritesCombinationFile()
    {
        $inputFile = __DIR__ . '/fixtures/input_products.csv';
        $outputFile = __DIR__ . '/fixtures/output_combinations.csv';

        // Prepare a sample CSV
        if (!file_exists(dirname($inputFile))) {
            mkdir(dirname($inputFile));
        }


        file_put_contents($inputFile, "make,model,colour,capacity,network,grade,condition\r\nApple,iPhone 6s,Red,64GB,Unlocked,Grade A,Working");

        $processor = new ProductProcessor();
        $processor->process($inputFile, $outputFile);

        $this->assertFileExists($outputFile);

        $output = file($outputFile);
        $this->assertGreaterThan(1, count($output)); // header + row

        $this->assertStringContainsString('Apple', $output[1]);
        $this->assertStringContainsString('iPhone 6s', $output[1]);
        $this->assertStringContainsString('1', $output[1]); // count column
    }
}
