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
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .loginForm {
            background-color: #fff;
            padding: 30px;
            padding-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px; /* Ställ in en fast bredd för formuläret */

        }

        .loginForm input[type="email"],
        .loginForm input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .loginForm input[type="submit"],
        .loginForm button {
            width: 120px; /* Här är ändringen */
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .loginForm input[type="submit"]:hover,
        .loginForm button:hover {
            background-color: #0056b3;
        }

        .loginForm button {
            background-color: #f0ad4e;
        }

        .loginForm button:hover {
            background-color: #eea236;
        }

        .loginForm .login-resetp a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .loginForm .login-resetp a:hover {
            color: #0056b3;
        }
        .login-resetp {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
           
        }
  .loginBtns{
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }
  a{
    margin-top: 8px;
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
                <div class="loginBtns">
                <input type="submit" value="Logga in" class="login">  
                <a href="../email/reset-password.php">Glömt lösenord?</a>
            </div>
                <button onclick="window.location.href='/account/create-account.php'" >Registrera</button>
</div>
             
              
         
         
        </form>
    </div>
</body>
</html>
