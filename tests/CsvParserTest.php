<?php

use PHPUnit\Framework\TestCase;
use App\Parser\CsvParser;

class CsvParserTest extends TestCase
{
    public function testParsesCsvCorrectly()
    {
        $testCsv = __DIR__ . '/fixtures/test_products.csv';

        // Create a sample CSV file for testing
        if (!file_exists(dirname($testCsv))) {
            mkdir(dirname($testCsv));
        }

        file_put_contents($testCsv, "make,model,colour,capacity,network,grade,condition\r\nApple,iPhone 6s,Red,64GB,Unlocked,Grade A,Working");

        $rows = iterator_to_array(CsvParser::parse($testCsv));

        $this->assertCount(1, $rows);
        $this->assertEquals('Apple', $rows[0]['make']);
        $this->assertEquals('iPhone 6s', $rows[0]['model']);
    }
}
