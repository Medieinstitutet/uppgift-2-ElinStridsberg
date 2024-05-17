<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">

    <style>
        /* Stilmall för navigationen */
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
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
            color: #fff;
            text-decoration: none;
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
                    echo '<li><a href="/newsletter">Mina Prenumerationer</a></li>';
                    echo '<li><a href="/newsletter/show-all-newsletters.php">Nyhetsbrev</a></li>';       
                    echo '<li><a href="/my-pages">Start</a></li>';                    
                } else {
                    // Om användaren är inloggad som någon annan roll eller inte är inloggad, visa länken "Mina Nyhetsbrev"
                    echo '<li><a href="/newsletter/my-newsletters.php">Mina Nyhetsbrev</a></li>';
                    echo '<li><a href="/my-pages/subscriptions-customer.php">Mina prenumeranter</a></li>';
                    echo '<li><a href="/my-pages">Start</a></li>'; 
                   

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
