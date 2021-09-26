<?php
if ($_POST['submit']) {
    $name   = $_POST['name'];
    $token  = $_POST['token'];
    $action = $_POST['action'];

	var_dump($_POST);

    $curlData = array(
        'secret' => '6LepaIocAAAAADd3kGQEzvgVYdKgp-SlXR9btEsk',
        'response' => $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curlData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $curlResponse = curl_exec($ch);

    $captchaResponse = json_decode($curlResponse, true);

    if ($captchaResponse['success'] == '1' && $captchaResponse['action'] == $action && $captchaResponse['score'] >= 0.5 && $captchaResponse['hostname'] == $_SERVER['SERVER_NAME']) {
        echo 'Form Submitted Successfully';
    } else {
        echo 'You are not a human';
    }
}