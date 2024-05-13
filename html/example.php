<?php
    $salt = "98Brs*3X_.WlfKATSjkzPSecc5#_IY!n=!ED/KA1E(!ZvmzJSnv2*oo+W8Q=wr(duuNqx7gcUok5j_qK:q1P7bD=GKDQpmb5a=+SgI72a+z-dPFDN2aqTR(QqcU3uqIgaL6Ort).)E*laP)nTe?K3_azz)S-trwjt346lmCSV?5vw@Bw*yoi(dUKcf@DIclREUJXKJj_";
    //lösen som användaren har anget
    //todo: $password ska vara det användaren anget i formuläret
    $password = "mypassword";
    $hashed_password = (md5($salt.$password));

    echo($hashed_password);
?>