<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>zad11</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .kontener {
            display: flex;
            flex-direction: column;
            background: linear-gradient(to bottom, #00f, #000000);
        }
        .ramka {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: auto;
            min-width: 700px;
            max-width: 800px;
            height: auto;
            max-height: 500px;
            padding: 20px;
            margin-top: 50px;
        }
        label {
            padding-bottom: 10px;
            padding-top: 10px;
            color: white;
            margin: auto;
            font-weight: bolder;
            font-size: large;
        }
        input {
            padding: 10px;
            width: 300px;
            margin: auto;
            box-shadow: 0 0 10px white;
            cursor: pointer;
        }
        #tekst {
            width: 700px;
            margin-top: -10px;
            margin-bottom: 20px;
        }
        .pading {
            padding-bottom: 25px;
        }
        #tekst2 {
            margin-top: 10px;
            width: 700px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div style="display: flex; justify-content: center; align-items: center; flex-direction: column">
    <form class="kontener ramka" action="" method="post">
        <label class="pading">Logowanie:</label>
        <input type="email" name="email" id="tekst" placeholder="email" required>
        <input type="password" name="haslo" id="tekst2" placeholder="Hasło" required>
        <input type="submit" value="Zaloguj">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $podanyemail = $_POST["email"];
        $podanyhaslo = $_POST["haslo"];

        $linie = file("plik.txt", FILE_IGNORE_NEW_LINES);
        $zalogowano = false;

        foreach ($linie as $line) {
            list($imie, $nazwisko, $email, $haslo_hash) = explode(",", $line);
            if ($email == $podanyemail && password_verify($podanyhaslo, $haslo_hash)) {
                echo "Zalogowano prawidłowo!!!";
                $zalogowano = true;
                break;
            }
        }

        if (!$zalogowano) {
            echo "Nie zalogowano!!!";
        }
    }
    ?>
</div>
</body>
</html>
