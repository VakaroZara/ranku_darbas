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

<!DOCTYPE html> <!--KOMENTARAI-->
<html lang="lt">
	<head>
		<title>Rankų_Darbas.lt</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>



	<body style="margin:0">
		<div class="header"><a href="admin.php" ><img class="logo" src="images/foto/logofoto.svg"></a>
			<div class="prisijungimas">
				<?php if (isset($_SESSION['username'])) : ?>
					<p><?php echo $_SESSION['username']; ?></strong></p>
					<p> <a href="homepage.php?logout='1'">Atsijungti</a> </p>
				<?php endif ?>
			</div>
		</div>
		<div>
<pre><form action="iterpti.php" method="post"><br>
		 <label>Prekės pavadinimas:</label>
			<input type="text" name="pavadinimas" id="pav" required="required" placeholder="Įveskite prekės pavadinimą"/><br />
		 <label>Kaina:</label>
			<input type="text" name="kaina" id="k" required="required" placeholder="Įveskite prekės kainą"/><br />
		 <label>Aprašymas:</label>
			<input type="text" name="aprasymas" id="ap" required="required" placeholder="Įveskite prekės aprašymą"/><br />
		 <label>Kategorijos ID:</label>
			<input type="text" name="kategorijos_id" id="kat_id" required="required" placeholder="Įveskite kategorijos ID"/><br />
		 <label>Nuotrauka:</label>
			<input type="text" name="foto" id="img" required="required" placeholder="Įveskite nuotraukos pavadinimą"/><br /><br />
			<input type="submit" value=" Įterpti " name="iterpti"/><br />
<form><pre>

			<?php
				if(isset($_POST["iterpti"])){
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "parduotuve";

					$conn = new mysqli($servername, $username, $password, $dbname);

					if ($conn->connect_error) {
						die("Nepavyko prisijungti: " . $conn->connect_error);
					}

					$sql = "INSERT INTO prekes (pavadinimas, kategorijos_id, kaina, aprasymas, foto)
					VALUES ('".$_POST["pavadinimas"]."','".$_POST["kategorijos_id"]."','".$_POST["kaina"]."','".$_POST["aprasymas"]."','".$_POST["foto"]."')";

					if ($conn->query($sql) === TRUE) {
						echo "Duomenys sėkmingai įterpti į lentelę.<a href='adminPrekes.php'>Peržiūrėti atnaujintą lentelę</a>";
					}
					else {
						echo "Deja, nepavyko įkelti duomenų.<a href='adminPrekes.php'>Peržiūrėti lentelę</a>";
					}
					$conn->close();
				}
			?>

		</div>
		<div class="footer">2019&copy;</div>
</body>
</html>