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
	$rez = $connect -> query('SELECT * FROM kategorijos');
	$kiek = $rez -> num_rows;

	@$_GET['id'];
	@$_GET['kat'];
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
				<?php  if (isset($_SESSION['username'])) : ?>
				<p><?php echo $_SESSION['username']; ?></strong></p>
				<p> <a href="homepage.php?logout='1'">Atsijungti</a> </p>
				<?php endif ?>
			</div>
		</div>
		<div>
			<pre><form action="atnaujintiK.php" method="GET">
	Kategorijos ID   <input type="text" name="id" value="<?php echo $_GET['id']; ?>"/><br>
	Kategorija          <input type="text" name="kategorija" value="<?php echo @$_GET['kat']; ?>"/><br>
	                 <input type="submit" name="naujinti" value="Atnaujinti"/>
			</form></pre>

			<?php
				if(@$_GET['naujinti']) {
					$id = $_GET['id'];
					$kategorija = @$_GET['kategorija'];
					$query = "UPDATE kategorijos SET kategorija='$kategorija' WHERE id='$id'";
					$data = mysqli_query($connect,$query);
					if($data) {
						echo "Duomenys sėkmingai atnaujinti. <a href='adminKategorijos.php'>Peržiūrėti atnaujintą lentelę</a>";
					}else {
						echo "Duomenų nepavyko atnaujinti";
					}
				}
				else {
					echo "Norėdami atnaujinti duomenis paspauskite 'Atnaujinti' mygtuką.<br><a href='adminKategorijos.php'>Peržiūrėti lentelę</a>";
				}
			?>
		</div>
		<div class="footer">2019&copy;</div>
	</body>
</html>