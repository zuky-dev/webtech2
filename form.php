<?php

require_once './vendor/autoload.php';
require_once './assets/php/configR.php';

use PHPMailer\PHPMailer\PHPMailer;

/*if ( $_FILES['usersFile']['type'] != 'application/vnd.ms-excel' ) {
    die( 'Wrong format file' );
}*/

// Upload first file.
$filename  = time() . '_' . $_FILES['usersFile']['name'];
$file_path = getcwd() . '/upload/' . $filename;
move_uploaded_file( $_FILES['usersFile']['tmp_name'], $file_path );

// Upload attachement.
$filename2  = time() . '_' . $_FILES['attachment']['name'];
$file_path2 = getcwd() . '/upload/' . $filename;
move_uploaded_file( $_FILES['attachment']['tmp_name'], $file_path );


$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
$reader->setDelimiter( trim( $_POST['delimiter'] ) );
$reader->setEnclosure( '' );
$reader->setSheetIndex( 0 );

$spreadsheet = $reader->load( $file_path );
$document    = $spreadsheet->getActiveSheet()->toArray();

$i         = 1;
$first_row = [];
foreach ( $document as $key => $row ) {
    // If row is empty then skip iteration.

    // First row.
    if ( $i == 1 ) {
        $first_row = $row;
        $i ++;
        continue;
    }

    for ( $j = 0; $j < sizeof( $row ); $j ++ ) {
        $document[ $key ][ $first_row[ $j ] ] = $row[ $j ];
        $document[ $key ]['sender']           = $_POST['sendername'];
        unset( $document[ $key ][ $j ] );
    }
    unset( $document[0] );

    $i ++;
}


$email_text = $_POST['textarea'];
foreach ( $document as $data ) {

    foreach ( $data as $keyword => $value ) {
        $email_text = str_replace( "{{" . $keyword . "}}", $value, $email_text );
    }

    // Send email.
    save_log( $data['meno'], $_POST['titleMsg'], $_POST['emailTemplate'] );

    $mail = new PHPMailer( TRUE );
    send_email( $data['Email'], $_POST['senderemail'], $_POST['titleMsg'], $email_text, $mail, $file_path2, $_POST['password'], $_POST['emailTemplate'], $_POST['sendername'] );
}




//###################### Functions

function send_email( $email, $sender_email, $subject, $content, PHPMailer $mail, $attachment = FALSE, $password, $isHTML = TRUE, $sender_name = 'Mailer' ) {

    try {
        //Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'mail.stuba.sk';   // Specify main and backup SMTP servers
        $mail->SMTPAuth   = TRUE;                                   // Enable SMTP authentication
        $mail->Username   = 'xuhrinr1@stuba.sk';                      // SMTP username
        $mail->Password   = $password;                               // SMTP password
        $mail->SMTPSecure = 'starttls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
        $mail->CharSet    = 'UTF-8';

        //Recipients
        $mail->setFrom( $sender_email, $sender_name );

        $mail->addAddress( $email );               // Name is optional

        if ($attachment != FALSE) {
            # code...
            // Attachments
            $mail->addAttachment( $attachment );
        }

        // Content
        $mail->Subject = $subject;

        if ( $isHTML ) {
            $mail->isHTML( TRUE );                                  // Set email format to HTML
            $mail->Body = $content;
        } else {
            $mail->AltBody = $content;
        }

        $mail->send();

        echo 'Message has been sent';
        echo "<hr>";
    } catch( Exception $e ) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}


function save_log( $name, $title, $templateID ) {
    if ( dbConnect() ) {
        dbStatement( "INSERT INTO mail_logs (student, title, template_id) VALUES ('$name', '$title', $templateID)", false );
    }
}