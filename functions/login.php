<?php
session_start();

$post = [
    'action' => 'login',
    'username' => $_POST['username'],
    'pass'   => $_POST['password'],
];

// $post = [
//     'action' => 'login',
//     'username' => 'testing1',
//     'pass'   => 'nrFLXZLRmR',
// ];

$ch = curl_init('https://beachroad.360and5.com/testing1/auth.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

$response = curl_exec($ch);

curl_close($ch);

$output = json_decode($response, TRUE);

if ($output['api']) {
    $_SESSION["token"] = $output['token'];
    echo $output['api'];
} else {
    session_unset();
    session_destroy();
    echo $output['api'];
}
?>