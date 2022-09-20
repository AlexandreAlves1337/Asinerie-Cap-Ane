<?php require '../controller/command.php'; ?> <!--appelle le fichier command-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $page->getTitre(); ?></title>
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
</head>
<body>
<?php require '../html/header.php'; ?>
<main>
    <?php $page->html(); ?> <!--appelle les fonctions html qui permet d'afficher les formulaires selon la page choisi-->
</main>
<?php require '../html/footer.php'; ?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v14.0" nonce="O321L70w"></script>
<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>