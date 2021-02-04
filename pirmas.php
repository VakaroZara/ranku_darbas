<?php
	session_start();
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: pirmas.php");
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
			<form class="paieska" action="paieska.php" method="post">
				<input type="text" name="paieska" placeholder="Paieška" />
				<input type="submit" value="Ieškoti" />
			</form>
			<div class="prisijungimas">
				<?php if (isset($_SESSION['username'])) : ?>
					<p><?php echo $_SESSION['username']; ?></strong></p>
					<p> <a href="Homepage.php?logout='1'">Atsijungti</a> </p>
				<?php else: ?>
					<br><a href="prisijungimas.php">Prisijungti</a><br>
					<a href="registracija.php">Užsiregistruoti</a>
				<?php endif ?>
			</div>
		</div>

		<div class="gridas">
			<div>
			<?php
				$p = new mysqli('localhost','root','','parduotuve');
				$p -> set_charset("utf-8");
				$rez = $p -> query('select * from kategorijos order by kategorija');
				$kiek = $rez -> num_rows;
				for($i = 1; $i <= $kiek; $i++){
					$u = $rez -> fetch_assoc();
					echo '<a href="kategorija.php?id='.$u['id'].$u['kategorija'].'">'; //kad galetumem paspausti ant kategoriju
					echo '<div class="kat">'.$u['kategorija'].'<br></div></a>'; //kad rodytu kategorijas
				}
			?>
			</div>

			<div class="kita">
Čia reiks įterpti akcijas

<?php
					$rez = $p -> query('SELECT * FROM prekes order by rand() limit 2');
					$kiek = $rez -> num_rows;
					for($i = 1; $i <= $kiek; $i++){
						$u = $rez -> fetch_assoc();
						echo '<div class="preke"><a href="preke.php?id='.$u['id'].$u['foto'].'"></div>'; // ?id= kad į kitą psl leistų permest
						echo '<div class="foto">';
						echo $u['pavadinimas'].'<br>Kaina: '.$u['kaina'].' €
						<br><img src="images/foto/'.$u['foto'].'" alt>
						</a>';
						echo '</div>';
					}
				?>
			</div>

		</div>
		<div class="footer">2019&copy;</div>
	</body>
</html>
