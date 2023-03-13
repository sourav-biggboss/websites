<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
  $host = "localhost";
  $userName = "root";
  $password = "";
  $dbName = "fastag";

  // test payment getwayfdsf
  $keyId = 'rzp_test_2yfhfyvVNb9FtQ';
  $keySecret = 'U0UkmtXiMlKDNdKfpGESvisD';
  $displayCurrency = 'INR';

}else if($_SERVER['SERVER_NAME'] == 'tolltaxes.com'){
  $host = "localhost";
  $userName = "u129444908_fastag";
  $password = "skill@0Rs";
  $dbName = "u129444908_fastag";
  
  // test payment getway
//   $keyId = 'rzp_test_2yfhfyvVNb9FtQ';
//   $keySecret = 'U0UkmtXiMlKDNdKfpGESvisD';
//   $displayCurrency = 'INR';

  // live payment getway
  $keyId = 'rzp_test_2yfhfyvVNb9FtQ';
  $keySecret = 'U0UkmtXiMlKDNdKfpGESvisD';
  $displayCurrency = 'INR';
  
define('CASHFREE_APP_ID', '632587f4278b88c2963e2d4cc85236');
define('CASHFREE_KEY_SECRET', '477d8fce486a600d860c07a559c8bceb5ec24fd1');
define('RETURN_URL', 'https://tolltaxes.com/cashfree-response.php');
define('NOTIFY_URL', 'https://tolltaxes.com/cashfree-notification.php');
 define('REQUEST_URL', 'https://test.cashfree.com/billpay/checkout/post/submit');

}else if($_SERVER['SERVER_NAME'] == 'fastag.tolltaxes.com'){
  $host = "localhost";
  $userName = "u129444908_fast_fastag";
  $password = "skill@0Rs";
  $dbName = "u129444908_fast_fastag";

  // live payment getway
  $keyId = 'rzp_test_2yfhfyvVNb9FtQ';
  $keySecret = 'U0UkmtXiMlKDNdKfpGESvisD';
  $displayCurrency = 'INR';

}else{
  $host = "localhost";
  $userName = "u129444908_fastag";
  $password = "skill@0Rs";
  $dbName = "u129444908_fastag";
  
  // test payment getway
//   $keyId = 'rzp_test_2yfhfyvVNb9FtQ';
//   $keySecret = 'U0UkmtXiMlKDNdKfpGESvisD';
//   $displayCurrency = 'INR';

  // live payment getway
  $keyId = 'rzp_test_2yfhfyvVNb9FtQ';
  $keySecret = 'U0UkmtXiMlKDNdKfpGESvisD';
  $displayCurrency = 'INR';
  
define('CASHFREE_APP_ID', '632587f4278b88c2963e2d4cc85236');
define('CASHFREE_KEY_SECRET', '477d8fce486a600d860c07a559c8bceb5ec24fd1');
define('RETURN_URL', 'https://tolltaxes.com/cashfree-response.php');
define('NOTIFY_URL', 'https://tolltaxes.com/cashfree-notification.php');
 define('REQUEST_URL', 'https://test.cashfree.com/billpay/checkout/post/submit');
}

// Create database connection
$conn = new mysqli($host, $userName, $password, $dbName);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
