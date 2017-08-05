<?php
	$bdd = new PDO('mysql:host=localhost;dbname=yoan;charset=utf8', 'root', '') or die($pdo->errorInfo());

	$req = $bdd->prepare('SELECT * FROM infos  WHERE id = 1');
	$req->execute();
	$infos = $req->fetch();

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

		<style>

			*
			{
				margin: 0px;
				padding: 0px;
			}

			body
			{
				background-image: url('IMG/lion.jpg');
				background-repeat: no-repeat;
				background-size: cover;
				background-attachment: fixed;
			}

			.check
			{
				display: flex;
				background: rgb(45, 127, 139);
				width: 20px;
				height: 20px;
				border-radius: 20px;
			}

			.uncheck
			{
				display: flex;
				background: rgb(45, 127, 139);
				width: 20px;
				height: 20px;
				border-radius: 20px;
			}

			.uncheck1
			{
				margin: auto;
				display: inline-block;
				background: rgb(15, 81, 90);
				width: 12px;
				height: 12px;
				border-radius: 12px;	
			}

			#competences section
			{
				display: flex;
				flex-direction: row;
				align-content: space-around;
				width: 800px;
			} 

			.bouton_commencer
			{
				position: absolute;
				bottom: 0px;
				left: 0px;
			}

			header
			{
				display: flex;
				position: relative;
				height: 100vh;
			}

			#nom_desc
			{
				display: inline-block;
				margin: auto;
			}
		</style>
	</head>
	<body>
		<header style="text-align: center;">
			<section id="nom_desc">
				<h2>Yoan Garcia</h2>
				<p>Infographiste multimédia</p>
			</section>
			<a id="bouton_commencer" href="#apropo">Commencer</a>
		</header>
		<section id="apropo" style="text-align: center;background: rgb(15, 81, 90);">
			<h2>A propos de moi</h2>
			<p  alt="A propos de moi" title="A propos de moi"><?=$infos['apropos']?></p><br>
			
			<a href="<?=$infos['lien_cv']?>" alt="Lien vers mon Curriculum Vitae" title="Lien vers mon Curriculum Vitae">Curriculum Vitae</a>
		</section>
		<section id="competences">
			<section>
				<label>HTML 5</label>
				<?php for($i = 0; $i < $infos['html']; $i++): ?>
					<div class="check"></div>
				<?php endfor ?>
				<?php for($i = 0; $i < (5 - $infos['html']); $i++): ?>
					<div class="uncheck"><div class="uncheck1"></div></div>
				<?php endfor ?>
			</section>
			<section>
				<label>CSS 3</label>
				<?php for($i = 0; $i < $infos['css']; $i++): ?>
					<div class="check"></div>
				<?php endfor ?>
				<?php for($i = 0; $i < (5 - $infos['css']); $i++): ?>
					<div class="uncheck"><div class="uncheck1"></div></div>
				<?php endfor ?>
			</section>
			<section>
				<label>PHP</label>
				<?php for($i = 0; $i < $infos['php']; $i++): ?>
					<div class="check"></div>
				<?php endfor ?>
				<?php for($i = 0; $i < (5 - $infos['php']); $i++): ?>
					<div class="uncheck"><div class="uncheck1"></div></div>
				<?php endfor ?>
			</section>
			<section>
				<label>Javascript</label>
				<?php for($i = 0; $i < $infos['js']; $i++): ?>
					<div class="check"></div>
				<?php endfor ?>
				<?php for($i = 0; $i < (5 - $infos['js']); $i++): ?>
					<div class="uncheck"><div class="uncheck1"></div></div>
				<?php endfor ?>
			</section>
			<section>
				<label>Suite Office</label>
				<?php for($i = 0; $i < $infos['office']; $i++): ?>
					<div class="check"></div>
				<?php endfor ?>
				<?php for($i = 0; $i < (5 - $infos['office']); $i++): ?>
					<div class="uncheck"><div class="uncheck1"></div></div>
				<?php endfor ?>
			</section>
			<section>
				<label>Adobe Photoshop</label>
				<?php for($i = 0; $i < $infos['photo']; $i++): ?>
					<div class="check"></div>
				<?php endfor ?>
				<?php for($i = 0; $i < (5 - $infos['photo']); $i++): ?>
					<div class="uncheck"><div class="uncheck1"></div></div>
				<?php endfor ?>
			</section>
			<section>
				<label>Adobe Illustrator</label>
				<?php for($i = 0; $i < $infos['illustrator']; $i++): ?>
					<div class="check"></div>
				<?php endfor ?>
				<?php for($i = 0; $i < (5 - $infos['illustrator']); $i++): ?>
					<div class="uncheck"><div class="uncheck1"></div></div>
				<?php endfor ?>
			</section>
			<section>
				<label>Anglais</label>
				<?php for($i = 0; $i < $infos['anglais']; $i++): ?>
					<div class="check"></div>
				<?php endfor ?>
				<?php for($i = 0; $i < (5 - $infos['anglais']); $i++): ?>
					<div class="uncheck"><div class="uncheck1"></div></div>
				<?php endfor ?>
			</section>
		</section>
		<section id="creations">
		<?php foreach ($creations as $creation): ?>
			<article class="<?=$creation['type']?>">
				<img src="IMG/<?=$creation['img']?>">
				<h1><?=$creation['titre']?></h1>
				<p><?=$creation['description']?></p>
			</article>
		<?php endforeach ?>
		</section>
	</body>
</html>