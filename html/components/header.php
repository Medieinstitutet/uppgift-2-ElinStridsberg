<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <style>
        /* Stilmall för navigationen */
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
                // Kontrollera om användaren är inloggad och har rollen "subscriber"
                if (is_signed_in() && user_has_role("subscriber")) {
                    // Om användaren är inloggad som "subscriber", visa länken "Mina Prenumerationer"
                    echo '<li><a href="/my-pages">Start</a></li>';
                    echo '<li><a href="/newsletter">Mina Prenumerationer</a></li>';
                    echo '<li><a href="/newsletter/show-all-newsletters.php">Nyhetsbrev</a></li>';       
                } else {
                    // Om användaren är inloggad som någon annan roll eller inte är inloggad, visa länken "Mina Nyhetsbrev"
                    echo '<li><a href="/my-pages">Start</a></li>';
                    echo '<li><a href="/newsletter/my-newsletters.php">Mina Nyhetsbrev</a></li>';
                    echo '<li><a href="/my-pages/subscriptions-customer.php">Mina prenumeranter</a></li>';
                   

                }
            
                ?>
            </ul>
            <form method="post" action="/login/logout.php">
                <button type="submit">Logga ut</button>
            </form>
        </nav>
    </header>
</body>
</html>
