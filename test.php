<?php


$csvdata = csv_in_array( "./examples/WordsList.csv");

foreach($csvdata as $line)
{
	$line = str_replace("\"", "", $line);
	$word_data = explode("-", $line);
    if (count($word_data) > 0) {
    	$word1 = $word_data[0];
        $fileName = "out/".ltrim(rtrim($word1)).".png";
        if (strlen($fileName) > 0)
        	saveToPng($line, $fileName);
    }
}

function csv_in_array($url) { 
    
    $delm = ",";
    $csvxrow = file($url);
    $i=0;

    foreach($csvxrow as $item) {
    	$item = substr($item, strpos($item, ",")+1);
    	if (strlen($item) > 4)
	     	$out[$i++] = $item;
     //    $csv_data = explode($delm, $item); 
     //    if (count($csv_data) > 0) {
	    //     $word = $csv_data[1];
	    //     if (strlen($word) > 0)
	    //     	$out[$i++] = $word;
	    // }
    }

	return $out; 
}


function saveToPng($text, $path) {
	// Create a 300x150 image
	$im = imagecreatetruecolor(640, 480);
	$black = imagecolorallocate($im, 0, 0, 0);
	$white = imagecolorallocate($im, 255, 255, 255);

	// Set the background to be white
	imagefilledrectangle($im, 0, 0, 640, 480, $white);
	$font = './fonts/micross.ttf';
	$text = wordwrap($text, 50, "\n");
	$bbox = imagettfbbox(24, 0, $font, $text);

	$x = imagesx($im)/2 - ($bbox[2] - $bbox[0])/2;
	$y = imagesy($im)/2 - ($bbox[1] - $bbox[7])/2+20;

	imagettftext($im, 24, 0, $x, $y, $black, $font, $text);

	imagepng($im, $path);
	imagedestroy($im);
}


?>