<?php
session_start();
require_once '../../vendor/autoload.php'; // Ensure you have installed the Google API client library via Composer

$client = new Google_Client();
$client->setClientId('452949463455-gid3ocq535j2snago9km48978su1103j.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/Proyecto-Final-Back/views/login_google.php');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if ($token) {
        $_SESSION['access_token'] = $token;
        $client->setAccessToken($token);
        $user = $client->userinfo();
        if ($user->getAccessToken()) {
            $userData = $user->getDecodedResponse();
            $_SESSION['user'] = $userData;
            header('Location: ./alumno-perfil.php'); 
            exit();
        }
    }
}

if ($client->getAccessToken()) {
    $user = $client->userinfo();
    if ($user->getAccessToken()) {
        $userData = $user->getDecodedResponse();
        $_SESSION['user'] = $userData;
        header('Location: ./alumno-perfil.php');
        exit();
    }
} else {
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    exit();
}
?>
