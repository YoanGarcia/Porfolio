<?php
	$bdd = new PDO('mysql:host=localhost;dbname=yoangarchcbdd;charset=utf8', 'root', '') or die($pdo->errorInfo());

	$req = $bdd->prepare('SELECT * FROM infos  WHERE id = 1');
	$req->execute();
	$infos = $req->fetch();

	$req = $bdd->prepare('SELECT * FROM competences');
	$req->execute();
	$competences = $req->fetchall(PDO::FETCH_ASSOC);

	$req = $bdd->prepare('SELECT * FROM creations');
	$req->execute();
	$creations = $req->fetchall(PDO::FETCH_ASSOC);
?>

<!-- ********************************* -->
<!-- ********************************* -->
<!-- ********************************* -->

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initiam-scale-1.0" />

		<title>Yoan Garcia</title>

		<meta name="Description" content="Garcia Yoan, Infographiste multimédia, Mon Portfolio">
		<meta name="keywords" content="Garcia Yoan, Infographiste, infographie, animation, 3D, 2D, Bordeaux, Aquitaine, Portfolio">

		<link rel="shortcut icon" type="image/jpg" href="IMG/MonLogoNoir.png" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="js/script.js" defer></script>
		<script src="js/smoothscroll.js" defer></script>
	</head>

	<body>
	<section id="black_container"></section>
		<!-- SECTION DEPART -->
		<header>
			<section class="t960px">
				<nav>
					<img src="IMG/MonLogoBlanc.png"> <a class='lake js-scrollTo boutondepart' href="#">Accueil</a>	
				</nav>

				<a href="" class='lake boutondepart' id="open_sidemenu">Menu</a>

				<sidebar id="sidemenu">
					<a href="" class='lake' id="close_sidemenu">X</a>
					<ul>
						<li><a class='lake js-scrollTo boutondepart' href="#apropo">A propos</a></li>
						<hr>
						<li><a class='lake js-scrollTo boutondepart' href="#competences">Compétences</a></li>
						<hr>
						<li><a class='lake js-scrollTo boutondepart' href="#MesCreations">Creations</a></li>
						<hr>
						<li><a class='lake js-scrollTo boutondepart' href="#contact">Contact</a></li>
					</ul>
					<img src="IMG/MonLogoBlanc.png" width=110>
				</sidebar>


				<section id="nom_desc">
					<hr>
					<h1 class='lake'>Yoan Garcia</h1>
					<hr>
					<h2 class='lake'>Infographiste multimédia</h2>
				</section>

				<a id="bouton_commencer" href="#apropo" class='lake js-scrollTo boutondepart'>Commencer</a>

			</section>
		</header>

		<!-- SECTION A PROPOS -->
		<section id="apropo">
			<section class="t960px">

				<section class="titre_section">
					<h1 class='lake'>A propos de moi</h1>
				</section>

				<div id="img_cv">
					<img src="IMG/<?=$infos['photoCV']?>" width="200" heigth="200">
				</div>
				<div id="desc_apropos">
					<p  alt="A propos de moi" title="A propos de moi"><?=$infos['apropos']?></p><br>
				</div>
				<a id="curi" target="_blank" class="boutonapropos" href="IMG/<?=$infos['CV']?>" alt="Lien vers mon Curriculum Vitae" title="Lien vers mon Curriculum Vitae">Curriculum Vitae</a>

			</section>
		</section>

		<!-- SECTION COMPETENCES -->
		<section id="competences">
			<section class="t960px">

				<section class="titre_section">
					<h1 class='lake'>Mes compétences</h1>
				</section>
				
				<section id="competences_2">
					<?php foreach ($competences as $competence): ?>
						<section class="competence">
							<h3 class="buchet"><?=$competence['titre']?></h3>
							<section id="section_points">
								<?php for($i = 0; $i < $competence['points']; $i++): ?>
									<div class="check points"></div>
								<?php endfor ?>
								<?php for($i = 0; $i < (5 - $competence['points']); $i++): ?>
									<div class="points"><div class="uncheck"><div class="uncheck1"></div></div></div>
								<?php endfor ?>
							</section>
						</section>
					<?php endforeach ?>		
				</section>

			</section>
		</section>

		<!-- SECTION CREATIONS -->
		<section id="MesCreations">
			<section class="t960px">

				<section class="titre_section">
					<h1 class='lake'>Mes créations</h1>
				</section>
				
				<section id="select_creations">
					<img src="IMG/MonLogoNoir.png" width=60 height=60>
					<a id="all_creations" class="boutoncreations lake" href="">Tous les travaux</a>
					<img src="IMG/Ai.png" width=60 height=60>
					<a id="illu_creations" class="boutoncreations lake" href="">Fait avec Illustrator</a>
					<img src="IMG/Ps.png" width=60 height=60>
					<a id="photo_creations" class="boutoncreations lake" href="">Fait avec Photoshop</a>
					<img src="IMG/3dsMax.jpg" width=60 height=60>
					<a id="creations_3ds" class="boutoncreations lake" href="">Fait avec 3ds Max</a>
				</section>

				<section class="buchet" id="creation">
					<?php foreach ($creations as $creation): ?>
						<article class="<?=$creation['type']?> creation">
							<img src="IMG/creations/<?=$creation['img']?>">
							<section class="description_creation">
								<h1 class="buchet"><?=$creation['titre']?></h1>
								<p class="buchet">Temps de réalisation : <?=$creation['temp']?></p>
								<p class="buchet"><?=$creation['description']?></p>
							</section>
						</article>
					<?php endforeach ?>	
				</section>

			</section>
		</section>

		<!-- SECTION FOOTER -->
		<footer class="buchet" id="contact">
			<section class="t960px">
				<p>
					<span class="fa fa-envelope-o" aria-hidden="true" alt="Mon email : <?=$infos['email']?>" title="Mon email">  <?=$infos['email']?></span>
					<span class="fa fa-mobile" aria-hidden="true" alt="Mon numero de téléphone : <?=$infos['telephone']?>" title="Mon téléphone">  <?=$infos['telephone']?></span>
				</p>
				<p>
					© 2017 All right reserved | Design : Garcia Yoan
				</p>
			</section>
		</footer>

	</body>
	
</html>