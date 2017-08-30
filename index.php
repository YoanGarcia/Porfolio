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

			<sidebar id="sidemenu">
				<a href="" id="close_sidemenu">X</a>
			</sidebar>


			<section id="nom_desc">
				<h2>Yoan Garcia</h2>
				<p>Infographiste multimédia</p>
			</section>
			<a id="bouton_commencer" href="#apropo">Commencer</a>
		</header>
		<section id="apropo">
			<img src="IMG/<?=$infos['photoCV']?>" width="200" heigth="200">
			<h2>A propos de moi</h2>
			<p  alt="A propos de moi" title="A propos de moi"><?=$infos['apropos']?></p><br>
			
			<a href="<?=$infos['lien_cv']?>" alt="Lien vers mon Curriculum Vitae" title="Lien vers mon Curriculum Vitae">Curriculum Vitae</a>
		</section>
		<section id="competences">
		<?php foreach ($competences as $competence): ?>
			<section>
				<label><?=$competence['titre']?></label>
				<?php for($i = 0; $i < $competence['points']; $i++): ?>
					<div class="check"></div>
				<?php endfor ?>
				<?php for($i = 0; $i < (5 - $competence['points']); $i++): ?>
					<div class="uncheck"><div class="uncheck1"></div></div>
				<?php endfor ?>
			</section>
		<?php endforeach ?>
		</section>
		<section id="creations">
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