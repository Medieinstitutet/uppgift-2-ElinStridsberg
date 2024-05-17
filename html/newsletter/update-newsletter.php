<?php
include_once('../functions.php');
connect_database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newsletter_id = $_POST['newsletter_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';

    if (!empty($newsletter_id) && !empty($name) && !empty($description)) {
        update_newsletter($newsletter_id, $name, $description);
        echo "Newsletter updated successfully.";
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}
?>
