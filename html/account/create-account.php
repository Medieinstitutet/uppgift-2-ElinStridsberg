<?php   
session_start();
include_once("functions.php");

//TODO: Ta informationen från formulär ist för det hårdkodade exemplet
 
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mysqli = new mysqli("db", "root", "notSecureChangeMe", "SaaS");

        $sql = "INSERT INTO users (name, email, password, role, salt) VALUES ('elin', 'elin@s.s', 'adedw', 'customer', '')";

var_dump($sql);
$result = $mysqli->query($sql);
        $_SESSION['name'] = $_POST['name'];

        header('Location: /?success=1');
    }
?>
<p>index</p> 

<!-- Skapa användare formulär -->
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
    include('./components/footer.php');
?>
