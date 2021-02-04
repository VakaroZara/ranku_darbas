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
<pre><form action="iterptiK.php" method="post">
<label>Kategorija:</label><br>
	<input type="text" name="kategorija" id="kat" required="required" placeholder="Įveskite pavadinimą"/><br><br />
	<input type="submit" value=" Įterpti " name="iterpti"/><br /><a href='adminKategorijos.php'></a><br>
</form></pre>

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

					$sql = "INSERT INTO kategorijos (kategorija)
					VALUES ('".$_POST["kategorija"]."')";

					if ($conn->query($sql) === TRUE) {
						echo "Duomenys sėkmingai įterpti į lentelę. <br><a href='adminKategorijos.php'>Peržiūrėti atnaujintą lentelę</a>";
					}
					else {
						echo "Deja, nepavyko įkelti duomenų. <a href='adminKategorijos.php'>Peržiūrėti atnaujintą lentelę</a>";
					}

					$conn->close();
				}
			?>

		</div>
			<div class="footer">2019&copy;</div>
	</body>
</html>