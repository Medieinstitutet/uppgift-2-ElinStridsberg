<?php
// Funktion för att kontrollera om användaren har en viss roll
function user_has_role($role) {
    if (is_signed_in() && isset($_SESSION['user_role']) && $_SESSION['user_role'] == $role) {
        return true;
    } else {
        return false;
    }
}

// Funktion för att kontrollera om användaren är inloggad
function is_signed_in() {
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
            <h3><?php echo htmlspecialchars($row["name"]); ?></h3>
            <p><?php echo htmlspecialchars($row["email"]); ?></p>
            <p><?php echo htmlspecialchars($row["role"]); ?></p>
        </div>
        <?php
    }                
}

function is_user_subscribed($user_id, $newsletter_id) {
    $mysqli = connect_database();
    // var_dump($user_id); // Kommentera bort denna rad
    // var_dump($newsletter_id); // Kommentera bort denna rad
    $stmt = $mysqli->prepare("SELECT COUNT(*) FROM subscriptions WHERE user_id = ? AND newsletter_id = ?");
    
    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }
    
    $stmt->bind_param("ii", $user_id, $newsletter_id);
    $stmt->execute();
    
    if ($stmt->error) {
        die("Error: " . $stmt->error);
    }

    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    return $count > 0;
}

function create_user($name, $email, $password, $role) {
    $mysqli = connect_database();
    $stmt = $mysqli->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);
    $stmt->execute();
    $stmt->close();
}

function get_newsletters() {
    $mysqli = connect_database();
    $user_id = $_SESSION['user_id'] ?? null;
    $result = $mysqli->query("SELECT * FROM newsletters");
    
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach($rows as $row) {
        $newsletter_id = $row["id"];
        $is_subscribed = is_user_subscribed($user_id, $newsletter_id);
        ?>
        <div>
            <h3><?php echo htmlspecialchars($row["name"]); ?></h3>
            <p><?php echo htmlspecialchars($row["description"]); ?></p>
            <form method="post" action="<?php echo $is_subscribed ? 'unsubscribe.php' : 'subscribe.php'; ?>">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                <input type="hidden" name="newsletter_id" value="<?php echo htmlspecialchars($newsletter_id); ?>">
                <button type="submit"><?php echo $is_subscribed ? 'Avprenumerera' : 'Prenumerera'; ?></button>
            </form>
        </div>
        <?php
    }
}

function get_newsletter_by_id($newsletter_id) {
    $mysqli = connect_database();
    $stmt = $mysqli->prepare("SELECT name, description FROM newsletters WHERE id = ?");
    $stmt->bind_param("i", $newsletter_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $newsletter = $result->fetch_assoc();
    } else {
        $newsletter = false;
    }

    $stmt->close();
    $mysqli->close();

    return $newsletter;
}
// functions.php

// Funktion för att hämta användarens nyhetsbrev från databasen baserat på användar-ID
function get_user_newsletters($user_id) {
    // Anslut till databasen
    $mysqli = connect_database();

    // Förbered SQL-frågan för att hämta användarens nyhetsbrev baserat på owner_id
    $stmt = $mysqli->prepare("SELECT id, name, description FROM newsletters WHERE owner_id = ?");
    $stmt->bind_param("i", $user_id); // "i" indikerar att det förväntas en integer

    // Utför frågan
    $stmt->execute();

    // Hämta resultatet
    $result = $stmt->get_result();

    // Skapa en array för att lagra nyhetsbreven
    $user_newsletters = array();

    // Loopa genom resultaten och lägg till nyhetsbreven i arrayen
    while ($row = $result->fetch_assoc()) {
        $user_newsletters[] = $row;
    }

    // Stäng prepared statement och anslutningen till databasen
    $stmt->close();
    $mysqli->close();

    // Returnera nyhetsbreven
    return $user_newsletters;
}
function update_newsletter($newsletter_id, $title, $description) {
    $mysqli = connect_database();

    // Förbered en SQL-fråga för att uppdatera nyhetsbrevet i databasen
    $stmt = $mysqli->prepare("UPDATE newsletters SET title = ?, description = ? WHERE id = ?");
    
    // Kontrollera om titeln är satt innan du binder parametern
    if ($title !== null) {
        $stmt->bind_param("ssi", $title, $description, $newsletter_id);
    } else {
        // Om titeln inte är satt, uppdatera endast beskrivningen
        $stmt->bind_param("si", $description, $newsletter_id);
    }
    
    $stmt->execute();
    $stmt->close();
    
    // Stäng anslutningen
    $mysqli->close();
}

//TODO NEWSLETTER_ID SKA VARA DET ID SOM KUNDEN HAR PÅ SINA NYHETSBREV (DE NYHETSBREV SOM HAN ANVÄNDER)
function get_subscribers() {
    $mysqli = connect_database();
    $result = $mysqli->query("SELECT * FROM subscriptions WHERE newsletter_id = 4");
    
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach($rows as $row) {
        ?>
        <div>
            <h3>Användarid: <?php echo htmlspecialchars($row["id"]); ?></h3>
        </div>
        <?php
    }                
}

function get_subscriptions_by_user_id($user_id) {
    $mysqli = connect_database();
    
    $query = "SELECT * FROM subscriptions WHERE user_id = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $subscriptions = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $mysqli->close();
        return $subscriptions;
    } else {
        echo "Det uppstod ett fel: " . $mysqli->error;
    }
}

function unsubscribe_from_newsletter($user_id, $newsletter_id) {
    $mysqli = connect_database();
    // var_dump($newsletter_id); // Kommentera bort denna rad
    $stmt = $mysqli->prepare("DELETE FROM subscriptions WHERE user_id = ? AND newsletter_id = ?");
    $stmt->bind_param("ii", $user_id, $newsletter_id);
    $stmt->execute();
    $stmt->close();
}

function subscribe_to_newsletter($user_id, $newsletter_id) {
    if (!is_user_subscribed($user_id, $newsletter_id)) {
        $mysqli = connect_database();
        $stmt = $mysqli->prepare("INSERT INTO subscriptions (user_id, newsletter_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $newsletter_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // echo "Användaren är redan prenumerant av detta nyhetsbrev."; // Kommentera bort denna rad
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

function save_reset_password_code($user_id, $code) {
    $mysqli = connect_database();
    $user_id = $mysqli->real_escape_string($user_id);
    $code = $mysqli->real_escape_string($code);
    $query = "INSERT INTO resetPassword (user_id, code) VALUES ('$user_id', '$code')";

    if ($mysqli->query($query) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function get_username_by_id($user_id) {
    $mysqli = connect_database();
    $stmt = $mysqli->prepare("SELECT name FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['name'];
    } else {
        $username = false;
    }

    $stmt->close();
    $mysqli->close();

    return $username;
}
?>
