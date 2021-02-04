<?php
session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>alert('Norėdami pamatyti detalesnę informaciją apie prekę, turite prisiregistruoti')</script>";
		//header("location: Homepage.php");
?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/taisymasDesignShop/prisijungimas.php">
	<?php
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
		<script src="myScript.js"></script>
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body style="margin:0px;">
		<div class="header"><a href="Homepage.php" ><img class="logo" src="images/foto/logofoto.svg"></a>
			<div class="hoveris">
				<button class="iconSearch"><i class='fas fa-search'></i></button>
				<form id="search" class="paieska" action="paieska.php" method="post">
					<input type="text" name="paieska" placeholder="Paieška" />
					<input type="submit" value="Ieškoti" />
				</form>
			</div>
			<div class="hoveris">
				<button class="iconLogin"><i class="fa fa-user-circle"></i></button>
				<div id="login" class="prisijungimas">
					<?php if (isset($_SESSION['username'])) : ?>
						<p><?php echo $_SESSION['username']; ?></strong></p>
						<p> <a href="Preke.php?logout='1'">Atsijungti</a> </p>
					<?php else: ?>
						<br><a href="prisijungimas.php">Prisijungti</a><br>
						<a href="registracija.php">Užsiregistruoti</a>
					<?php endif ?>
				</div>
			</div>

			<button class="iconMeniu" onclick="myFunction()"><i class="fa fa-bars"></i></button>

		</div>
		<p id="id2"></p>
		<div>
			<p style="margin-left: 11%;">Jūsų krepšelis:</p><hr><hr>
			<?php
				$sesija = $_SESSION['username'];
				$connect = mysqli_connect("localhost","root","","parduotuve");
				$fetch = "SELECT * FROM vartotojai WHERE username = '".$_SESSION['username']."'";
				$rs = mysqli_query($connect, $fetch);
				while($row = mysqli_fetch_array($rs)){
					$useris = $row['id'];
				//	echo $row['id'].$useris.$row['email'];
				}
			?>

			<?php
				$connect = mysqli_connect("localhost", "root", "", "parduotuve");
				$connect -> set_charset("utf-8");
				//echo $useris;
				$rez = $connect -> query("SELECT * FROM krepselis1 WHERE user_id = $useris");
				$kiek = $rez -> num_rows;
			?>
			<table style="border-collapse: collapse; margin-left: 10%;">
				<tr>
					<th colspan="2">Prekė</th>
					<th>Kaina</th>
					<th>Pašalinti</th>
				</tr>
				<?php
					while($row = $rez -> fetch_assoc()){
						echo "<tr>
						<td><img src='images/foto/".$row['foto']."' alt></td>
						<td>".$row['pavadinimas']."</td>
						<td align='center'>".$row['kaina']." €</td>
						<td><a href='naikinti_krep.php?id=$row[id]' onclick='return tikrinti()'>Pašalinti</td>
						</tr>";
						@$visakaina += $row['kaina'];
					}
				?>
				<tr><td colspan="2" align="right"><strong><?php echo 'Visa kaina: ';?></strong></td>
					<td align="center"><strong><?php echo @$visakaina.' €';?></strong></td>
				</tr>
			</table><br>

			<script>
				function tikrinti(){
					return confirm('Ar tikrai norite pašalinti šią prekę iš krepšelio?');
				}
			</script>
			<hr><hr><hr>
		</div>

		<div class="footer">2019&copy;</div>
	</body>
</html>