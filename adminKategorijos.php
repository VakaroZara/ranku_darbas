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
		<div class="header"><a href="admin.php" ><img class="logo" src="images/foto/logofoto.svg"></a>
			<div class="prisijungimas">
				<?php if (isset($_SESSION['username'])) : ?>
					<p><?php echo $_SESSION['username']; ?></strong></p>
					<p> <a href="homepage.php?logout='1'">Atsijungti</a> </p>
				<?php endif ?>
			</div>
		</div>

		<div>
			<p>Lentelės 'Kategorijos' duomenys:</p><a style="margin-left: 10%;" href="iterptiK.php">Įterpti naują kategoriją</a><hr><hr>
			<?php
				$connect = mysqli_connect("localhost", "root", "", "parduotuve");
				$connect -> set_charset("utf-8");
				$rez = $connect -> query('SELECT * FROM kategorijos');
				$kiek = $rez -> num_rows;
			?>
			<table style="border-collapse: collapse; margin-left: 10%;">
				<tr>
					<th>Kategorijos ID</th>
					<th>Kategorija</th>
					<th>Atnaujinti</th>
					<th>Panaikinti</th>
				</tr>
				<?php
					while($row = $rez -> fetch_assoc()){
						echo "<tr>
							<td>".$row['id']."</td>
							<td>".$row['kategorija']."</td>
							<td><a href='atnaujintiK.php?id=$row[id]&kat=$row[kategorija]'>Atnaujinti</td>
							<td><a href='naikintiK.php?id=$row[id]' onclick='return tikrinti()'>Panaikinti</td>
							</tr>";
					}
				?>
			</table>

			<script>
				function tikrinti(){
					return confirm('Ar tikrai norite panaikinti šią kategoriją?');
				}
			</script>
		</div>

		<div class="footer">2019&copy;</div>
	</body>
</html>