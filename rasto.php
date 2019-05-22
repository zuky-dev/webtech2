<?php
require_once 'assets/php/configR.php';

//https://stackoverflow.com/questions/7999148/escaping-quotation-marks-in-php
function escapeJavaScriptText($string) {
    return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\")));
}


if(dbConnect()){
    $email_templates = dbStatement("SELECT * from mail_templates", true);
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
                <a class="nav-link" href="rasto.php">Úloha 3</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="rasto2.php">Úloha 3 tabuľka</a>
            </li>
        </ul>
    </div>
</nav>

<main role="main" class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="starter-template">
                <h2>Úloha 3</h2>
                <hr>
                <h3>Prvé načítanie súboru</h3>
                <p>Heslá budú zapísané do stĺpca E.</p>
                <div class="card bg-light">
                    <div class="card-body">

                        <form id="firstForm">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Oddelovač v CSV. súbore</label>
                                <select name="delimiter" class="form-control" id="exampleFormControlSelect1">
                                    <option value="comma">, - Čiarka</option>
                                    <option value="semicolon">; - Bodkočiarka</option>
                                </select>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="exampleFormControlFile1">.CSV súbor, do ktorého budú zapisané nové heslá pre študentov</label>
                                <input id="inputFileFirst" name="file" type="file" class="form-control-file">
                            </div>

                            <input id="firstSubmitButton" class="btn btn-sm btn-primary float-right" type="submit" value="Odoslať">
                        </form>

                        <div>
                            <a id="downloadFirst" class="btn btn-md btn-success" target="_blank" href="" style="margin: 0 auto; width: 125px; margin-top: 80px;">Stiahnuť súbor</a>
                        </div>

                    </div>
                </div>

                <hr>

                <h3>Druhé načítanie súboru</h3>
                <div class="card bg-light">
                    <div class="card-body">

                        <form action="form.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Súbor s užívateľmi</label>
                                <input name="usersFile" type="file" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Oddelovač v CSV. súbore</label>
                                <select name="delimiter" class="form-control" id="exampleFormControlSelect1">
                                    <option value=",">, - Čiarka</option>
                                    <option value=";">; - Bodkočiarka</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Názov správy</label>
                                <input name="titleMsg" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Vyberte emailovú šablónu</label>
                                <select id="emailTemplate" name="emailTemplate" class="form-control">
                                    <?php foreach($email_templates as $template): ?>
                                        <option value="<?php echo $template['id'] ?>"><?php echo $template['title'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Šablóna</label>
                                <textarea name="textarea" class="form-control" id="summernote" rows="3"></textarea>
                            </div>

                            <div class="form-check">
                                <input name="isHTML" type="checkbox" class="form-check-input">
                                <label class="form-check-label" for="exampleCheck1">Poslať ako HTML? (Inak plain text)</label>
                            </div>

                            <hr>
                            <h5>Údaje o odosielateľovi</h5>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meno</label>
                                <input name="sendername" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email odosielatela</label>
                                <input name="senderemail" type="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Heslo</label>
                                <input name="password" type="password" class="form-control">
                            </div>

                            <hr>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Príloha</label>
                                <input name="attachment" type="file" class="form-control-file">
                            </div>

                            <input class="btn btn-sm btn-primary float-right" type="submit" value="Odoslať">
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</main><!-- /.container -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bs4-summernote@0.8.10/dist/summernote-bs4.min.js"></script>

<script>
    var email_templates = [];
    <?php foreach($email_templates as $email_template): ?>
        tmp = new Object();
        tmp['text'] = '<?php echo escapeJavaScriptText($email_template['template']) ?>';
        tmp['id'] = '<?php echo $email_template['id'] ?>';
        email_templates.push(tmp);
    <?php endforeach; ?>
</script>

<script>
    $(function(){

        $('#summernote').summernote({
            height: 300
        });
        $('#summernote').summernote('insertText', '<?php echo escapeJavaScriptText($email_templates[0]['template']) ?>');

        $('#emailTemplate').on('change', function() {
            $('#summernote').summernote('code', '');
            for (var i = 0, max = email_templates.length; i < max; i++) {
            	if (email_templates[i].id == this.value) {
                    $('#summernote').summernote('insertText', email_templates[i].text);
                }
            }
        });

        // First form.
    	$('#firstForm').on('submit', function(e) {
    	    e.preventDefault();

            var file_data = $('#inputFileFirst').prop('files')[0];

            var form_data = new FormData();

            form_data.append('file', file_data);
            form_data.append('data', $(this).serialize());
            form_data.append("method", "first");


    	    $.ajax({
    	    	type: "POST",
    	    	url: "ajax.php",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
    	    	dataType: "json",
    	    	success: function (response) {
                    if (response.source_file != null) {
                        $('#downloadFirst').attr('href', response.source_file);
                        $('#downloadFirst').fadeIn();
                    }
    	    	}
    	    });
        });
    });
</script>
</body>
</html>
