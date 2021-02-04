<?php
	$connect = mysqli_connect("localhost", "root", "", "parduotuve");
		$connect -> set_charset("utf-8");
		$id = $_GET['id'];

		$query = "DELETE FROM krepselis1 WHERE id='$id'";
		$data = mysqli_query($connect, $query);
		if($data){
			echo "<script>alert('Prekė pašalinta iš krepšelio')</script>";
?>
			<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/ranku_darbas/krepselis.php">
			<?php
		}else{
			echo "Apgeilestaujame, prekės nepavyko pašalinti.";
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
		<div class="header"><a href="Homepage.php" ><img class="logo" src="images/foto/logofoto.svg"></a></div>
		<p style="margin-left:10%;">Prašome palaukti, puslapis kraunasi.</p>
		<div class="footer">2019&copy;</div>
	</body>
</html>
