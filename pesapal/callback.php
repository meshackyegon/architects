<?php
$response = file_get_contents('php://input');
$file = "res.txt";
$write = fopen($file, "a");
fwrite($write, $response);
$str2 = json_decode($response,true);