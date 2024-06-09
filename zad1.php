<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>zad10</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 80px;
            background-color: #4fadd5;
        }
        .kontener {
            display: flex;
            flex-direction: column;
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            padding: 5px 20px 20px;
            background-color: #8ac8e3;
        }
        label {
            padding-bottom: 5px;
            padding-top: 5px;
            color: #ebf7ff;
            margin-top: 10px;
        }
        h1 {
            padding-top: 15px;
            font-weight: bolder;
            font-size: 30px;
            text-align: center;
            color: #ebf7ff;
        }
        textarea {
            height: auto;
            min-height: 40px;
            max-height: 80px;
            max-width: 600px;
            min-width: 450px;
            width: 600px;
            color: #41b2ff;
        }
        input {
            margin-top: 38px;
            height: 40px;
            cursor: pointer;
            color: #41b2ff;
        }
        input:hover {
            color: white;
            background-color: blue;
        }
    </style>
</head>
<body>
<form action="" method="post">
    <div class="kontener es">
        <h1>Rejestracja</h1>
        <label for="imie">Imię:</label>
        <textarea name="imie" id="imie" required></textarea>
        <label for="nazwisko">Nazwisko</label>
        <textarea name="nazwisko" id="nazwisko" required></textarea>
        <label for="email">Email:</label>
        <textarea name="email" id="email" required></textarea>
        <label for="haslo">Hasło:</label>
        <textarea name="haslo" id="haslo" required placeholder="Hasło powinno składać się z co najmniej 6 znaków, zawierać co najmniej 1 wielką literę, cyfrę oraz znak specjalny"></textarea>
        <input type="submit" value="Zarejestruj">

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $email = $_POST['email'];
            $haslo = $_POST['haslo'];

            if (strlen($haslo) < 6 || !preg_match("/[0-9]/", $haslo) || !preg_match("/[A-Z]/", $haslo) || !preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $haslo)) {
                echo "Wymagania hasła nie zostały spełnione!!!";
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Błędne dane email!!!";
                return;
            }

            $haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);

            $zawartosc = "$imie,$nazwisko,$email,$haslo_hash\n";

            $file = "plik.txt";
            if (file_put_contents($file, $zawartosc, FILE_APPEND)) {
                echo "Zapisano zawartość do bazy!";
            } else {
                echo "Nie udało się zapisać danych!!!";
            }

            header("Location: zad.php");
            exit();
        }
        ?>
    </div>
</form>
</body>
</html>
