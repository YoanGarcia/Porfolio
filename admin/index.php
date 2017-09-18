<?php
session_start();

	$bdd = new PDO('mysql:host=localhost;dbname=yoan;charset=utf8', 'root', '') or die($pdo->errorInfo());

	$connect = false;
	$errors = [];
	
	if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin')
	{
		$connect = true;
		session_destroy();
	}

	if(!empty($_POST))
	{
		$post = array_map('strip_tags', $_POST);
		$post = array_map('trim', $post);

		if(isset($post['formulaire']))
		{
			if($post['formulaire'] === 'connection' and $connect != true)
			{
				$req = $bdd->prepare('SELECT * FROM user  WHERE pseudo = ?');
				$req->execute([$post['pseudo']]);
				$user = $req->fetch();

				if(!empty($user))
				{
					if(password_verify($post['password'], $user['password']))
					{
						$_SESSION['user'] = [
							'pseudo'  => $user['pseudo'],
							'role'		  => $user['role'],
							];
					}
					else
					{
						$errors[] = '<div class="errorconnection"><p>Erreur d\'identification</p></div>';
					}
				}
				else
				{
					$errors[] = '<div class="errorconnection"><p>Erreur d\'identification</p></div>';
				}
			}

			if($post['formulaire'] === 'infos')
			{
				if(!isset($post['email']) || empty($post['email']))
				{
					$errors[] = 'l\'email ne doit pas étre vide';
				}

				if(!isset($post['apropos']) || empty($post['apropos']))
				{
					$errors[] = 'apropos ne doit pas étre vide';
				}

				if(!empty($_FILES) && isset($_FILES['picture']))
				{
				    if ($_FILES['picture']['error'] == UPLOAD_ERR_OK) 
				    {
				        $nomFichier = $_FILES['picture']['name'];
				        $tmpFichier = $_FILES['picture']['tmp_name']; 
				                       
			            $newFileName = explode('.', $nomFichier);
			            $fileExtension = end($newFileName);

			            $finalFileName = 'photoCV.'.$fileExtension; 

			            if(move_uploaded_file($tmpFichier, '../IMG/'.$finalFileName)) 
			            {
			                echo '<script>alert(\'la photo a bien était mise à jour\')</script>';  
			                unset($_FILES['picture']);  
			            }
				    }
				    else
				    {
				    	if($_FILES['picture']['error'] != 4)
				    	{
				    		$errors[] =  'erreur d\'upload de limage . code : '.$_FILES['picture']['error'];
				    	}
				    	else
				    	{
				    		$finalFileName = 'photoCV.png';
				    	}
				    	unset($_FILES['picture']);
				    } 
				}

				if(count($errors) == 0)
				{
					$req = $bdd->prepare('UPDATE infos SET telephone = ?, email = ?, apropos = ?, photoCV = ? WHERE id = 1');
					if($req->execute([
							$post['telephone'],
							$post['email'],
							$post['apropos'],
							$finalFileName,
						]))
					{
						echo '<script>alert(\'les informations ont bien était mises à jour\')</script>';
					}
				}
			}

			if($post['formulaire'] === 'cv')
			{
				if(!empty($_FILES) && isset($_FILES['cv']))
				{
				    if ($_FILES['cv']['error'] == UPLOAD_ERR_OK) 
				    {
				        $nomFichier = $_FILES['cv']['name'];
				        $tmpFichier = $_FILES['cv']['tmp_name']; 
				                       
			            $newFileName = explode('.', $nomFichier);
			            $fileExtension = end($newFileName);

			            $finalFileName = 'CV.'.$fileExtension; 

			            if(move_uploaded_file($tmpFichier, '../IMG/'.$finalFileName)) 
			            {
			                $req = $bdd->prepare('UPDATE infos SET CV = ? WHERE id = 1');
							if($req->execute([$finalFileName]))
							{
								echo '<script>alert(\'les informations ont bien était mises à jour\')</script>';
							} 
			                unset($_FILES['cv']);  
			            }
				    }
				    else
				    {
				    	$errors[] =  'erreur d\'upload de limage . code : '.$_FILES['picture']['error'];			    	
				    	unset($_FILES['picture']);
				    } 
				}
			}

			if($post['formulaire'] === 'edit_competences')
			{
				$req = $bdd->prepare('SELECT * FROM competences');
				$req->execute();
				$competences = $req->fetchall(PDO::FETCH_ASSOC);

				foreach ($competences as $competence) 
				{
					if(empty($post[$competence['id']]) || !isset($post[$competence['id']]))
					{
						$post[$competence['id']] = (int) $post[$competence['id']];

						if($post[$competence['id']] < 0 || $post[$competence['id']] > 5)
						{
							$errors[] = $comptence['titre'].' doit etre compris entre 0 et 5';
						}
					}
				}

				if(count($errors) == 0)
				{
					if(!empty($_FILES) && isset($_FILES['picture']))
					{
					    if ($_FILES['picture']['error'] == UPLOAD_ERR_OK) 
					    {
					        $nomFichier = $_FILES['picture']['name'];
					        $tmpFichier = $_FILES['picture']['tmp_name']; 
					                       
				            $newFileName = explode('.', $nomFichier);
				            $fileExtension = end($newFileName);

				            $finalFileName = 'photoCV.'.$fileExtension; 

				            if(move_uploaded_file($tmpFichier, '../IMG/'.$finalFileName)) 
				            {
				                echo '<script>alert(\'la photo a bien était mise à jour\')</script>';  
				                unset($_FILES['picture']);  
				            }
					    }
					    else
					    {
					    	$errors[] = 'erreur d\'upload de limage';
					    	unset($_FILES['picture']);
					    } 
					}

					foreach ($competences as $competence) 
					{	
						$req = $bdd->prepare('UPDATE competences SET points = ? WHERE id = '.$competence['id']);
						if(!$req->execute([
								$post[$competence['id']]
							]))
						{
							echo '<script>alert(\'erreur impossible de metre a jour la competence '.$competence['titre'].'\')</script>';
						}
					}
				}
			}	

			if($post['formulaire'] === 'add_competences')
			{
				if(!isset($post['titre']) || empty($post['titre']))
				{
					$errors[] = 'le Nom ne doit pas étre vide';
				}

				if(empty($post['points']) || !isset($post['points']))
				{
					$post['points'] = (int) $post['points'];

					if($post['points'] < 0 || $post['points'] > 5)
					{
						$errors[] = ' le nombre de points doit etre compris entre 0 et 5';
					}
				}

				if(count($errors) == 0)
				{
					$req = $bdd->prepare('INSERT INTO competences (titre, points) VALUES(?, ?)');
					if($req->execute([
							$post['titre'],
							$post['points']
						]))
					{
						echo '<script>alert(\'la competence '.$post['titre'].' à bien était ajouter\')</script>';
					}
				}
			}

			if($post['formulaire'] === 'del_competences')
			{
				if(count($errors) == 0)
				{
					$req = $bdd->prepare('DELETE FROM competences WHERE id = ?');
					if($req->execute([
							$post['id'],
						]))
					{
						echo '<script>alert(\'la competence '.$post['titre'].' à bien était Supprimer\')</script>';
					}
				}		
			}

			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
			/* * * * * * * * * * * * * *  MODIFIE UNE/DES CREATION/S * * * * * * * * * * * * * */
			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

			if($post['formulaire'] === 'edit_creation')
			{				
				if(!isset($post['type']) || empty($post['type']))
				{
					$errors[] = 'le Type ne doit pas étre vide';
				}

				if(!isset($post['titre']) || empty($post['titre']))
				{
					$errors[] = 'le titre ne doit pas étre vide';
				}

				if(!isset($post['description']) || empty($post['description']))
				{
					$errors[] = 'la description ne doit pas étre vide';
				}

				if(!isset($post['temp']) || empty($post['temp']))
				{
					$errors[] = 'le temp ne doit pas étre vide';
				}

				if(!empty($_FILES) && isset($_FILES['picture']))
				{	
					if ($_FILES['picture']['error'] == UPLOAD_ERR_OK) 
				    {
				        $nomFichier = $_FILES['picture']['name'];
				        $tmpFichier = $_FILES['picture']['tmp_name']; 
				                       
			            $newFileName = explode('.', $nomFichier);
			            $fileExtension = end($newFileName);

			            $imgname = explode('.', $post['creation_img'])[0];
			            $finalFileName = $imgname.'.'.$fileExtension; 

			            if(move_uploaded_file($tmpFichier, '../IMG/'.$finalFileName)) 
			            {
			            	$img = $finalFileName;
			                echo '<script>alert(\'la photo a bien était mise à jour\')</script>';  
			                unset($_FILES['picture']);  
			            }
				    }
				    else
				    {
				    	if($_FILES['picture']['error'] != 4)
				    	{
				    		$errors[] =  'erreur d\'upload de limage . code : '.$_FILES['picture']['error'];
				    	}
				    	else
				    	{
				    		$img = $post['creation_img'];
				    	}
				    	unset($_FILES['picture']);
				    }
				}
				else
				{
					$img = $post['creation_img'];
				}

				if(count($errors) == 0)
				{
					$req = $bdd->prepare('UPDATE creations SET type = ?, titre = ?, description = ?, img = ?, temp = ? WHERE id = '.$post['creation_id']);
					if(!$req->execute([
							$post['type'],
							$post['titre'],
							$post['description'],
							$img,
							$post['temp'],
						]))
					{
						echo '<script>alert(\'erreur impossible de metre a jour la competence '.$competence['titre'].'\')</script>';
					}
				}
			}

			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
			/* * * * * * * * * * * * * * * * * AJOUTE UNE CREATION * * * * * * * * * * * * * * */
			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

			if($post['formulaire'] === 'add_creation')
			{				
				if(!isset($post['type']) || empty($post['type']))
				{
					$errors[] = 'le Type ne doit pas étre vide';
				}

				if(!isset($post['titre']) || empty($post['titre']))
				{
					$errors[] = 'le titre ne doit pas étre vide';
				}

				if(!isset($post['description']) || empty($post['description']))
				{
					$errors[] = 'la description ne doit pas étre vide';
				}

				if(!isset($post['temp']) || empty($post['temp']))
				{
					$errors[] = 'le temp ne doit pas étre vide';
				}

				if(!empty($_FILES) && isset($_FILES['picture']))
				{	
					if ($_FILES['picture']['error'] == UPLOAD_ERR_OK) 
				    {
				        $nomFichier = $_FILES['picture']['name'];
				        $tmpFichier = $_FILES['picture']['tmp_name']; 
				                       
			            $newFileName = explode('.', $nomFichier);
			            $fileExtension = end($newFileName);

			            $finalFileName = time().'.'.$fileExtension; 

			            if(move_uploaded_file($tmpFichier, '../IMG/'.$finalFileName)) 
			            {
			            	$img = $finalFileName;
			                echo '<script>alert(\'la photo a bien était mise à jour\')</script>';  
			                unset($_FILES['picture']);  
			            }
				    }
				    else
				    {
				    	$errors[] =  'erreur d\'upload de limage . code : '.$_FILES['picture']['error'];
				    	unset($_FILES['picture']);
				    }
				}

				if(count($errors) == 0)
				{
					$req = $bdd->prepare('INSERT INTO creations (type, titre, description, img, temp) VALUES(?,?,?,?,?)');
					if(!$req->execute([
							$post['type'],
							$post['titre'],
							$post['description'],
							$img,
							$post['temp'],
						]))
					{
						echo '<script>alert(\'erreur impossible de metre a jour la competence '.$competence['titre'].'\')</script>';
					}
				}
			}

			if($post['formulaire'] === 'del_creation')
			{
				if(count($errors) == 0)
				{
					$req = $bdd->prepare('DELETE FROM creations WHERE id = ?');
					if($req->execute([
							$post['id'],
						]))
					{
						echo '<script>alert(\'la creation à bien était Supprimer\')</script>';
					}
				}		
			}
		}
	}

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

<!-- ************************************************************************************************** -->
<!-- ************************************************************************************************** -->
<!-- ************************************************************************************************** -->

<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initiam-scale-1.0" />

		<title>Admin Yoan Garcia</title>

		<link rel="shortcut icon" type="image/jpg" href="IMG/MonLogoNoir.png" />
		<link rel="stylesheet" type="text/css" href="css/styleadmin.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="../js/script.js" defer></script>
		<script src="../js/smoothscroll.js" defer></script>
	</head>

	<body>
		<?php if (count($errors) != 0): ?>

			<?php foreach ($errors as $value): ?>
				<?=$value?><br>
			<?php endforeach ?>

		<?php endif ?>

		<?php if (!$connect): ?>

		<!-- Formulaire de connection -->
		<form class="form1" method="post" action="index.php">
			<input class="input1" type="hidden" class="champ" name="formulaire" value="connection">

			<div class="group">
				<input class="input1" type="text" name="pseudo"><span class="highlight"></span><span class="bar"></span>
				<label class="label1">Pseudo</label>
			</div>
			<div class="group">
				<input class="input1" type="password" name="password" ><span class="highlight"></span><span class="bar"></span>
				<label class="label1">Password</label>
			</div>

			<button type="submit" value"connect" class="button buttonBlue">Connection
				<div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
			</button>
		</form>

		<?php else: ?>

		<!-- Liens directs -->
		<a href="../index.php" class="backto backtosite">Retour au site</a>
		<a href="#" class="backto backtotop">Retour en haut</a>

		<a href="#" class="backto backtoapropos">A propos</a>
		<a href="#competences" class="backto backtocompetences">Compétences</a>
		<a href="#creas" class="backto backtocreations">Création</a>

		<!-- Section A propos et footer -->
		<section id="formulaire_infos">

			<!-- Formulaire modification A propos et footer -->
			<form class="form1 divinlinbloc" method="post" action="index.php" enctype="multipart/form-data">
				<h1>Information A propos et Footer</h1>
				<br><br><hr><br>

				<input class="input1" type="hidden" name="formulaire" value="infos">

				<div class="group">
					<label class="label1">Téléphone</label><br><br>
					<input class="input1" type="text" name="telephone" value="<?=$infos['telephone']?>"><span class="highlight"></span><span class="bar"></span>
				</div>

				<div class="group">
					<label class="label1">Email</label><br><br>
					<input class="input1" type="email" name="email" value="<?=$infos['email']?>"><span class="highlight"></span><span class="bar"></span>
				</div>

				<div class="group">
					<textarea class="txtapropos" name="apropos"><?=$infos['apropos']?></textarea>
				</div>

				<div class="group">
					<label class="label1">Photo CV</label><br><br>
					<input class="input1" type="file" name="picture" value="<?=$infos['email']?>"><span class="highlight"></span><span class="bar"></span>
				</div>

				<input class="boutonedit" type="submit" value="Modifier les infos">

			</form>

			<!-- Formulaire de modification du CV -->
			<form class="form1 divinlinbloc" method="post" action="index.php" enctype="multipart/form-data">
				<h1>Modification du CV</h1>
				<br><br><hr><br>

				<input class="input1" type="hidden" name="formulaire" value="cv">

				<div class="group">
					<label class="label1">Mon CV</label><br><br>
					<input class="input1" type="file" name="cv"><span class="highlight"></span><span class="bar"></span>
				</div>

				<input class="boutonedit" type="submit" value="Modifier le CV">
			</form>
		</section>

		<br><br><hr><hr><hr><hr><br><br> <!-- *********************************************** -->

		<!-- Section Compétences -->
		<section id="competences">

			<div class="divinlinbloc">
				<div class="divinlinbloc">

					<section id="edit_competences">

						<!-- Formulaire modification des compétences -->
						<form class="form1" method="post" action="index.php">

							<h1>Modification des compétences</h1>
							<br><br><hr><br>

							<input class="input1" type="hidden" name="formulaire" value="edit_competences">

							<?php foreach ($competences as $competence): ?>
								<div class="group">
									<div class="divinlinbloc">
										<label class="label2"><?=$competence['titre']?></label>
									</div>
									<div class="divinlinbloc">
										<input class="input2" type="number" name="<?=$competence['id']?>" value="<?=$competence['points']?>"><span class="highlight"></span><span class="bar"></span>
									</div>
								</div>	
							<?php endforeach ?>

							<br><br>
							<input class="boutonedit" type="submit" value="Modifier les compétences">
						</form>

					</section>
					
				</div>

				<div class="divinlinbloc">
				
					<section id="add_competences">

						<!-- Formulaire d'ajout d'une compétence -->
						<form class="form1" method="post" action="index.php">

							<h1>Ajouter une compétence</h1>
							<br><br><hr><br>

							<input class="input1" type="hidden" name="formulaire" value="add_competences">

							<div class="group">
								<label class="label1">Nom de la compétence</label><br><br>
								<input class="input1" type="text" name="titre"><span class="highlight"></span><span class="bar"></span>
							</div>

							<div class="group">
								<div class="divinlinbloc">
									<label class="label2">Points de compétences</label>
								</div>
								<div class="divinlinbloc">
									<input class="input2" type="number" name="points"><span class="highlight"></span><span class="bar"></span>
								</div>
							</div>
							
							<input class="boutonedit" type="submit" value="Ajouter la compétence">

						</form>

					</section>

					<!-- Formulaire de suppression de compétences -->
					<section id="del_competences">

						<form class="form1" method="post" action="index.php" enctype="multipart/form-data">

							<h1>Supprimer une compétence</h1>
							<br><br><hr><br>

							<input class="input1" type="hidden" name="formulaire" value="del_competences">
								
							<SELECT name="id" size="1">
								<?php foreach ($competences as $competence): ?>
									<option value="<?=$competence['id']?>"><?=$competence['titre']?></option>									
								<?php endforeach ?>	
							</SELECT>
							<br><br>

							<input class="boutonedit" type="submit" value="Supprimer la compétence">

						</form>
					</section>
					
				</div>
			</div>
				
			<br><br><hr><hr><hr><hr><br><br> <!-- *********************************************** -->

			<!-- Section Créations -->
			<div id="creas" class="divinlinbloc">
				<div class="divinlinbloc">

					<section id="add_creation">

						<!-- Formulaire d'ajout d'une création -->
						<form class="form1" method="post" action="index.php" enctype="multipart/form-data">

							<h1>Ajouter une création</h1>
							<br><br><hr><br>

							<input class="input1" type="hidden" name="formulaire" value="add_creation">

							<div class="group">
								<label class="label1">Titre</label><br><br>
								<input class="input1" type="text" name="titre"><span class="highlight"></span><span class="bar"></span>
							</div>

							<div class="group">
								<label class="label1">Temps de travail</label><br><br>
								<input class="input1" type="text" name="temp"><span class="highlight"></span><span class="bar"></span>
							</div>

							<div class="group">
								<label class="label1">Photo de la création</label><br><br>
								<input class="input1" type="file" name="picture"><span class="highlight"></span><span class="bar"></span>
							</div>

							<div class="group">
								<label class="label1">Description</label><br><br>
								<textarea class="txtdescription" name="description"></textarea>
							</div>

							<div class="group">
								<label class="label1">Type :</label><br><br>
								
								<label>Adobe Photoshop
									<input type="radio" name="type" value="photo">
								</label><br>
								<label>Adobe Illustrator
									<input type="radio" name="type" value="illu">
								</label><br>
								<label>3DS Max
									<input type="radio" name="type" value="c3ds">
								</label><br>
							</div>

							<input class="boutonedit" type="submit" value="Ajouter la création">

						</form>
					</section>
					
				</div>
				
				<div class="divinlinbloc">

					<section id="del_creation">

						<!-- Formulaire de suppression d'une création -->
						<form class="form1" method="post" action="index.php" enctype="multipart/form-data">

							<h1>Supprimer une création</h1>
							<br><br><hr><br>
							
							<input class="input1" type="hidden" name="formulaire" value="del_creation">
								
							<SELECT name="id" size="1">
								<?php foreach ($creations as $creation): ?>
									<option value="<?=$creation['id']?>"><?=$creation['titre']?></option>									
								<?php endforeach ?>	
							</SELECT>
							<br><br>

							<input class="boutonedit" type="submit" value="Supprimer la création">

						</form>
					</section>
					
				</div>
			</div>

			<br><br><hr><hr><hr><hr><br><br> <!-- *********************************************** -->

			<!-- Section de formulaires de modification des créations -->
			<section id="edit_creation">

				<div class="form1">
					<h1>Modifier une création</h1>
					<br><br><hr><br>
				</div>

				<div class="divinlinbloc">

					<?php foreach ($creations as $creation): ?>
						<form class="form1 divinlinbloc" method="post" action="index.php" enctype="multipart/form-data">

								<input class="input1" type="hidden" name="formulaire" value="edit_creation">
								<input class="input1" type="hidden" name="creation_id" value="<?=$creation['id']?>">
								<input class="input1" type="hidden" name="creation_img" value="<?=$creation['img']?>">

								<div class="group">
									<label class="label1">Titre</label><br><br>
									<input class="input1" type="text" name="titre" value="<?=$creation['titre']?>"><span class="highlight"></span><span class="bar"></span>
								</div>

								<div class="group">
									<label class="label1">Temps de travail</label><br><br>
									<input class="input1" type="text" name="temp" value="<?=$creation['temp']?>"><span class="highlight"></span><span class="bar"></span>
								</div>

								<img src="../IMG/<?=$creation['img']?>" width="150" height="150">

								<div class="group">
									<label class="label1">Image</label><br><br>
									<input class="input1" type="file" name="picture"><span class="highlight"></span><span class="bar"></span>
								</div>

								<div class="group">
									<label class="label1">Description</label><br><br>
									<textarea class="txtdescription" name="description"><?=$creation['description']?></textarea>
								</div>

								<div class="group">
									<label class="label1">Type :</label><br><br>
									
									<label>Adobe Photoshop<input type="radio" name="type" value="photo" <?= ($creation['type'] === 'photo') ? 'checked' : '' ?> ></label><br>
									<label>Adobe Illustrator<input type="radio" name="type" value="illu" <?= ($creation['type'] === 'illu') ? 'checked' : '' ?> ></label><br>
									<label>3ds Max<input type="radio" name="type" value="c3ds" <?= ($creation['type'] === 'c3ds') ? 'checked' : '' ?> ></label><br>
								</div>
								
								<input class="boutonedit" type="submit" value="Modifier la création">
						</form>

					<?php endforeach ?>
				</div>

			</section>

		</section>

		<?php endif ?>
	</body>
</html>