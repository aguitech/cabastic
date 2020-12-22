<?php
// example of a PHP server code that is called in `uploadUrl` above


include_once("db.php");
 


$varr="";

foreach ($_POST as $key => $value){
    $varr .= " -POST- ". $key.'='.$value.'<br />';
}

foreach ($_GET as $key => $value){
    $varr .= " -GETT- ". $key.'='.$value.'<br />';
}


if ($_FILES['file-input']) {
    $file_ary = reArrayFiles($_FILES['file-input']);

    foreach ($file_ary as $file) {
        $varr .=  'File Name: ' . $file['name'];
        $varr .=  'File Type: ' . $file['type'];
        $varr .=  'File Size: ' . $file['size'];
    }
}


if ($_FILES['file-input-batch']) {
    $file_ary = reArrayFiles($_FILES['file-upload-batch']);

    foreach ($file_ary as $file) {
        $varr .=  'File Name: ' . $file['name'];
        $varr .=  'File Type: ' . $file['type'];
        $varr .=  'File Size: ' . $file['size'];
    }
}

if ($_FILES['file_id']) {
    $file_ary = reArrayFiles($_FILES['file_id']);

    foreach ($file_ary as $file) {
        $varr .=  'File Name: ' . $file['name'];
        $varr .=  'File Type: ' . $file['type'];
        $varr .=  'File Size: ' . $file['size'];
    }
}

/*
if ($_FILES['file_data']) {
    $file_ary = reArrayFiles($_FILES['file_data']);

    foreach ($file_ary as $file) {
        $varr .=  'File Name: ' . $file['name'];
        $varr .=  'File Type: ' . $file['type'];
        $varr .=  'File Size: ' . $file['size'];
    }
}
*/


//$elvar = print_r($_FILES);

 $qt = "INSERT INTO `intranet_dump` (`id_dump`, `dumps`, `datos`, `echa`) VALUES (NULL, '".$elvar."', '".$varr."', '');";

$resultt = $mysqli->query($qt);
 


// file-upload-batch script
header('Content-Type: application/json'); // set json response headers
$outData = upload(); // a function to upload the bootstrap-fileinput files
echo json_encode($outData); // return json data
exit(); // terminate
 
// main upload function used above
// upload the bootstrap-fileinput files
// returns associative array
function upload() {
    $preview = $config = $errors = [];
    $input = 'file_data'; // the input name for the fileinput plugin
    //if (empty($_FILES[$input])) {
    //    return [];
    
    $total = count($_FILES[$input]['name']); // multiple files
    $path = './upload/'; // your upload path
   
        $tmpFilePath = $_FILES[$input]['tmp_name']; // the temp file path
        $fileName = $_FILES[$input]['name']; // the file name
        $fileSize = $_FILES[$input]['size']; // the file size
        
        //Make sure we have a file path
        if ($tmpFilePath != ""){
            //Setup our new file path
            $newFilePath = $path . rand(1,32423) . "_" . $fileName;
            $newFileUrl = 'http://sdm-robotics.com/panel-de-control/upload/' . $fileName;
            
            //Upload the file into the new path
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                $fileId = $fileName . $i; // some unique key to identify the file
                $preview[] = $newFileUrl;
                $config[] = [
                    'key' => $fileId,
                    'caption' => $fileName,
                    'size' => $fileSize,
                    'downloadUrl' => $newFileUrl, // the url to download the file
                    'url' => 'http://localhost/delete.php', // server api to delete the file based on key
                ];
            } else {
                $errors[] = $fileName;
            }
        } else {
            $errors[] = $fileName;
        }

        $out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true];
        if (!empty($errors)) {
            $img = count($errors) === 1 ? 'file "' . $error[0]  . '" ' : 'files: "' . implode('", "', $errors) . '" ';
            $out['error'] = 'Oh snap! We could not upload the ' . $img . 'now. Please try again later.';
        }
        //return $out;
    
    
}

?>