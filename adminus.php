<!DOCTYPE html>
<?php/*
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day*/
?>
<html>
    <head>
        <title>TAB</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>

    <?php
    
    if(isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] == true) {
        echo $_COOKIE[$cookie_name];
    } else {

        header("Location: http://147.175.121.210:8065/zadanie10/chyba.php");

    }
    ?>

        <div id="wrap">
            <div class="container">
                <div class="row">
                    <form class="form-horizontal" action="admin.php" method="post" name="form" enctype="multipart/form-data">
                        <legend></legend>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button class="btn" name="delete"><i class="fa fa-trash"></i>  Vymaž predmet</button>
                                <button class="btn" name="print"><i class="fa fa-print"></i>  Vytlač tabuľku</button>
                                <button class="btn" name="vloz"><i class="fa fa-folder"></i>  Vlož údaje</button>
                                <button class="btn" name="zobraz"><i class="fa fa-bars"></i>  Zobraz tabuľku</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            get_all_records();
            ?>
        </div>
    </body>
</html>