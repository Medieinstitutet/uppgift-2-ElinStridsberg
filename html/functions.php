<?php

// Funktion för att kontrollera om användaren har en viss roll
function user_has_role($role) {
    // Kontrollera om användaren är inloggad och har rätt roll
    if (is_signed_in() && isset($_SESSION['user_role']) && $_SESSION['user_role'] == $role) {
        return true;
    } else {
        return false;
    }
}

// Funktion för att kontrollera om användaren är inloggad
function is_signed_in() {
    // Kontrollera om en sessionsvariabel för inloggning finns
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

function connect_database () { 
    $mysqli = new mysqli("db", "root", "notSecureChangeMe", "SaaS");
    return $mysqli;
}

function get_users () { 
    $mysqli = connect_database();
    
    $result = $mysqli->query("SELECT * FROM users");
    
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach($rows as $row) {
        ?>
        <div>
            <h3><?php echo $row["name"]; ?></h3>
            <p><?php echo $row["email"]; ?></p>
            <p><?php echo $row["role"]; ?></p>
        </div>
        <?php
    }                
}

function create_user($name, $email, $password, $role) {
    $mysqli = connect_database();

    $mysqli->query("INSERT INTO users (name, email, password, role) VALUES ($name, $email, $password, $role)");
}

function get_newsletters() {
    $mysqli = connect_database();
    
    $result = $mysqli->query("SELECT * FROM newsletters");
    
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach($rows as $row) {
        ?>
        <div>
            <h3><?php echo $row["name"]; ?></h3>
            <p><?php echo $row["description"]; ?></p>
        </div>
        <?php
    }
}

function get_subscribers() {
    $mysqli = connect_database();
    
    $result = $mysqli->query("SELECT * FROM subscribers");
    
    // Kommentera ut var_dump() för att undvika utmatning
    // var_dump($result->fetch_all());

    // Returnera istället resultaten för användning i annan kod
    return $result->fetch_all();
}

function get_user_by_email($email) {
    $mysqli = connect_database();
    $email = $mysqli->real_escape_string($email);

    $result = $mysqli->query("SELECT * FROM users WHERE email = '$email'");

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

?>
