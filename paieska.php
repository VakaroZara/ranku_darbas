<?php
	session_start();
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: paieska.php");
	}
?>

<!DOCTYPE html>
<html lang="lt">
	<head>
		<meta charset="utf-8">
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
						<p> <a href="paieska.php?logout='1'">Atsijungti</a> </p>
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
					$rez = $p -> query('select * from kategorijos order by kategorija');
					$kiek = $rez -> num_rows;
					for($i = 1; $i <= $kiek; $i++){
						$u = $rez -> fetch_assoc();
						echo '<a href="kategorija.php?id='.$u['id'].$u['kategorija'].'">'; //kad galetumem paspausti ant kategoriju
						echo  '<div class="kat">'.$u['kategorija'].'<br></div></a>'; //kad rodytu kategorijas
					}
				?>
				<p id="id2"></p>
			</div>

			<div class="kita">
				<?php
					$p = new mysqli("localhost","root","","parduotuve");
					$p -> set_charset("utf-8");

					if(isset($_POST['paieska'])){
						$uzklausa = $_POST['paieska'];
						$uzklausa = preg_replace("#^0-9a-z#i","",$uzklausa);

						$rez = $p -> query("SELECT * FROM prekes WHERE lower(pavadinimas) LIKE '%$uzklausa%'");
						$kiek = $rez -> num_rows;
						if($kiek == 0){
							echo 'Nerasta rezultatų!';
						}else{
							while($row = $rez -> fetch_array()){
								echo '<div class="foto">';
								$id = $row['id'];
								$pav = $row['pavadinimas'];
								$kain = $row['kaina'];
								$foto = $row['foto'];
								echo '<div class="preke"><a href="preke.php?id='.$id.'"></div>'; //kad permestu preke i kita psl
								echo $pav.'<br>Kaina: '.$kain.' €
								<br><img src="images/foto/'.$foto.'" alt>
								</a>';
								echo '</div>';
							}
						}
					}
				?>
			</div>
		</div>
		<div class="footer">2019&copy;</div>
	</body>
</html>

