
<?php
    session_start();
    include 'config.php';
    error_reporting(E_ALL ^ E_NOTICE);
    ini_set('display_errors', 1);

    $oddelovac = $_POST['oddelovac'];
    $skRok = $_POST['skRok'];
    $predmet = $_POST['predmet'];
    $csv = $_FILES["csv"]["tmp_name"];
    //echo "$skRok<br>, $predmet<br>, $csv<br>, $oddelovac<br>";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if(isset($_POST["vloz"])) {

        $sql = "INSERT INTO Uloha1 (skRok,predmet) 
                       VALUES ('$skRok', '$predmet')";
        if ($conn->query($sql) === TRUE) {
            echo "Udaje boli uspesne nahrane do Uloha1.<br>";
        } else {
            echo 'Pocas pridavania udajov sa vyskytla chyba.' . mysqli_error($conn->query($sql));
        }

        $last_id = $conn->insert_id;
        //echo "<p> $last_id <br /></p>\n";

        //echo $_FILES["csv"]["size"];

        if ($_FILES["csv"]["size"] > 0) {

            $file = fopen($csv, "r");
            //var_dump($file);


            $premenna = 0;
            while (($getData = fgetcsv($file, 10000, ";")) !== FALSE) {
                //print_r($getData);


                if ($premenna == 0) {
                    $premenna++;
                    continue;
                }

                $body = $getData[0];
                $body1 = $getData[1];
                $body2 = $getData[2];
                $body3 = $getData[3];
                $body4 = $getData[4];
                $body5 = $getData[5];
                $body6 = $getData[6];
                $body7 = $getData[7];
                $body8 = $getData[8];
                //echo "<p> $body <br />$body1 <br />$body2 <br />$body3 <br />$body4 <br />$body5 <br />$body6 <br />$body7 <br />$body8</p>\n";

                $idStudent = $getData[0];
                $meno = $getData[1];
                $prednaska = $getData[2];
                $cvicenie = $getData[3];
                $zapocty = $getData[4];
                $projekt = $getData[5];
                $skuska = $getData[6];
                $spolu = $getData[7];
                $znamka = $getData[8];



                $sql2 = "INSERT INTO Predmet (idStudent,meno,prednaska,cvicenie,zapocty,projekt,skuska,spolu,znamka,id_uloha1 ) 
                        VALUES ('$idStudent','$meno','$prednaska','$cvicenie','$zapocty','$projekt','$skuska','$spolu','$znamka',$last_id )";

                $result2 = mysqli_query($conn, $sql2); //or die (mysqli_error($conn))


                if (($result2)/*$conn->query($sql2) === TRUE*/) {
                    echo "Udaje boli uspesne nahrane do Predmet.<br>";

                } else {
                    echo 'Pocas pridavania udajov sa vyskytla chyba. <br />' . mysqli_error($conn->query($sql2));
                }
            }
            fclose($file);
        }
    }


    if(isset($_POST["zobraz"])) {

        $sql3 = "SELECT id_uloha1 FROM Uloha1 WHERE predmet = '$predmet'";
        $result = $conn->query($sql3);
        $row = $result->fetch_assoc();
        $fk = $row['id_uloha1'];
        //echo "<p> $fk <br /></p>\n";

        $Sql4 = "SELECT idStudent,meno,prednaska,cvicenie,zapocty,projekt,skuska,spolu,znamka FROM Predmet JOIN Uloha1 ON Predmet.id_uloha1 = Uloha1.id_uloha1 WHERE Uloha1.id_uloha1 = '$fk' AND Uloha1.skRok = '$skRok' ";
        $result4 = mysqli_query($conn, $Sql4);
        //var_dump($result4);
        if (mysqli_num_rows($result4) > 0) {
            echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
            <thead><tr><th>ID</th>
                <th>Meno</th>
                <th>Prednaska</th>
                <th>Cvicenie</th>
                <th>Zapocty</th>
                <th>Projekt</th>
                <th>Skuska</th>
                <th>Spolu</th>
                <th>Znamka</th>
            </tr></thead><tbody>";
            while ($row4 = mysqli_fetch_assoc($result4)) {
                echo "<tr><td>" . $row4['idStudent'] . "</td>
                <td>" . $row4['meno'] . "</td>
                <td>" . $row4['prednaska'] . "</td>
                <td>" . $row4['cvicenie'] . "</td>
                <td>" . $row4['zapocty'] . "</td>
                <td>" . $row4['projekt'] . "</td>
                <td>" . $row4['skuska'] . "</td>
                <td>" . $row4['spolu'] . "</td>
                <td>" . $row4['znamka'] . "</td></tr>";
            }

            echo "</tbody></table></div>";

        } else {
            echo "you have no records";
        }

    }


    if(isset($_POST["delete"])) {

        $sql3 = "SELECT id_uloha1 FROM Uloha1 WHERE predmet = '$predmet' AND skRok = '$skRok'";
        $result = $conn->query($sql3);
        $row = $result->fetch_assoc();
        $fk = $row['id_uloha1'];
        //echo "<p> $fk <br /></p>\n";

        $sql1 = "delete from Predmet where id_uloha1 in(select id_uloha1 from Uloha1 where id_uloha1 = '$fk')";
        $result1 = mysqli_query($conn, $sql1) or die (mysqli_error($conn));
        $sql2 = "delete from Uloha1 where id_uloha1 = '$fk'";
        $result2 = mysqli_query($conn, $sql2) or die (mysqli_error($conn));

        if ($result2) {
            echo "Udaje boli uspesne vymazane.<br>";

        } else {
            echo 'Pocas vymazavania udajov sa vyskytla chyba. <br />' . mysqli_error($conn->query($sql2));
        }
    }


    if(isset($_POST["print"])) {

          $sql3 = "SELECT id_uloha1 FROM Uloha1 WHERE predmet = '$predmet'";
        $result = $conn->query($sql3);
        $row = $result->fetch_assoc();
        $fk = $row['id_uloha1'];
        //echo "<p> $fk <br /></p>\n";

        $Sql4 = "SELECT idStudent,meno,prednaska,cvicenie,zapocty,projekt,skuska,spolu,znamka FROM Predmet JOIN Uloha1 ON Predmet.id_uloha1 = Uloha1.id_uloha1 WHERE Uloha1.id_uloha1 = '$fk' AND Uloha1.skRok = '$skRok' ";
        $result4 = mysqli_query($conn, $Sql4);
        //var_dump($result4);
        if (mysqli_num_rows($result4) > 0) {

         $html2 = '  <table>
            <thead><tr><th>ID</th>
                <th>Meno</th>
                <th>Prednaska</th>
                <th>Cvicenie</th>
                <th>Zapocty</th>
                <th>Projekt</th>
                <th>Skuska</th>
                <th>Spolu</th>
                <th>Znamka</th>
            </tr></thead><br><tbody>';
            $html3 = '';
            while ($row4 = mysqli_fetch_assoc($result4)) {
              $html3 =  $html3 . '<tr><td> '. $row4['idStudent'] .' </td>
                <td>'.$row4['meno'].'</td>
                <td>' . $row4['prednaska'] . '</td>
                <td>' . $row4['cvicenie'] . '</td>
                <td>' . $row4['zapocty'] . '</td>
                <td>' . $row4['projekt'] . '</td>
                <td>' . $row4['skuska'] . '</td>
                <td>' . $row4['spolu'] . '</td>
                <td>' . $row4['znamka'] . '</td></tr><br>';
            }

            $html4 = '</tbody></table></div>';

        } else {
            echo "you have no records";
        }

        $html = $html2 . $html3 . $html4;


       include("lib/mpdf/mpdf.php");
              $mpdf=new mPDF('c','A4','','',32,25,27,25,16,13);
              $mpdf->SetDisplayMode('fullpage');
              $css = "table {  border: 2px solid black; border-collapse: collapse; } td, th { font-family: freeserif; padding: 4px; border: 1px solid black; text-align: center; }";
              $mpdf->WriteHTML($css,1);
              $mpdf->WriteHTML($html,2);
              $mpdf->Output('lib/mpdf/mpdf.pdf','I');
        exit;

    }
?>


