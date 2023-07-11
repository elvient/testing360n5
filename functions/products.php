<?php
session_start();

if (isset($_SESSION['token'])) {
    $post = [
        'token' => $_SESSION['token']
    ];

    $ch = curl_init('https://beachroad.360and5.com/testing1/products.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    $response = curl_exec($ch);

    curl_close($ch);

    $output = json_decode($response, TRUE);

    if ($output['api']) {
        echo $response;
    } else {
        session_unset();
        session_destroy();
        echo FALSE;
    }
} else {
    echo FALSE;
}
?>