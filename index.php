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

		<script src="script.js" defer>
		</script>
	</head>
	<body>
		<header>

			<a href="" id="open_sidemenu"></a>

			<sidebar id="sidemenu">
				<a href="" id="close_sidemenu"></a>
			</sidebar>


			<section id="nom_desc">
				<h2>Yoan Garcia</h2>
				<p>Infographiste multimédia</p>
			</section>
			<a id="bouton_commencer" href="#apropo">Commencer</a>
		</header>

		<section id="apropo">
			<h1>A propos de moi</h1>
			<div id="img_cv">
				<img src="IMG/<?=$infos['photoCV']?>" width="200" heigth="200">
			</div>
			<div id="desc_apropos">
				<p  alt="A propos de moi" title="A propos de moi"><?=$infos['apropos']?></p><br>

				<a href="<?=$infos['lien_cv']?>" alt="Lien vers mon Curriculum Vitae" title="Lien vers mon Curriculum Vitae">Curriculum Vitae</a>
			</div>
		</section>

		<section id="competences">
			<h1>Mes compétences</h1>

			<?php foreach ($competences as $competence): ?>
				<section class="competence">
					<h3><?=$competence['titre']?></h3>
					<?php for($i = 0; $i < $competence['points']; $i++): ?>
						<div class="check points"></div>
					<?php endfor ?>
					<?php for($i = 0; $i < (5 - $competence['points']); $i++): ?>
						<div class="points"><div class="uncheck"><div class="uncheck1"></div></div></div>
					<?php endfor ?>
				</section>
			<?php endforeach ?>

		</section>

		<section id="creations">

			<h1>Mes créations</h1>

			<section id="select_creations">
				<img src="IMG/MonLogoNoir.png" width=60 height=60>
				<a id="all_creations" href="">Tous les travaux</a>
				<img src="IMG/Ai.png" width=60 height=60>
				<a id="illu_creations" href="">Fait avec Illustrator</a>
				<img src="IMG/Ps.png" width=60 height=60>
				<a id="photo_creations" href="">Fait avec Photoshop</a>
				<img src="IMG/3dsMax.jpg" width=60 height=60>
				<a id="creations_3ds" href="">Fait avec 3ds Max</a>
			</section>

			<?php foreach ($creations as $creation): ?>
				<article class="<?=$creation['type']?> creation">
					<img src="IMG/<?=$creation['img']?>" width=50 height=50 >
					<h1><?=$creation['titre']?></h1>
					<p><?=$creation['description']?></p>
					<p><?=$creation['temp']?></p>
				</article>
			<?php endforeach ?>

		</section>

		<footer>
			<?=$infos['email']?><br>
			<?=$infos['telephone']?>
		</footer>
	</body>
</html>