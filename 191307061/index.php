<meta charset="utf-8">
<?php 

include "db.php"; 

$sorgu = $db->prepare("select * from data"); 
$sorgu->execute();
?>

<!DOCTYPE html>
<html>
<head>
	<title> Giriş </title>
</head>

<!-- sayfenın url: https://codepen.io/webmastertakimi/pen/xPKJwX -->

<body>
<h2>URL Kısaltma Ulaş GÖNCÜOĞLU</h2>
<div class="outer-box">
	<div class="login-box">
		<h4 class="login-text">Sayfa uzantısı</h4>
		<center>
			<form method="POST" action="#">
				isim Soyisim: <input type="text" name="isim" placeholder="isim soyisim"><br>
				Sayfa URL: <input type="text" name="URL" placeholder="URL"><br>
				İsteğe bağlı Takma Ad: <input type="text" name="Takma" maxlength="10" placeholder="Kısaltma Link"><br>
				Tarih ayarı: <input type="date" name="tarih" placeholder="Tarih"><br>
				Saat ayarı: <input type="time" name="saat" placeholder="Saat"><br>
			<input type="submit" name="ekle" id="btn-login" value="Ekle">
			<input type="submit" name="liste" id="btn-forgot" value="En çok kullanılan URL">
			</form>
			
			
      </center>
    </div>
  </div>
<small>Tasarım Copyright 2017 WebmasterTakimi.com Tarafından alınmıştır<br></small>

	
</body>













<?php

if(isset($_POST["liste"])){
	header("Location:liste.php");
	exit;
}
?>


<?php

if(isset($_GET["s"])){
	$s = strip_tags($_GET["s"]);
	$control = $db->query("select * from data where shorter='".$s."'")->rowcount();
	if($s != "" and $control != "0"){
		$dataRow = $db->query("select * from data where shorter='".$s."'")->fetch();
		
		$yeniTik = ++$dataRow['tikSay'];
		$guncelle = $db->prepare("UPDATE data set tikSay=:tikSay where URL=:URL");
		$guncelle->execute(array("tikSay" => "$yeniTik", "URL" => $dataRow['URL'],));
		
		echo $dataRow['URL'];
		header("Location:".$dataRow['URL']."");
	}
	else{
		echo "<span> <br> Üzgünüz linkte bir sorun oluştu </span>";
	}
}
?>



<?php 
if(isset($_POST["ekle"])){
		
		
		$URL = $_POST["URL"];
		$isim = $_POST["isim"];
		$ip = $_SERVER["REMOTE_ADDR"];
		$tarih = $_POST["tarih"];
		$saat = $_POST["saat"];
		
		if($URL == Null){
			echo "<script> 
				alert('LütFen Sayfa URL bölümünü doldurunuz');
				window.location.href='index.php';
			</script>";
		}
		
		else{
			
			$count = $db->query("select * from data where URL='".$URL."'")->rowcount();
			
			if($count!=0){
				
				while($satir = $sorgu->fetch(PDO::FETCH_ASSOC)){
					
					if($satir["URL"] == $URL){
						
						$mevcutTarih = date('Y-m-d');
						$mevcutsaat = date('H:i:s');
						
						if(strtotime($satir["tarih"]) == strtotime($mevcutTarih) and strtotime($satir["saat"]) >= strtotime($mevcutsaat)){	
							$dataRow = $db->query("select * from data where URL='".$URL."'")->fetch();
							echo '<span> <br>Önceden hazırlanmış Linkiniz: http://localhost/191307061/index.php?s=</span>'.$dataRow['shorter'];
						}
						else if(strtotime($satir["tarih"]) >= strtotime($mevcutTarih)){
							$dataRow = $db->query("select * from data where URL='".$URL."'")->fetch();
							echo '<span> <br>Önceden hazırlanmış Linkiniz: http://localhost/191307061/index.php?s=</span>'.$dataRow['shorter'];
						}
						else{
							echo "<br> Tarihi Geçmiş URL";
						}
					}
				}
			}
			else {
				
				if($_POST["tarih"] == Null){
					$tarih = date('Y-m-d');
					$tarih = date('Y-m-d',strtotime('+1 day',strtotime($tarih)));
				}
				
				if($_POST["saat"] == Null){
					$saat = date('H:i:s');
					$saat = date('H:i:s',strtotime('+1 hour',strtotime($saat)));
				}
				
				
				if($_POST["Takma"] == Null){
					$shorter = substr(md5(rand()."-".$URL),0,10);
					$insert = $db->query("insert into data(ip,isim,URL,shorter,tarih,saat) values('$ip','$isim','$URL','$shorter','$tarih','$saat')");
					if($insert){
						echo '<br>Kayıt işleminiz başarı ile yapılmıştır Linkiniz: http://localhost/191307061/index.php?s='.$shorter;
					}
					else{
						echo "<br>Kayıt işlemi sırasında bir sorunla karşılaşıldı";
					}
				}
				else{
					$takma = $_POST["Takma"];
					$shorter = substr($takma."-".$URL,0,10);
					$insert = $db->query("insert into data(ip,isim,URL,shorter,tarih,saat) values('$ip','$isim','$URL','$shorter','$tarih','$saat')");
					if($insert){
						echo '<br>Kayıt işleminiz başarı ile yapılmıştır Linkiniz: http://localhost/191307061/index.php?s='.$shorter;
					}
					else{
						echo "<br>Kayıt işlemi sırasında bir sorunla karşılaşıldı";
					}
				}
			}
		}
}
?>










<style>
@import url(//fonts.googleapis.com/css?family=Lato:100,300,300i,400);

body {
  box-sizing: border-box;
  font-family: Lato, Arial;
  text-align: center;
  color: #eee;
  background-color: #000;

}

h2 {
  margin-top: 1em;
  margin-bottom: 1em;
  color: #eee;
  font-weight: 400;
  text-align: center;
  font-size: 200%;
  letter-spacing: 4px;
}

h4 {
  margin-top: 1em;
  color: #eee;
  font-size: 150%;
  font-weight: 300;
  text-align: center;
}

button {
  display: inline;
  background: #01A4E0;
  color: #2184AC;
  border: 0;
  padding: 4px;
}

input {
    display: block;
    width: 98%;
  height: 30px; 
    margin-top: 1.0em;
   padding: 4px;
}

small {
  display: inline-block;
  margin-top: 5px;
  color: white;
  font-size: 100%;
  color: #fff;
}

.login-box {
    padding: 1em 1em 1em 1em;
    margin: auto;
    text-align: center;
    display: block;
    background-color: #6f92dc;
    /*border: 1px dashed white;*/
    width: 60%;
  height: auto;
}

.outer-box {
    display: block;
    margin: auto;
    background: #6f92dc;
    border-radius: 5px;
    width: 50%;
    height: 20em;
  height: auto;
}

#btn-login {
  display: block;
  width: 100%;
  height: 40px;
  margin-top: 2.0em;
  border-radius: 4px;
  background-color: #3366cc;
  color: #fff;
}

#btn-forgot {
  display: block;
  width: 100%;
  margin-top: 1.0em;
  border-radius: 2px;
  color: #fff;
  background-color: #000D36;
}

</style>
</html>