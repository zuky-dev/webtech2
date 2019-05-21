<?php

require_once './vendor/autoload.php';

if ($_POST['method'] == 'first') {

    if ($_FILES['file']['type'] != 'application/vnd.ms-excel') {

        die('Wrong format file');
    }

    $filename = time() . '_' . $_FILES['file']['name'];
    $file_path = getcwd() . '/upload/' . $filename; 

    move_uploaded_file( $_FILES['file']['tmp_name'], $file_path );

    chmod($file_path, 0777);

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    $reader->setDelimiter($form_data['delimiter']);
    $reader->setEnclosure('');
    $reader->setSheetIndex(0);

    $spreadsheet = $reader->load($file_path);

    $i = 1;
    foreach ( $spreadsheet->getActiveSheet()->toArray() as $row) {
        // If row is empty then skip iteration.
        if ($row['0'] == 0) {
            continue;
        }

        // If this is first row.
        if ($i == 1) {
            write_price_to_position('heslo', 'E1', $spreadsheet, $file_path);
            $i++;
        }

        $new_password = generatePassword(15);

        // Write password to file
        write_price_to_position($new_password, 'E' . $i, $spreadsheet, $file_path);

        $i++;
    }

    echo json_encode( [
        'source_file' => 'upload/' . $filename
    ] );


} else if ($_POST['method'] == 'second') {

    echo "Second form";

}



//################### Functions

/**
 * Genetates password from the set of characters.
 * https://stackoverflow.com/questions/1837432/how-to-generate-random-password-with-php
 *
 * @param int $length
 *
 * @return string
 */
function generatePassword($length = 15) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!?()~';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}

function write_price_to_position($value, $position, $spreadsheet, $file_path) {
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue($position, $value);

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $writer->setUseBOM(true);
    $writer->save($file_path);
}

