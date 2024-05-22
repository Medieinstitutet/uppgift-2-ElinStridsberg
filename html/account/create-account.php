<?php
session_start(); 
include_once('../functions.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = new mysqli("db", "root", "notSecureChangeMe", "SaaS");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $salt = bin2hex(random_bytes(16)); 

    $hashed_password = md5($password . $salt);

    $role = isset($_POST['role']) ? $_POST['role'] : '';

    $sql = "INSERT INTO users (name, email, password, salt, role) VALUES ('$name', '$email', '$hashed_password', '$salt', '$role')";

    $result = $mysqli->query($sql);

    if ($result) {
        $user_id = $mysqli->insert_id;

        if ($role === 'customer') {
            create_newsletter('', '', $user_id);
        }

        $_SESSION['name'] = $name;
        header('Location: /?success=1');
        exit(); 
    } else {
        $errorMessage = "Misslyckades med att skapa användaren. Vänligen försök igen.";
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Skapa Användare</title>
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

        .registerForm {
            background-color: #fff;
            padding: 30px;
            padding-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .registerForm div {
            margin-bottom: 15px;
        }

        .registerForm label {
            display: block;
            margin-bottom: 5px;
        }

        .registerForm input[type="text"],
        .registerForm input[type="email"],
        .registerForm input[type="password"],
        .registerForm select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .registerForm input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .registerForm input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .errorMessage {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="registerForm">
        <?php
        if (isset($errorMessage)) {
            echo "<p class='errorMessage'>$errorMessage</p>";
        }
        ?>
        <h1>Registrering</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <label for="name">Namn:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">E-post:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Lösenord:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="role">Roll:</label>
                <select id="role" name="role" required>
                    <option value="customer">Customer</option>
                    <option value="subscriber">Subscriber</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Skapa användare">
            </div>
        </form>
    </div>
</body>
</html>
