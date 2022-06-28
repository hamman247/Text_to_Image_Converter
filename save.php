<?php
//echo "test <br>";
require_once ("hidden/escape.php");
$n = $_REQUEST["n"]; //security key


$fp = fopen('/var/www/html/text_image_generator/test.txt', 'w');
    fwrite($fp, "https://167.99.146.165/text_image_generator/savedimages/image".$n.".png");
    fclose($fp);


//if (isset($GLOBALS["HTTP_RAW_POST_DATA"]))
//{
    // Get the data
    //$imageData=$_POST['image'];
    //$imageData=$GLOBALS['HTTP_RAW_POST_DATA'];
    $imageData=file_get_contents('php://input');
    //$imageData=$n;

        $n = escape($n);
		$imageData = escape($imageData);
        
        if ($n === FALSE || $imageData === FALSE) {
        $fp = fopen('/var/www/html/text_image_generator/test.txt', 'w');
        fwrite($fp, $n." ".$imageData." Escape Attack");
        fclose($fp);
        die();
        }

        if ($n === '' || $imageData === '') {
        $fp = fopen('/var/www/html/text_image_generator/test.txt', 'w');
        fwrite($fp, $n." ".$imageData." Access Attempt");
        fclose($fp);
        die();
        }

    // Remove the headers (data:,) part. 
    // A real application should use them according to needs such as to check image type
//    $filteredData=substr($imageData, strpos($imageData, ",")+1);

/*
    $fp = fopen('/var/www/html/text_image_generator/test.txt', 'w');
    //fwrite($fp, file_get_contents('php://input'));  //var_dump($_POST)
    fwrite($fp, gettype(file_get_contents('php://input')));
    fclose($fp);
*/

    // Need to decode before saving since the data we received is already base64 encoded
//    $unencodedData=base64_decode($filteredData);
    $unencodedData=base64_decode($imageData);

/*
$fp = fopen('/var/www/html/text_image_generator/test.txt', 'w');
    fwrite($fp, $unencodedData);
    fclose($fp);
*/
    //echo "unencodedData".$unencodedData;

    // Save file.  This example uses a hard coded filename for testing,
    // but a real application can specify filename in POST variable
  
//    $fp = fopen('/var/www/html/text_image_generator/test.png', 'wb');
    $fp = fopen('/var/www/html/text_image_generator/savedimages/image'.$n.'.png', 'wb');
    fwrite($fp, $unencodedData);
    fclose($fp);

//}


?>

