<?php 

include "db.php";
$sil = $db->prepare("delete from data where URL=:URL");
$kontrol = $sil->execute(array(
	"URL" => $_GET["URL"]
));

if($kontrol){
	header("location:admin.php");
	exit;
}

?>