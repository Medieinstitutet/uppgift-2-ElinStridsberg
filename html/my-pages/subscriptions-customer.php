<?php
session_start();
include_once('../functions.php');
include_once('../components/header.php');


// Kontrollera om användaren är inloggad
if (!isset($_SESSION['user_id'])) {
    echo ("Vänligen logga in");
    exit(); // Avsluta exekveringen här
}

// Hämta användarens ID från sessionen
$user_id = $_SESSION['user_id'];

// Hämta prenumeranterna för den aktuella användaren från databasen
$subscribers = get_subscribers_for_owner($user_id);
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Mina Prenumeranter</title>
    <style>

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 800px;
            text-align: center;
        }

        h1 {
            margin-bottom: 70px;
            font-size: 30px;
            text-align: center;
        margin-top: 100px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin: 0 auto;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .no-subscribers {
            color: #666;
            font-size: 16px;
        }
        p{
            text-align: center;

        }
    </style>
</head>
<body>
    
    <h1>Mina Prenumeranter</h1>

    <?php if ($subscribers): ?>
        <table>
            <tr>
                <th>Namn</th>
                <th>E-post</th>
                <th>Nyhetsbrev</th>
            </tr>
            <?php foreach ($subscribers as $subscriber): ?>
                <tr>
                    <td><?php echo $subscriber['subscriber_name']; ?></td>
                    <td><?php echo $subscriber['subscriber_email']; ?></td>
                    <td><?php echo $subscriber['newsletter_name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Inga prenumeranter för närvarande.</p>
    <?php endif; ?>
</body>
</html>
