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



	<body style="margin:0px;">
		<div class="header"><a href="Homepage.php" ><img class="logo" src="images/foto/logofoto.svg"></a>
			<div class="prisijungimas">
				<?php if (isset($_SESSION['username'])) : ?>
					<p><?php echo $_SESSION['username']; ?></strong></p>
					<p> <a href="homepage.php?logout='1'">Atsijungti</a> </p>
				<?php endif ?>
			</div>
		</div>

		<div>
			<p>Pasirinkite, ką norite daryti:</p><hr>
			<a style="margin-left: 10%;" href="adminPrekes.php">Dirbti su lentele 'Prekės'</a><br><br>
			<a style="margin-left: 10%;" href="adminKategorijos.php">Dirbti su lentele 'Kategorijos'</a><br><br><hr><hr>
			<p>Čia galite įkelti nuotrauką:</p><hr>

			<pre style="margin-left: 10%;"><form enctype="multipart/form-data" method = "post" action = "admin.php">
<input type = "file" name = "nuotrauka">
<input type = "submit" value = "Įkelti">
</form></pre>
			<?php
				$_GET['uploads_dir'] = 'images/foto/';
				$kelias = $_GET['uploads_dir'].@$_FILES['nuotrauka']['name'];
				print "<pre>";
				if (@$_FILES['nuotrauka']['type']!='image/jpeg' and @$_FILES['nuotrauka']['type']!='image/png' and @$_FILES['nuotrauka']['type']!='image/gif'){
					echo " Įkelkite .jpeg, .png, .gif formato nuotrauką.<hr>";
				}
				elseif (move_uploaded_file($_FILES['nuotrauka']['tmp_name'],$kelias)) {
					echo "Nuotrauka sėkmingai įkelta.<hr>";
				}
				print "</pre>";
			?>
		</div>

		<div class="footer">2019&copy;</div>
	</body>
</html>