<?php 

	include('CurrencyConverter.php');

	$cc =  new CurrencyConverter();

	echo $cc->convert(1,'EUR', 'NGN') . "\n";

	exit;