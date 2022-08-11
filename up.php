<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Include the upload handler class
require_once "handler.php";

class Up extends CI_Controller {

public function index()
	{


$uploader = new UploadHandler();

// Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
$uploader->allowedExtensions = array(); // all files types allowed by default

// Specify max file size in bytes.
$uploader->sizeLimit = 1 * 1024 * 1024; // default is 10 MiB

// Specify the input name set in the javascript.
$uploader->inputName = "qqfile"; // matches Fine Uploader's default inputName value by default

// If you want to use the chunking/resume feature, specify the folder to temporarily save parts.
$uploader->chunksFolder = "chunks";

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST") {
    header("Content-Type: text/plain");

    $TargetDir = 'user_data//'.$this->session->userdata('parentid');
	if (!file_exists($TargetDir)) {
    mkdir($TargetDir, 0777, true);
    }
	
	
	$uploader->SecondDirectory = $TargetDir;
	
	
	$TargetDir = 'user_data//tmp';
	
    // Call handleUpload() with the name of the folder, relative to PHP's getcwd()
    $result = $uploader->handleUpload($TargetDir);
	

    // To return a name used for uploaded file you can use the following line.
    $result["uploadName"] = $uploader->getUploadName();
	$result["fullpath"] = site_url('user_data/tmp/'.$uploader->getUploadName());

    echo json_encode($result);
}
else {
    header("HTTP/1.0 405 Method Not Allowed");
}

}

}