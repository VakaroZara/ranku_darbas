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
			<p>Lentelės 'Prekės' duomenys:</p><a style="margin-left: 10%;" href="iterpti.php">Įterpti naują prekę</a><hr><hr>
			<?php
				$connect = mysqli_connect("localhost", "root", "", "parduotuve");
				$connect -> set_charset("utf-8");
				$rez = $connect -> query('SELECT * FROM prekes');
				$kiek = $rez -> num_rows;

			?>
			<table style="border-collapse: collapse; margin-left: 1%;">
				<tr>
					<th>Prekės ID</th>
					<th>Pavadinimas</th>
					<th>Kategorijos ID</th>
					<th>Kaina</th>
					<th>Aprašymas</th>
					<th colspan="2">Nuotrauka</th>
					<th>Atnaujinti</th>
					<th>Panaikinti</th>
				</tr>
				<?php
					while($row = $rez -> fetch_assoc()){
						echo "<tr>
							<td>".$row['id']."</td>
							<td>".$row['pavadinimas']."</td>
							<td>".$row['kategorijos_id']."</td>
							<td>".$row['kaina']." €</td>
							<td>".$row['aprasymas']."</td>
							<td><img src='images/foto/".$row['foto']."' alt></td>
							<td>".$row['foto']."</td>
							<td><a href='atnaujinti.php?id=$row[id]&pav=$row[pavadinimas]&kat_id=$row[kategorijos_id]&k=$row[kaina]&ap=$row[aprasymas]&img=$row[foto]'>Atnaujinti</td>
							<td><a href='naikinti.php?id=$row[id]' onclick='return tikrinti()'>Panaikinti</td>
							</tr>";
					}
				?>
			</table>

			<script>
				function tikrinti(){
					return confirm('Ar tikrai norite panaikinti šią prekę iš lentelės "Prekės"?');
				}
			</script>
		</div>


		<div class="footer">2019&copy;</div>
	</body>
</html>