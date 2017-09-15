<?php
	$bdd = new PDO('mysql:host=localhost;dbname=yoan;charset=utf8', 'root', '') or die($pdo->errorInfo());

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
		<header>
			<section class="t960px">
				<nav>
					<img src="IMG/MonLogoBlanc.png"> <a class='lake js-scrollTo' href="#">Accueil</a>	
				</nav>

				<a href="" class='lake' id="open_sidemenu">Menu</a>

				<sidebar id="sidemenu">
					<a href="" class='lake' id="close_sidemenu">X</a>
					<ul>
						<li><a class='lake js-scrollTo' href="#apropo">A propos</a></li>
						<hr>
						<li><a class='lake js-scrollTo' href="#competences">Compétence</a></li>
						<hr>
						<li><a class='lake js-scrollTo' href="#MesCreations">Creations</a></li>
						<hr>
						<li><a class='lake js-scrollTo' href="#contact">Contact</a></li>
					</ul>
					<img src="IMG/MonLogoBlanc.png" width=110>
				</sidebar>


				<section id="nom_desc">
					<hr>
					<h1 class='lake'>Yoan Garcia</h1>
					<hr>
					<h2 class='lake'>Infographiste multimédia</h2>
				</section>
				<a id="bouton_commencer" href="#apropo" class='lake js-scrollTo'>Commencer</a>
			</section>
		</header>

		<section id="apropo">
			<section class="t960px">
				<h1 class='lake'>A propos de moi</h1>
				<div id="img_cv">
					<img src="IMG/<?=$infos['photoCV']?>" width="200" heigth="200">
				</div>
				<div id="desc_apropos">
					<p  alt="A propos de moi" title="A propos de moi"><?=$infos['apropos']?></p><br>
				</div>
				<a id="curi" target="_blank" class="buttonblanc" href="IMG/<?=$infos['CV']?>" alt="Lien vers mon Curriculum Vitae" title="Lien vers mon Curriculum Vitae">Curriculum Vitae</a>
			</section>
		</section>

		<section id="competences">
			<section class="t960px">
				<h1 class='lake'>Mes compétences</h1>

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

		<section id="MesCreations">
			<section class="t960px">
				<h1 class='lake'>Mes créations</h1>

				<section id="select_creations">
					<img src="IMG/MonLogoNoir.png" width=60 height=60>
					<a id="all_creations" class="buttonblanc lake" href="">Tous les travaux</a>
					<img src="IMG/Ai.png" width=60 height=60>
					<a id="illu_creations" class="buttonblanc lake" href="">Fait avec Illustrator</a>
					<img src="IMG/Ps.png" width=60 height=60>
					<a id="photo_creations" class="buttonblanc lake" href="">Fait avec Photoshop</a>
					<img src="IMG/3dsMax.jpg" width=60 height=60>
					<a id="creations_3ds" class="buttonblanc lake" href="">Fait avec 3ds Max</a>
				</section>

				<section class="buchet" id="creation">
					<?php foreach ($creations as $creation): ?>
						<article class="<?=$creation['type']?> creation">
							<div class="img_container">
								<img src="IMG/<?=$creation['img']?>" width=50 height=50 >
							</div>
							<section class="description_creation">
								<h1 class="buchet"><?=$creation['titre']?></h1>
								<p class="buchet"><?=$creation['description']?></p>
								<p class="buchet"><?=$creation['temp']?></p>
							</section>
						</article>
					<?php endforeach ?>	
				</section>				
			</section>
		</section>

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