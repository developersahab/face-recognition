<?php

include "FaceDetector.php";

 /* function will rename all dirs and files recursively
 * @param type $start_dir 
 * @param type $debug (set false if you don't want the function to echo)
 */
function rename_recursive($start_dir, $debug = true) {
    $str = "";
    $files = array();
    if (is_dir($start_dir)) {
        $fh = opendir($start_dir);
        while (($file = readdir($fh)) !== false) {
            // skip hidden files and dirs and recursing if necessary
            if (strpos($file, '.')=== 0) continue;

            $filepath = $start_dir . '/' . $file;
            if ( is_dir($filepath) ) {
                rename_recursive($filepath);
            } else {
				$eDirName =  dirname($filepath);
				$eFileName = basename($filepath);
				$fileBaseName = substr($eFileName, 0, strpos($eFileName, "."));
				$ext = substr(strrchr($eFileName,'.'),1);
				$newname = $eDirName.'/'.$fileBaseName.'_face.'.$ext;
				if (strpos($newname, '_face_face') !== false || file_exists($newname)) {
					//unlink($filepath);
				}
				else{				
					$detector = new svay\FaceDetector('detection.dat');
					$detector->faceDetect($filepath);
					$detector->cropFaceToJpeg($newname);
					echo $newname.'<br/>';
				}
            }
			
        }
        closedir($fh);
    }
}



$start_dir = '/xampp/htdocs/face-detection/images';
$files = rename_recursive($start_dir);



