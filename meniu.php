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
    <body>
        <div class="bendras">
            <?php
                $p = new mysqli('localhost','root','','parduotuve');
                $p -> set_charset("utf-8");
                $rez = $p -> query('select * from kategorijos order by kategorija');
                $kiek = $rez -> num_rows;
                for($i = 1; $i <= $kiek; $i++){
                    $u = $rez -> fetch_assoc();
                    echo '<a href="kategorija.php?id='.$u['id'].$u['kategorija'].'">'; //kad galetumem paspausti ant kategoriju
                    echo '<div id="id1" class="kat2">'.$u['kategorija'].'<br></div></a>'; //kad rodytu kategorijas
                }
            ?>
        </div>
    </body>
</html>
