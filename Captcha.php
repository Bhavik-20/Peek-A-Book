<?php 
session_start();

create_image();

function create_image()
{	
	//generating random code
	$md5_hash= md5(rand(0,999));
	$captcha = substr($md5_hash, 15,5);

	$_SESSION['captcha'] = $captcha;
	$width=150;
	$height=60;
	$image = imagecreate($width, $height);
	 //colors
	$white=imagecolorallocate($image, 255, 255, 255);
	$black=imagecolorallocate($image, 0, 0, 0);

	//making background
	imagefill($image,0,0,$black);
	//$font= 'C:\xampp\htdocs\WP2\BookStore\Roboto-Regular.ttf';
	// $font= 'C:\xampp\htdocs\BookStore-Peek-a-book\Roboto-Regular.ttf';
	$font= 'Roboto-Regular.ttf';
	//$font = mb_convert_encoding($font, 'big5', 'utf-8');
	//carving txt to img
	//echo "$captcha";
	imagettftext($image, 20, 8, 45, 45, $white, $font, $captcha);

	//informing browser about filetype
	header("Content-Type: image/jpeg");
	imagejpeg($image); //converting img to jpeg
	//clearing cache
	imagedestroy($image);
}
?>