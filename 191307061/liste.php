<?php 

include "db.php"; 

$sorgu = $db->prepare("select * from data"); 
$sorgu->execute();
?>

<!DOCTYPE html>
<html>
<head>
	<title> Liste </title>
</head>

<body>
<h2>URL Kısaltma Ulaş GÖNCÜOĞLU</h2>
<div class="outer-box">
	<div class="login-box">
		<h4 class="login-text">En çok Kullanılan Linkler</h4>
		<center>
			<table>
				<tr> 
					<th>Url</th>
					<th>Kısaltılmış link</th>
					<th>Tarih</th>
					<th>saat</th>
					<th>Tıklanma sayısı</th>
				</tr>

<?php 
	while($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
		if($satir["tikSay"]>="5"){
			echo "<tr>";
			echo "<td>$satir[URL]</td>";
			echo "<td>http://localhost/191307061/index.php?s=$satir[shorter]</td>";
			echo "<td>$satir[tarih]</td>";
			echo "<td>$satir[saat]</td>";
			echo "<td>$satir[tikSay]</td>";
			echo "</tr>";	
		}
	}
	
?>

				</table>
      </center>
    </div>
  </div>
<small>Tasarım Copyright 2017 WebmasterTakimi.com Tarafından alınmıştır <br> </small>


</body>









<style>

table {
	font-family: arial, sans-serif;
	border-collapse: collapse;
	width: 100%;
}

td, th {
	border: 1px solid #dddddd;
	text-align: top;
	padding: 8px;
	text-align: center;
}


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
    width: 80%;
	height: auto;
}

.outer-box {
    display: block;
    margin: auto;
    background: #6f92dc;
    border-radius: 5px;
    width: 80%;
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