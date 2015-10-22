<?php
/* the folder where the files will be placed */
$uploadPath = "uploads/";

/*
 * even though we are using a single input for form upload
 * this PHP script will handle forms with multiple upload input elements
 */
foreach($_FILES['upload'] AS $key => $value){
    /* test for any error */
    if ($_FILES['upload']['error'] == UPLOAD_ERR_OK) {
        /* get the temporary name of the upload file */
        $tmpName = $_FILES["upload"]["tmp_name"];
        /* get the original name of the uploaded file */
        $fileName = $_FILES["upload"]["name"];
        /* establish the path and name of the uploaded file */
        $newFile = $uploadPath.$fileName;
        /* move the uploaded file to its proper directory with its proper name */
        move_uploaded_file($tmpName, $newFile);
    }
}

/* 
 * redirect if javascript disabled
 * if javascript is enabled the jQuery process will add &javascript=yes 
 * to the serialized form data and skip this redirect. There will 
 * not be a page reload if javascript is enabled. $_POST['javascript'] will
 * contain the value 'yes'
 */
if('' == $_POST['javascript']){
    header("location: uploadForm.html");
} else {
    /* echo something to the screen for demo purposes */
    echo 'PEEK-A-BOO!!!';
}
?>