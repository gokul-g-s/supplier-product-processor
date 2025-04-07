# Supplier Product List Processor

## Requirements

- PHP 7+
- Composer

### Installation


```bash
composer install

php bin/parser.php --file=examples/products_comma_separated.csv --unique-combinations=output/combination_count.csv

php bin/parser.php --file=examples/products_tab_separated.tsv --unique-combinations=output/combination_tab_count.csv