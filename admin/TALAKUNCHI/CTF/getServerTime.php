<?php
// Set the timezone to India
date_default_timezone_set('Asia/Kolkata');

// Get the current server time in milliseconds
$serverTime = round(microtime(true) * 1000);

// Return the server time
echo $serverTime;
?>
