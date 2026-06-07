<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

$num1 = rand(1, 10);
$num2 = rand(1, 10);

$_SESSION['captcha_answer'] = $num1 + $num2;

echo json_encode([
    'question' => "What is $num1 + $num2?"
]);
