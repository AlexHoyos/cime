<?php

use chillerlan\QRCode\QRCode;

include 'app/main.php';
$qrcode = (new QRCode($QRoptions))->render(12);
?>

<?=base64_decode($qrcode)?>