<?php
	session_start();
	if(!isset($_SESSION['username'])){
		echo "<script>alert('Norėdami pamatyti detalesnę informaciją apie prekę, turite prisiregistruoti')</script>";
		//header("location: Homepage.php");
?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/taisymasDesignShop/prisijungimas.php">
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

			<br><a class="krepseliobtn" href="krepselis.php">Krepšelis</a>
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
						$query_fetch = mysqli_query($connect,"SELECT * FROM prekes WHERE id = $id");
						while($show = mysqli_fetch_array($query_fetch)){
				?>
				<div class="container-slide">
					<div class="albumasC">
								<img src="images/foto/<?php echo $show['foto'] ?>"onclick="plusSlides(1)">
					</div>

							<div class="albumasC">
								<br><img src="images/foto/<?php echo $show['foto1'];
								if($show['foto1'] === NULL){echo 'logofoto.svg';}
								?>"onclick="plusSlides(1)">
							</div>

							<div class="albumasC">
								<br><img src="images/foto/<?php echo $show['foto2'];
								if($show['foto2'] === NULL){echo 'logofoto.svg';}
								?>"onclick="plusSlides(1)">
							</div>

				</div>

							<div class="albumas">
								<img src="images/foto/<?php echo $show['foto'] ?>" onclick="parodykFoto(this);">
							</div>

							<div class="albumas">
								<br><img src="images/foto/<?php echo $show['foto1'];
								if($show['foto1'] === NULL){echo 'logofoto.svg';}
								?>" onclick="parodykFoto(this);">
							</div>

							<div class="albumas">
								<br><img src="images/foto/<?php echo $show['foto2'];
								if($show['foto2'] === NULL){echo 'logofoto.svg';}
								?>" onclick="parodykFoto(this);">
							</div>

							<div>
								<img id="dideleFoto" src="images/foto/<?php echo $show['foto'] ?>">
							</div>

							<?php
								echo '<div class="pavadinimas">'.$show['pavadinimas'].'</div><br><div class="aprasymas">'.$show['aprasymas'].'</div><br><div class="kaina">Kaina: '.$show['kaina'].' €</div><br><br>';
								echo "<a class='ikrepseli' href='Preke1.php?id=$show[id]&pav=$show[pavadinimas]&kain=$show[kaina]&foto=$show[foto]&'>Į krepšelį</a>";
						}
					}
							?>
<div class="hreilutes"><hr><hr><hr></div>
				<div class="stulpelis right">
					<script>
						function parodykFoto(imgs) {
							var didele = document.getElementById("dideleFoto");
							didele.src = imgs.src;
						}
					</script>
				</div>
			</div>
		</div>
		<script>
			var slideIndex = 1;
			showSlides(slideIndex);

			function plusSlides(n) {
			showSlides(slideIndex += n);
			}

			function currentSlide(n) {
			showSlides(slideIndex = n);
			}

			function showSlides(n) {
			var i;
			var slides = document.getElementsByClassName("albumasC");
			if (n > slides.length) {slideIndex = 1}
			if (n < 1) {slideIndex = slides.length}
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			slides[slideIndex-1].style.display = "block";
			}
		</script>
		<div class="footer">2019&copy;</div>
	</body>
</html>