<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            background-color: whitesmoke;

            margin: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: white;
            color: #333;
            padding: 10px 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            color: #333;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            background-color: #fff;
            border: 1px solid #ccc;
        }

        nav ul li a:hover {
            background-color: #e9ecef;
        }

        nav button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        nav button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <?php
                if (!is_signed_in()) {
              
                    echo '<li><a href="/newsletter/show-all-newsletters.loggedout.php">Nyhetsbrev</a></li>';       
                    echo '<li><a href="/index.php">Logga in</a></li>';
                    echo '<li><a href="/account/create-account.php">Skapa konto</a></li>';
                } 
                  
                ?>
            </ul>
           
        </nav>
    </header>
</body>
</html>
