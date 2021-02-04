<?php
	session_start();
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: kategorija.php");
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
						<p> <a href="kategorija.php?logout='1'">Atsijungti</a> </p>
					<?php else: ?>
						<br><a href="prisijungimas.php">Prisijungti</a><br>
						<a href="registracija.php">Užsiregistruoti</a>
					<?php endif ?>
				</div>
			</div>
			<button class="iconMeniu" onclick="myFunction()"><i class="fa fa-bars"></i></button>
		</div>

		<div class="gridas">
			<div>
				<?php
					$p = new mysqli('localhost','root','','parduotuve');
					$p -> set_charset("utf-8");
					$rez = $p -> query('select * from kategorijos ORDER BY kategorija');
					$kiek = $rez -> num_rows;
					for($i = 1; $i <= $kiek; $i++){
						$u = $rez -> fetch_assoc();
						echo '<div><a href="kategorija.php?id='.$u['id'].$u['kategorija'].'"></div>';
						echo '<div class="kat">'.$u['kategorija'].'<br></div></a>';
					}
				?>
				<p id="id2"></p>
			</div>

			<div class="kita">
				<?php
					$connect = mysqli_connect("localhost","root","","parduotuve");
					if(isset($_GET['id'])){
						$id = (int)$_GET['id'];
						$query_fetch = mysqli_query($connect,"SELECT * FROM kategorijos, prekes WHERE kategorijos.id = $id and kategorijos.id=prekes.kategorijos_id");

						while($show = mysqli_fetch_array($query_fetch)){
							echo '<div class="preke"><a href="preke.php?id='.$show['id'].$show['foto'].'"></div>'; // ?id= kad į kitą psl leistų permest
							echo '<div class="foto">';
							echo $show['pavadinimas'].'<br>Kaina: '.$show['kaina'].' €
							<br><img src="images/foto/'.$show['foto'].'" alt>
							</a>';
							echo '</div>';
						}
					}
				?>
			</div>
		</div>
		<div class="footer">2019&copy;</div>
	</body>
</html>
