<?php
$zip = new ZipArchive;
if ($zip->open($_SERVER['DOCUMENT_ROOT'].'/Miralaw/vendors.zip') === TRUE) {
    $zip->extractTo($_SERVER['DOCUMENT_ROOT'].'/Miralaw/Vendors2');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}
echo  "<br> Ruta ".$_SERVER['DOCUMENT_ROOT'];
?>