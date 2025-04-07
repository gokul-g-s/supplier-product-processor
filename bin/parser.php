#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\ProductProcessor;

$options = getopt("", ["file:", "unique-combinations:"]);

if (!isset($options['file']) || !isset($options['unique-combinations'])) {
    echo "Usage: php parser.php --file=<file_path> --unique-combinations=<output_file>\n";
    exit(1);
}

$processor = new ProductProcessor();
$processor->process($options['file'], $options['unique-combinations']);
