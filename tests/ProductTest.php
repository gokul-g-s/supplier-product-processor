<?php

use PHPUnit\Framework\TestCase;
use App\Product;

class ProductTest extends TestCase
{
    public function testProductInitialization()
    {
        $data = [
            'make' => 'Apple',
            'model' => 'iPhone 6s',
            'colour' => 'Red',
            'capacity' => '128GB',
            'network' => 'Unlocked',
            'grade' => 'Grade A',
            'condition' => 'Working'
        ];

        $product = new Product($data);

        $this->assertEquals('Apple', $product->make);
        $this->assertEquals('iPhone 6s', $product->model);
    }

    public function testMissingRequiredFieldThrowsException()
    {
        $this->expectException(Exception::class);

        $data = [
            'model' => 'iPhone 6s' // no 'make'
        ];

        new Product($data);
    }
}
