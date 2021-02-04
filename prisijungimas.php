<?php include('serveris.php') ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Rankų_Darbas.lt</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="myScript.js"></script>
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>



	<body style="margin:0px;">
		<div class="header"><a href="Homepage.php" ><img class="logo" src="images/foto/logofoto.svg"></a>
			<div class="hoveris">
				<button class="iconSearch" style="right:5px;"><i class='fas fa-search'></i></button>
				<form id="search" class="paieska" action="paieska.php" method="post">
					<input type="text" name="paieska" placeholder="Paieška" />
					<input type="submit" value="Ieškoti" />
				</form>
			</div>
		</div>

		<button class="iconMeniu" onclick="myFunction()"><i class="fa fa-bars"></i></button>

		<p id="id2"></p>
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

			<form class="ivedimas" method="post" action="prisijungimas.php">
				<?php include('klaidos.php'); ?>
				<div>
					<input type="text" name="username" placeholder="Prisijungimo vardas">
				</div>
				<div>
					<input type="password" name="password" placeholder="Slaptažodis">
				</div>
				<div>
					<button type="submit" class="btn" name="login_user">Prisijungti</button>
				</div>
				<p>
					Dar nesate narys? <a href="registracija.php">Užsiregistruoti</a>
				</p>
			</form>
		</div>
<div class="footer">2019&copy;</div>
</body>
</html>