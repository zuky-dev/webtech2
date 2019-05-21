<!DOCTYPE html>
<html>
    <head>
        <title>ADMIN</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div id="wrap">
            <div class="container">
                <div class="row">
                    <form class="form-horizontal" action="dajDoDbs.php" method="post" name="go" enctype="multipart/form-data">
                        <fieldset>
                            <!-- Form Name -->
                            <legend></legend>

                            <?php

                                if (isset($_POST["vloz"])){
                                    echo "<div class=\"form-group\">
                                            <label class=\"col-md-4 control-label\" >Školský rok: </label> </br>
                                            <div class=\"col-md-4\">
                                                <select name=\"skRok\" id=\"skRok\" class=\"input-large\">
                                                    <option>2020/2021</option>
                                                    <option>2019/2020</option>
                                                    <option>2018/2019</option>
                                                    <option>2017/2018</option>
                                                    <option>2016/2017</option>
                                                    <option>2015/2016</option>
                                                    <option>2014/2015</option>
                                                    <option>2013/2014</option>
                                                    <option>2012/2013</option>
                                                    <option>2011/2012</option>
                                                    <option>2010/2011</option>
                                                    <option>2009/2010</option>
                                                </select>
                                            </div>
                                        </div>";

                                    echo "<div class=\"form-group\">
                                            <label class=\"col-md-4 control-label\">Názov predmetu: </label> </br>
                                            <div class=\"col-md-4\">
                                                <input type=\"text\" name=\"predmet\" id=\"predmet\" class=\"input-large\">
                                            </div>
                                        </div>";

                                    echo "<div class=\"form-group\">
                                        <label class=\"col-md-4 control-label\" for=\"filebutton\">CSV súbor: </label> </br>
                                        <div class=\"col-md-4\">
                                            <input type=\"file\" name=\"csv\" id=\"csv\" class=\"input-large\">
                                        </div>
                                    </div>";

                                    echo "<div class=\"form-group\">
                                        <label class=\"col-md-4 control-label\" for=\"filebutton\">Oddeľovač: </label> </br>
                                        <div class=\"col-md-4\">
                                            <input type=\"text\" name=\"oddelovac\" id=\"oddelovac\" class=\"input-large\">
                                        </div>
                                    </div>";


                                    echo "<div class=\"form-group\">
                                        <label class=\"col-md-4 control-label\" for=\"singlebutton\">Import data</label>
                                        <div class=\"col-md-4\">
                                            <button type=\"submit\" id=\"submit\" name=\"vloz\" class=\"btn btn-primary button-loading\" data-loading-text=\"Loading...\">Import</button>
                                        </div>
                                    </div>";
                                }


                                if (isset($_POST["zobraz"])){
                                    echo "<div class=\"form-group\">
                                        <label class=\"col-md-4 control-label\" >Školský rok: </label> </br>
                                        <div class=\"col-md-4\">
                                            <select name=\"skRok\" id=\"skRok\" class=\"input-large\">
                                                <option>2020/2021</option>
                                                <option>2019/2020</option>
                                                <option>2018/2019</option>
                                                <option>2017/2018</option>
                                                <option>2016/2017</option>
                                                <option>2015/2016</option>
                                                <option>2014/2015</option>
                                                <option>2013/2014</option>
                                                <option>2012/2013</option>
                                                <option>2011/2012</option>
                                                <option>2010/2011</option>
                                                <option>2009/2010</option>
                                            </select>
                                        </div>
                                    </div>";

                                    echo "<div class=\"form-group\">
                                        <label class=\"col-md-4 control-label\">Názov predmetu: </label> </br>
                                        <div class=\"col-md-4\">
                                            <input type=\"text\" name=\"predmet\" id=\"predmet\" class=\"input-large\">
                                        </div>
                                    </div>";

                                    echo "<div class=\"form-group\">
                                        <label class=\"col-md-4 control-label\" for=\"singlebutton\">Import data</label>
                                        <div class=\"col-md-4\">
                                            <button type=\"submit\" id=\"submit\" name=\"zobraz\" class=\"btn btn-primary button-loading\" data-loading-text=\"Loading...\">Import</button>
                                        </div>
                                    </div>";
                                }

                            if (isset($_POST["print"])){
                                echo "<div class=\"form-group\">
                                    <label class=\"col-md-4 control-label\" >Školský rok: </label> </br>
                                    <div class=\"col-md-4\">
                                        <select name=\"skRok\" id=\"skRok\" class=\"input-large\">
                                            <option>2020/2021</option>
                                            <option>2019/2020</option>
                                            <option>2018/2019</option>
                                            <option>2017/2018</option>
                                            <option>2016/2017</option>
                                            <option>2015/2016</option>
                                            <option>2014/2015</option>
                                            <option>2013/2014</option>
                                            <option>2012/2013</option>
                                            <option>2011/2012</option>
                                            <option>2010/2011</option>
                                            <option>2009/2010</option>
                                        </select>
                                    </div>
                                </div>";

                                echo "<div class=\"form-group\">
                                    <label class=\"col-md-4 control-label\">Názov predmetu: </label> </br>
                                    <div class=\"col-md-4\">
                                        <input type=\"text\" name=\"predmet\" id=\"predmet\" class=\"input-large\">
                                    </div>
                                </div>";

                                echo "<div class=\"form-group\">
                                    <label class=\"col-md-4 control-label\" for=\"singlebutton\">Import data</label>
                                    <div class=\"col-md-4\">
                                        <button type=\"submit\" id=\"submit\" name=\"print\" class=\"btn btn-primary button-loading\" data-loading-text=\"Loading...\">Import</button>
                                    </div>
                                </div>";
                            }

                            if (isset($_POST["delete"])){
                                echo "<div class=\"form-group\">
                                    <label class=\"col-md-4 control-label\" >Školský rok: </label> </br>
                                    <div class=\"col-md-4\">
                                        <select name=\"skRok\" id=\"skRok\" class=\"input-large\">
                                            <option>2020/2021</option>
                                            <option>2019/2020</option>
                                            <option>2018/2019</option>
                                            <option>2017/2018</option>
                                            <option>2016/2017</option>
                                            <option>2015/2016</option>
                                            <option>2014/2015</option>
                                            <option>2013/2014</option>
                                            <option>2012/2013</option>
                                            <option>2011/2012</option>
                                            <option>2010/2011</option>
                                            <option>2009/2010</option>
                                        </select>
                                    </div>
                                </div>";

                                echo "<div class=\"form-group\">
                                    <label class=\"col-md-4 control-label\">Názov predmetu: </label> </br>
                                    <div class=\"col-md-4\">
                                        <input type=\"text\" name=\"predmet\" id=\"predmet\" class=\"input-large\">
                                    </div>
                                </div>";

                                echo "<div class=\"form-group\">
                                    <label class=\"col-md-4 control-label\" for=\"singlebutton\">Import data</label>
                                    <div class=\"col-md-4\">
                                        <button type=\"submit\" id=\"submit\" name=\"delete\" class=\"btn btn-primary button-loading\" data-loading-text=\"Loading...\">Import</button>
                                    </div>
                                </div>";
                            }

                            ?>


                        </fieldset>
                    </form>
                </div>
                <?php
                get_all_records();
                ?>
            </div>
        </div>
    </body>
</html>




