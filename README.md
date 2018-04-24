# CurrencyConverter
Simple Currency Conversion Class

Designed for a quick and easy way of converting one currency to another, without 3rd party API's and bloated responses.

# Usage

```php
  
  <?php 

	include('CurrencyConverter.php');

	$cc =  new CurrencyConverter();

	echo $cc->convert(1,'EUR', 'NGN') . "\n";
  
```
