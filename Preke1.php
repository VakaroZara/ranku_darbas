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

			<?php
				$connect = mysqli_connect("localhost","root","","parduotuve");
				$fetch = "SELECT * FROM vartotojai WHERE username = '".$_SESSION['username']."'";
				$rs = mysqli_query($connect, $fetch);
				while($row = mysqli_fetch_array($rs)){
					//echo $row['id'].$row['username'].$row['email'];
					$user = $row['id'];
				}

				$id = $_GET['id'];
				$pav = @$_GET['pav'];
				$kain = @$_GET['kain'];
				$foto = @$_GET['foto'];

				$sql = "INSERT INTO krepselis1(prekes_id, pavadinimas, kaina, foto, user_id)
				VALUES ('$id','$pav','$kain','$foto','$user')";
				$data = mysqli_query($connect, $sql);
			?>
		</div>
		<p id="id2"></p>
		<div class="preke1">
			<p>Pasirinkite, ką norite daryti toliau:</p><hr><hr><br>
			<a href="Homepage.php">Toliau rinktis prekes</a><br><br>
			<a href="krepselis.php">Peržiūrėti savo krepšelį</a>
		</div>

		<?php
			$sesija = $_SESSION['username'];
			//echo $sesija;
			$fetch = "SELECT * FROM vartotojai WHERE username = '".$_SESSION['username']."'";
			$rs = mysqli_query($connect, $fetch);
			while($row = mysqli_fetch_array($rs)){
				//echo $row['id'].$row['username'].$row['email'];
			}
		?>
<div class="footer">2019&copy;</div>
	</body>
</html>