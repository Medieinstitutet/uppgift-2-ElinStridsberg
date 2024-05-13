<?php
session_start();


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hantera formulärdata och lägg till användaren i databasen
    $mysqli = new mysqli("db", "root", "notSecureChangeMe", "SaaS");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Lösenord som användaren angav

    // Generera ett random salt
    $salt = bin2hex(random_bytes(16)); // Slumpmässigt genererat salt

    // Skapa det hashade lösenordet med md5 och saltet
    $hashed_password = md5($password.$salt);
// var_dump($hashed_password);
    // Hämta värdet av 'role' från formuläret, förutsatt att det är satt
    $role = isset($_POST['role']) ? $_POST['role'] : ''; 

    // Lägg till användaren i databasen med både det hashade lösenordet och saltet
    $sql = "INSERT INTO users (name, email, password, salt, role) VALUES ('$name', '$email', '$password', '$hashed_password', '$role')";

    $result = $mysqli->query($sql);

    if ($result) {
        $_SESSION['name'] = $name;
        header('Location: /?success=1');
        exit();
    } else {
        $errorMessage = "Misslyckades med att skapa användaren. Vänligen försök igen.";
    }
}


?>
<!-- HTML-kod börjar här -->


<form method="post">
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

<?php
include_once('../functions.php');
?>