<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styles.css">
</head>

<body>

    <h1 class="title">TELECHARGER SON AVATAR !</h1><br><br>
    <form class='form' method="post" enctype="multipart/form-data">
        <label for="imageUpload">Télécharge ton image</label>
        <input type="file" name="avatar" id="imageUpload" /><br><br>

        <label for="firstname">Ton prénom:</label>
        <input type="text" name="firstname" id="firstname"><br><br>

        <label for="lastname">Ton nom:</label>
        <input type="text" name="lastname" id="lastname"><br><br>

        <label for="age">Age:</label>
        <input type="number" name="age" id="age"><br><br>


        <label for="imageUpload">Upload a profile image</label>
        <input type="file" name="avatar" id="imageUpload" /><br><br>

        <button name="send">Envoyer</button>
        <button type="submit" name="submit">Submit</button>

    </form>


    <?php
    // inclure le fichier upload.php qui traite le formulaire
    include "upload.php";
    ?>


</body>

</html>