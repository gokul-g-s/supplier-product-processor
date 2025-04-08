# Supplier Product List Processor

This PHP command-line tool processes different types of product data files (like CSV/TSV), standardizes them into product objects, and generates a report of unique product combinations with counts.

## 🛠 Features

- Parses CSV/TSV product files with different formats.
- Supports custom field mappings to handle various header names.
- Outputs:
  - Console display of each product as an object.
  - A CSV file listing unique product combinations and their counts.
- Includes unit tests using PHPUnit.

## Requirements

- PHP 7.4+
- [Composer](https://getcomposer.org/) installed globally

### Installation

Open your terminal in the project folder:

```bash
composer install

composer dump-autoload

php bin/parser.php --file=examples/products_comma_separated.csv --unique-combinations=output/combination_count.csv

php bin/parser.php --file=examples/products_tab_separated.tsv --unique-combinations=output/combination_tab_count.csv