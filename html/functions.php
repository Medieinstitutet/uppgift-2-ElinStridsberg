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
function create_newsletter($name, $description, $owner_id) {
    $mysqli = connect_database();
    $stmt = $mysqli->prepare("INSERT INTO newsletters (name, description, owner_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $description, $owner_id); // Ändrade till "ssi" för att matcha datatyperna
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
        <style>
        body {
            
    width: 100%;
    margin: 0 auto;
}

h1 {
    margin-top: 90px;
    margin-bottom: 60px;
    text-align: center;
}

div {
    background-color: #fff;
            padding: 30px;
            padding-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px; 
            margin-bottom: 20px;

}

 button {
            width: 120px; /* Här är ändringen */
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }


        </style>
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

function get_newsletters_loggeout() {
    $mysqli = connect_database();
    $user_id = $_SESSION['user_id'] ?? null;
    $result = $mysqli->query("SELECT * FROM newsletters");
    
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach($rows as $row) {
        $newsletter_id = $row["id"];
        $is_subscribed = is_user_subscribed($user_id, $newsletter_id);
        ?>
        <style>
        body {
            
    width: 100%;
    margin: 0 auto;
}

h1 {
    margin-top: 90px;
    margin-bottom: 60px;
    text-align: center;
}

div {
    background-color: #fff;
            padding: 30px;
            padding-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px; 
            margin-bottom: 20px;

}

 button {
            width: 120px; 
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }


        </style>
        <div>
            <h3><?php echo htmlspecialchars($row["name"]); ?></h3>
            <p><?php echo htmlspecialchars($row["description"]); ?></p>
            <form method="post" action="<?php echo $is_subscribed ? 'unsubscribe.php' : 'subscribe.php'; ?>">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                <input type="hidden" name="newsletter_id" value="<?php echo htmlspecialchars($newsletter_id); ?>">
             
            </form>
        </div>
        <?php
    }
}
function get_newsletter_by_id($newsletter_id, $owner_id) {
    $mysqli = connect_database();
    $stmt = $mysqli->prepare("SELECT name, description FROM newsletters WHERE id = ? AND owner_id = ?");
    $stmt->bind_param("ii", $newsletter_id, $owner_id);
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


function get_user_subscribed_newsletters($user_id) {
    $mysqli = connect_database();
    
    $query = "SELECT n.name, n.description FROM newsletters AS n INNER JOIN subscriptions AS s ON n.id = s.newsletter_id WHERE s.user_id = ?";
    
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $newsletters = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $mysqli->close();
        return $newsletters;
    } else {
        echo "Det uppstod ett fel: " . $mysqli->error;
    }
}



function get_user_newsletters($user_id) {
    $mysqli = connect_database();

    $stmt = $mysqli->prepare("SELECT id, name, description FROM newsletters WHERE owner_id = ?");
    $stmt->bind_param("i", $user_id); 

    $stmt->execute();

    $result = $stmt->get_result();

    $user_newsletters = array();

    while ($row = $result->fetch_assoc()) {
        $user_newsletters[] = $row;
    }

    $stmt->close();
    $mysqli->close();

    return $user_newsletters;
}

function update_newsletter($newsletter_id, $name, $description) {
    $mysqli = connect_database();

    $stmt = $mysqli->prepare("UPDATE newsletters SET name = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $description, $newsletter_id);
    $stmt->execute();
    $stmt->close();
    
    $mysqli->close();
}


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

function get_subscribers_for_owner($owner_id) {
    $mysqli = connect_database();

    $query = "SELECT users.name AS subscriber_name, users.email AS subscriber_email, newsletters.name AS newsletter_name
              FROM subscriptions
              JOIN users ON subscriptions.user_id = users.id
              JOIN newsletters ON subscriptions.newsletter_id = newsletters.id
              WHERE newsletters.owner_id = ?";
    
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $owner_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $subscribers = array();

        while ($row = $result->fetch_assoc()) {
            $subscribers[] = $row;
        }

        $stmt->close();
        $mysqli->close();

        return $subscribers;
    } else {
        echo "Det uppstod ett fel: " . $mysqli->error;
    }
}


function unsubscribe_from_newsletter($user_id, $newsletter_id) {
    $mysqli = connect_database();
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
    $query = "INSERT INTO resetPassword (user_id, code) VALUES (?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("is", $user_id, $code);
    return $stmt->execute();
    var_dump("ID".$user_id);
}

function update_password($hashed_password, $salt, $code) {
    $mysqli = connect_database();
    
    $stmt = $mysqli->prepare("SELECT user_id FROM resetPassword WHERE code = ?");
    if (!$stmt) {
        echo "Prepare failed (select user): (" . $mysqli->errno . ") " . $mysqli->error;
        return false;
    }
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if (!$user_id) {
        echo "Ingen användare hittades med den angivna återställningskoden.";
        return false;
    }

    $stmt = $mysqli->prepare("UPDATE users SET password = ?, salt = ? WHERE id = ?");
    if (!$stmt) {
        echo "Prepare failed (update password): (" . $mysqli->errno . ") " . $mysqli->error;
        return false;
    }
    $stmt->bind_param("ssi", $hashed_password, $salt, $user_id);
    $stmt->execute();

    if ($stmt->errno) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    $success = $stmt->affected_rows > 0;
    $stmt->close();
    return $success;
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


function get_subscribers_for_user($user_id) {
    $mysqli = connect_database();

    $query = "SELECT users.name AS subscriber_name, users.email AS subscriber_email, newsletters.name AS newsletter_name
              FROM subscriptions
              JOIN users ON subscriptions.user_id = users.id
              JOIN newsletters ON subscriptions.newsletter_id = newsletters.id
              WHERE newsletters.owner_id = ?";
    
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $user_id);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<p><strong>Namn:</strong> " . $row['subscriber_name'] . "</p>";
            echo "<p><strong>E-postadress:</strong> " . $row['subscriber_email'] . "</p>";
            echo "<p><strong>Prenumererar på nyhetsbrev:</strong> " . $row['newsletter_name'] . "</p>";
            echo "<hr>";
        }

        $stmt->close();
        $mysqli->close();
    } else {
        echo "Det uppstod ett fel: " . $mysqli->error;
    }
}

function get_user_id_by_reset_code($code) {
    $conn = connect_database();

    $sql = "SELECT user_id FROM resetPassword WHERE code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    return $user_id ? $user_id : false;
}

function get_reset_code_by_user_id($user_id) {
    $mysqli = connect_database();

    $sql = "SELECT code FROM resetPassword WHERE user_id = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['code'];
    } else {
        return false;
    }
}

?>