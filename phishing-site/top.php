<!--top.php run start-->
<?php
$phpSelf=htmlspecialchars($_SERVER['PHP_SELF']);
$pathParts=pathinfo($phpSelf);
?>
<!DOCTYPE HTML>
<html lang="en">
<!-- Begin Head -->
    <head>
        <meta charset="utf-8">
        <title>Phishing Relief</title>
        <meta name="author" content="Alexander Schaefer">
        <meta name="description" content="Phishing Project for the 2024 UVM Hackathon">
        <link rel="SHORTCUT ICON" type="image/x-icon" href="images/logo.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            
        
        <link rel="stylesheet" 
        href="css/custom.css?version=<?php print time(); ?>" 
        type="text/css">
    </head>
    <?php
    print '<body class="' . $pathParts['filename'] . '">';
    print '<!-- Begin Body Element -->';

    include 'connect-DB.php';
    print PHP_EOL;
    include 'header.php';
    print PHP_EOL;
    include 'nav.php';
    print PHP_EOL;
    ?>
<!--top.php run end-->
