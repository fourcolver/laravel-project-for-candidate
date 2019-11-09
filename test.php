<?php
phpinfo();die;
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Send
$send = mail('work.a.andrey@gmail.com', 'My Subject', 'Test');
var_dump($send);
