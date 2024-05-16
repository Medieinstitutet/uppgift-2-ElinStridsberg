<style>
        /* Flexbox för att centrera innehållet */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* Placera elementen i en kolumn */
            height: 100vh; /* Hela fönsterhöjden */
            margin: 0; /* Ta bort marginaler */
        }

        /* Styla knappen */
        button {
            padding: 10px 20px;
            font-size: 16px;
            margin-top: 20px; /* Lite utrymme överst för att separera från texten */
        }
    </style>

<?php
// Mailgun API-nyckel och domän
$api_key = '81e0b3e6988c5dfb2b57eff82d4efa92-32a0fef1-6a5c9100';
$domain = 'sandbox3eb0f57f114340529476de9043fa019c.mailgun.org';

// URL för att skicka e-post via Mailgun
$url = 'https://api.mailgun.net/v3/' . $domain . '/messages';

// Generera en slumpmässig kod
$random_code = bin2hex(random_bytes(16));

// Hämta e-postadressen från formuläret
$email = $_POST['email'];

// Formfält för e-postmeddelandet
$fields = [
    'from' => 'postmaster@sandbox3eb0f57f114340529476de9043fa019c.mailgun.org',
    'to' => $email,
    'subject' => 'Testmeddelande från Mailgun',
    'text' => $random_code
];
// var_dump($fields);
// Skapa en cURL-resurs
$ch = curl_init();

// Ange cURL-alternativ
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $api_key);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

// Utför cURL-anropet
$response = curl_exec($ch);

// Kontrollera om det uppstod något fel
if ($response === false) {
    // Hämta detaljerat felmeddelande från cURL
    $error_message = curl_error($ch);
    echo 'Ett fel inträffade: ' . $error_message;
} else {
    echo 'E-postmeddelandet skickades framgångsrikt!';
}
// Stäng cURL-resursen
curl_close($ch);

?>
<!-- Knapp för att gå tillbaka till indexsidan -->
<form action="/index.php" method="get">
    <button type="submit">Tillbaka till startsidan</button>
</form>
