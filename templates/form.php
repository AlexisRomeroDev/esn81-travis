<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<main>

    <form method="post">

        <?php

            if(isset($error)){
                echo "<p class='error'>" . $error . "</p>";
            }

        ?>
        <label for="email">Adresse email</label>
        <input type="text" name="email" id="email">

        <button type="submit">Envoyer</button>
    </form>

</main>

</body>
</html>