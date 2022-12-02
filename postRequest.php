<?php
function getData($string, $FilePath){
    // data fields for POST request
    $fields = array("key" => $string, "key" => "value");

    // files to upload
    $filenames = array($FilePath);

    $files = array();
    foreach ($filenames as $f){
    $files[$f] = file_get_contents($f);
    }

    // URL to upload to
    $url = "weburl";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    //$url_data = http_build_query($data);
    $boundary = uniqid();
    $delimiter = '-------------' . $boundary;
    $post_data = build_data_files($boundary, $fields, $files);

    curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    //CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => $post_data,
    CURLOPT_HTTPHEADER => array(
        //"Authorization: Bearer $TOKEN",
        "Content-Type: multipart/form-data; boundary=" . $delimiter,
        "Content-Length: " . strlen($post_data)
    ),
    ));
    $response = curl_exec($curl);
    return $response;
}

function build_data_files($boundary, $fields, $files){
    $data = '';
    $eol = "\r\n";
    $delimiter = '-------------' . $boundary;
    foreach ($fields as $name => $content) {
        $data .= "--" . $delimiter . $eol
            . 'Content-Disposition: form-data; name="' . $name . "\"".$eol.$eol
            . $content . $eol;
    }
    foreach ($files as $name => $content) {
        $data .= "--" . $delimiter . $eol
            . 'Content-Disposition: form-data; name=your post field name here; filename="' . $name . '"' . $eol
            . 'Content-Transfer-Encoding: binary'.$eol
            ;
        $data .= $eol;
        $data .= $content . $eol;
    }
    $data .= "--" . $delimiter . "--".$eol;
    return $data;
}

$file = fopen("file path to save","wb");
fwrite($file, getData('string','filepath'));
fclose($file);
?>
