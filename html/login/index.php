<?php
if (session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once($_SERVER['DOCUMENT_ROOT'] .'/functions.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $user = get_user_by_email($email);
    if ($user) {
        $hashed_password_from_db = $user["password"];
        if ($password === $hashed_password_from_db) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_role"] = $user["role"];
            $_SESSION["is_signed_in"] = true;
?>
            <script>
                window.location.href = '/my-pages'; // Byt ut '/my-pages' med den önskade URL:en
            </script>
<?php
            exit(); // Avsluta exekveringen här för att förhindra att resten av koden körs
        } else {
            $error_message = "Felaktigt lösenord.";
        }
    } else {
        $error_message = "Användaren finns inte.";
    }
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
      .loginForm{
        display: flex;
      }
    </style>
</head>
<body>
<?php
    // Visa eventuellt felmeddelande om det är satt
    if (isset($error_message)) {
        echo "<p>$error_message</p>";
    }
?>
    <div class="loginForm">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div>
                <input type="email" id="email" name="email" required placeholder="Email">
            </div>
            <div>
                <input type="password" id="password" name="password" required placeholder="Lösenord">
            </div>
            <div class="login-resetp">
                <input type="submit" value="Logga in" class="login">
                <button onclick="window.location.href='../email/reset-password.php'">Glömt lösenord?</button>
            </div>
        </form>
    </div>
</body>
</html>
