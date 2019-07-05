<?php

include "FaceDetector.php";

$detector = new svay\FaceDetector('detection.dat');
$detector->faceDetect('eibgv7kctah62iddzywm.jpg');
$detector->cropFaceToJpeg('eibgv7kctah62iddzywm_face.jpg');
echo "Success";



