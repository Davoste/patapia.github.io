<?php 
 
// Product Details 
$itemNumber = "DP12345"; 
$itemName = "BucksHour Deposit"; 
$itemPrice = 5;  
$currency = "USD"; 
 
/* PayPal REST API configuration 
 * You can generate API credentials from the PayPal developer panel. 
 * See your keys here: https://developer.paypal.com/dashboard/ 
 */ 
define('PAYPAL_SANDBOX', TRUE); //TRUE=Sandbox | FALSE=Production 
define('PAYPAL_SANDBOX_CLIENT_ID', 'AfqXBS1lfmCY6PLWBLt2LYRjW1bpkjJSW12xWOdhOh1QcQiUBT-9IbXm06-81x9UlBcaxkDHNayhoIVJ'); 
define('PAYPAL_SANDBOX_CLIENT_SECRET', 'EO3NRENyhK360D8PT8pIVXJlEDdr5pC9VundFRRTGg1pZeoV__wqNB8Ev1PuW1a9l8cPLJlqR5K-IqnA'); 
define('PAYPAL_PROD_CLIENT_ID', 'Aah9z5WSXIJr6QUYm9YJGMA2jnhDP-ZtyYZh1UTQQ60M4PEFT7-gL6ZGjgYqX28gnETgoLfUh2R5fUUJ'); 
define('PAYPAL_PROD_CLIENT_SECRET', 'ELx4Fks4McsG23YGYANbLCNglHDmdYL56ZW8mKMeZN9owm1DLiBJUYyjnDrIWvHOMF8GMS7yYvIbaUuD'); 
  
// Database configuration  
define('DB_HOST', 'localhost');  
define('DB_USERNAME', 'root');  
define('DB_PASSWORD', '');  
define('DB_NAME', 'bet'); 
 
?>