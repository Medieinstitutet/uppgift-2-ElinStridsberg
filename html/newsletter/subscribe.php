<?php
session_start();
include_once('../functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;
    $newsletter_id = $_POST['newsletter_id'] ?? null;

    if ($user_id && $newsletter_id) {
        subscribe_to_newsletter($user_id, $newsletter_id);
        $_SESSION['message'] = "Du har nu prenumererat på nyhetsbrevet.";
    } else {
        $_SESSION['message'] = "Fel: kunde inte prenumerera.";
    }

    header("Location: /newsletter/show-all-newsletters.php");
    exit;
}
?>
