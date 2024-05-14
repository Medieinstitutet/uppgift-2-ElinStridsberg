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
// functions.php

// Funktion för att hämta prenumerationer för en användare baserat på användar-ID
function get_subscriptions_by_user_id($user_id) {
    // Anslut till databasen (ersätt detta med din egen anslutningskod)
    $mysqli = new mysqli("db", "root", "notSecureChangeMe", "SaaS");

    // Kontrollera anslutningen
    if ($mysqli->connect_error) {
        die("Anslutning misslyckades: " . $mysqli->connect_error);
    }

    // Förbered SQL-frågan för att hämta prenumerationer baserat på användar-ID
    $query = "SELECT * FROM subscriptions WHERE user_id = ?";
    // var_dump($query);
    // Förbered och utför frågan
    if ($stmt = $mysqli->prepare($query)) {
        // Binda parametrar
        $stmt->bind_param("i", $user_id);

        // Utför frågan
        $stmt->execute();

        // Hämta resultatet
        $result = $stmt->get_result();

        // Hämta prenumerationer som en associativ array
        $subscriptions = $result->fetch_all(MYSQLI_ASSOC);
        // Stäng frågan
        $stmt->close();

        // Stäng anslutningen
        $mysqli->close();

        // Returnera prenumerationer
        return $subscriptions;
    } else {
        echo "Det uppstod ett fel: " . $mysqli->error;
    }
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

// Funktion för att spara den slumpmässiga koden i resetPassword-tabellen
function save_reset_password_code($user_id, $code) {
    $mysqli = connect_database();

    // Escapa variablerna för att undvika SQL-injektion
    $user_id = $mysqli->real_escape_string($user_id);
    $code = $mysqli->real_escape_string($code);

    // Förbered SQL-frågan för att infoga data
    $query = "INSERT INTO resetPassword (user_id, code) VALUES ('$user_id', '$code')";

    // Utför SQL-frågan
    if ($mysqli->query($query) === TRUE) {
        // Lyckades att spara koden i databasen
        return true;
    } else {
        // Misslyckades att spara koden i databasen
        return false;
    }
}

// Funktion för att hämta användarnamnet från databasen baserat på användar-ID
function get_username_by_id($user_id) {
    // Anslut till databasen
    $mysqli = connect_database(); // Antag att detta är en funktion som ansluter till din databas

    // Undvik SQL-injektioner genom att använda prepared statements
    $stmt = $mysqli->prepare("SELECT name FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id); // "i" indikerar att det förväntas en integer

    // Utför frågan
    $stmt->execute();

    // Hämta resultatet
    $result = $stmt->get_result();

    // Kontrollera om det finns rader
    if ($result->num_rows > 0) {
        // Hämta användarnamnet från resultatet
        $row = $result->fetch_assoc();
        $username = $row['name'];
    } else {
        // Om användaren inte hittades, returnera false eller ett standardvärde
        $username = false;
    }

    // Stäng prepared statement och anslutningen till databasen
    $stmt->close();
    $mysqli->close();

    // Returnera användarnamnet
    return $username;
    var_dump($username);
}



?>
