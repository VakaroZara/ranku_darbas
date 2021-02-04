<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("location: Homepage.php");
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: Preke.php");
	}
?>

<?php
	$connect = mysqli_connect("localhost", "root", "", "parduotuve");
	$connect -> set_charset("utf-8");
	$rez = $connect -> query('SELECT * FROM prekes');
	$kiek = $rez -> num_rows;

	@$_GET['id'];
	@$_GET['pav'];
	@$_GET['kat_id'];
	@$_GET['k'];
	@$_GET['ap'];
	@$_GET['img'];
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
		<div class="header"><a href="admin.php" ><img class="logo" src="images/foto/logofoto.svg"></a>
			<div class="prisijungimas">
				<?php if (isset($_SESSION['username'])) : ?>
					<p><?php echo $_SESSION['username']; ?></strong></p>
					<p> <a href="homepage.php?logout='1'">Atsijungti</a> </p>
				<?php endif ?>
			</div>
		</div>

		<div>
			<pre><form enctype="multipart/form-data" action="atnaujinti.php" method="GET">
	Prekės ID           <input type="text" name="id" value="<?php echo @$_GET['id']; ?>"/><br>
	Pavadinimas      <input type="text" name="pavadinimas" value="<?php echo @$_GET['pav']; ?>"/><br>
	Kategorijos ID   <input type="text" name="kategorijos_id" value="<?php echo @$_GET['kat_id']; ?>"/><br>
	Kaina                 <input type="text" name="kaina" value="<?php echo @$_GET['k']; ?>"/><br>
	Aprašymas         <input type="text" name="aprasymas" value="<?php echo @$_GET['ap']; ?>"/><br>
	Nuotrauka          <input type="text" name="foto" value="<?php echo @$_GET['img']; ?>"/><br>
			 <input type="submit" name="naujinti" value="Atnaujinti"/>
			</form></pre>

			<?php
				if(@$_GET['naujinti']) {
					$id = $_GET['id'];
					$pavadinimas = $_GET['pavadinimas'];
					$kategorijos_id = $_GET['kategorijos_id'];
					$kaina = @$_GET['kaina'];
					$aprasymas = @$_GET['aprasymas'];
					$foto = @$_GET['foto'];
					$query = "UPDATE prekes SET pavadinimas='$pavadinimas', kategorijos_id='$kategorijos_id', kaina='$kaina', aprasymas='$aprasymas', foto='$foto' WHERE id='$id'";
					$data = mysqli_query($connect,$query);
					if($data) {
						echo "Duomenys sėkmingai atnaujinti. <a href='adminPrekes.php'>Peržiūrėti atnaujintą lentelę</a>";
					}else {
						echo "Duomenų nepavyko atnaujinti";
					}
				}
				else {
					echo "  Norėdami atnaujinti duomenys paspauskite 'Atnaujinti' mygtuką.<br><a href='adminPrekes.php'> Peržiūrėti lentelę</a>";
				}
			?>
		</div>
		<div class="footer">2019&copy;</div>
	</body>
</html>