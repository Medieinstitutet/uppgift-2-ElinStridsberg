<?php
include_once('../functions.php');
connect_database();
include_once('../components/header.php');

$success_message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newsletter_id = $_POST['newsletter_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';

    if (!empty($newsletter_id) && !empty($name) && !empty($description)) {
        update_newsletter($newsletter_id, $name, $description);
        $success_message = '<p class="success">' ."Nyhetsbrev uppdaterat!.". '</p>';
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Update Newsletter</title>
    <style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
         
        }

        h1 {
            text-align: center;
            margin-top: 90px;
            margin-bottom: 50px;
        }

        .editNewsletters {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        textarea{
            font-family: Arial, sans-serif;
            

        } 
        p{
            text-align: center;
        }
        .success{
            color: green;
        
        }
    </style>
</head>
<body>
    <h1>Redigera nyhetsbrev</h1>

    <?php
    if (!empty($success_message)) {
        echo "<p>$success_message</p>"; 
    }
    ?>

    <form class='editNewsletters' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="newsletter_id" value="<?php echo htmlspecialchars($newsletter_id, ENT_QUOTES, 'UTF-8'); ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></textarea><br>
        <button type="submit">Update Newsletter</button>
    </form>

</body>
</html>
