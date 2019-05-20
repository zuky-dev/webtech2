<?php
require_once 'assets/php/config.php';


if(dbConnect()){
    $logs = dbStatement("SELECT * from mail_logs ORDER BY sent asc", true);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Úloha 3</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.11/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <style>
        body {
            padding-bottom: 70px;
        }
        main {
            padding-top: 80px;
        }
        #downloadFirst {
            display: none;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Úloha 3</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/rasto.php">Úloha 3</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/rasto2.php">Úloha 3 tabuľka</a>
            </li>
        </ul>
    </div>
</nav>

<main role="main" class="container">
    <h1 style="text-align: center;">Logs</h1>
    <table id="example" class="table" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Title</th>
                <th>template_id</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($logs as $log): ?>
            <tr>
                <td><?php echo $log['id'] ?></td>
                <td><?php echo $log['student'] ?></td>
                <td><?php echo $log['title'] ?></td>
                <td><?php echo $log['template_id'] ?></td>
                <td><?php echo $log['sent'] ?></td>
            </tr>
        <?php endforeach; ?>
            <tr></tr>
        </tbody>
    </table>


</main><!-- /.container -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


</body>
</html>
