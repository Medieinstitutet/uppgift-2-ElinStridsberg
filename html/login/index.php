<?php
session_start();
include_once('../functions.php');

// Hårdkodad användarinformation
$hardcoded_username = "user";
$hardcoded_password = "password";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["username"] == $hardcoded_username && $_POST["password"] == $hardcoded_password) {
        $_SESSION["user_role"] = "user";
        $_SESSION["is_signed_in"] = true;
        header("Location: http://localhost:8080/my-pages/");
        exit();
    } else {
        $error_message = "Felaktigt användarnamn eller lösenord.";
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    if (isset($error_message)) {
        echo "<p>$error_message</p>";
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div>
            <label for="username">Användarnamn:</label>
            <input type="text" id="username" name="username">
        </div>
        <div>
            <label for="password">Lösenord:</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <input type="submit" value="Logga in">
        </div>
    </form>

<?php include('../components/header.php'); ?>

<?php include('../components/footer.php'); ?>
</body>
</html>
