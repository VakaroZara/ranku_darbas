<?php
	$connect = mysqli_connect("localhost", "root", "", "parduotuve");
		$connect -> set_charset("utf-8");
		$id = $_GET['id'];

		$query = "DELETE FROM kategorijos WHERE id='$id'";
		$data = mysqli_query($connect, $query);
		if($data){
			echo "<script>alert('Kategorija panaikinta')</script>";
?>
			<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/ranku_darbas/adminKategorijos.php">
			<?php
		}else{
			echo "Apgeilestaujame, nepavyko panaikinti duomenų.";
		}
			?>

<!DOCTYPE html> <!--KOMENTARAI-->
<html lang="lt">
	<head>
		<title>Rankų_Darbas.lt</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>



	<body style="margin:0px;">
		<div class="header"><a href="admin.php" ><img class="logo" src="images/foto/logofoto.svg"></a></div>
		<p style="margin-left:10%;">Prašome palaukti, puslapis kraunasi.</p>
		<div class="footer">2019&copy;</div>
	</body>
</html>
