<?php
include_once('../functions.php');
connect_database();
include_once('../components/header.php');

$success_message = ""; // Variabel för att lagra framgångsmeddelande

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newsletter_id = $_POST['newsletter_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';

    if (!empty($newsletter_id) && !empty($name) && !empty($description)) {
        update_newsletter($newsletter_id, $name, $description);
        $success_message = "Nyhetsbrev uppdaterat!.";
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Update Newsletter</title>
</head>
<body>
    <h1>Redigera nyhetsbrev</h1>

    <?php
    if (!empty($success_message)) {
        echo "<p>$success_message</p>"; // Visa framgångsmeddelande om det finns ett
    }
    ?>

    <!-- Här fortsätter resten av din HTML-kod för formuläret -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="newsletter_id" value="<?php echo htmlspecialchars($newsletter_id, ENT_QUOTES, 'UTF-8'); ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></textarea><br>
        <button type="submit">Update Newsletter</button>
    </form>

</body>
</html>
