 <?php   
        include 'config2.php';
        // fetch the data
        $conn = new mysqli($server, $username, $password, $db) or die("Connection failed: " . $conn->connect_error);     
        mysqli_set_charset($conn,"utf8");
        $sql ="SELECT s.id_student, s.name, st.pointsStudent FROM student AS s JOIN studentTeam AS st ON s.id_student = st.student_id 
           JOIN teams AS t ON t.id_team=st.team_id
           JOIN subjects AS sub ON sub.id_subject=t.subject_id WHERE sub.id_subject='".$_POST['taskOption']."' AND sub.years='".$_POST['taskOption2']. "'";
        $result= $conn->query($sql);
        mysqli_query($conn, $sql);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        
        // output the column headings
         fputcsv($output, array('ID','Meno','Body'));
        
        // loop over the rows, outputting them
        while ($row = $result->fetch_assoc()) 
          fputcsv($output, $row);     
?>