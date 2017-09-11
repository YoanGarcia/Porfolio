<?php 
	session_start();

	$bdd = new PDO('mysql:host=localhost;dbname=yoan;charset=utf8', 'root', '') or die($pdo->errorInfo());

	$connect = false;
	$errors = [];
	
	if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin')
	{
		$connect = true;
	}

	if(!empty($_POST))
	{
		$post = array_map('strip_tags', $_POST);
		$post = array_map('trim', $post);

		if(isset($post['formulaire']))
		{
			if($post['formulaire'] === 'connection')
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
						$errors[] = 'erreur d\'identification';
					}
				}
				else
				{
					$errors[] = 'erreur d\'identification';
				}
			}

			if($post['formulaire'] === 'infos')
			{
				if(!isset($post['email']) || empty($post['email']))
				{
					$errors[] = 'l\'email ne doit pas étre vide';
				}

				if(!isset($post['lien_cv']) || empty($post['lien_cv']))
				{
					$errors[] = 'lien_cv ne doit pas étre vide';
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
				    	$errors[] = 'erreur d\'upload de limage';
				    	unset($_FILES['picture']);
				    } 
				}

				if(count($errors) == 0)
				{
					$req = $bdd->prepare('UPDATE infos SET telephone = ?, email = ?, lien_cv = ?, apropos = ?, photoCV = ? WHERE id = 1');
					if($req->execute([
							$post['telephone'],
							$post['email'],
							$post['lien_cv'],
							$post['apropos'],
							$finalFileName,
						]))
					{
						echo '<script>alert(\'les informations ont bien était mises à jour\')</script>';
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
							var_dump($req->errorinfo());
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
						var_dump($req->errorinfo());
						echo '<script>alert(\'la competence '.$post['titre'].' à bien était ajouter\')</script>';
					}
				}
			}

			if($post['formulaire'] === 'del_competences')
			{
				if(!isset($post['titre']) || empty($post['titre']))
				{
					$errors[] = 'le Nom ne doit pas étre vide';
				}

				if(count($errors) == 0)
				{
					$req = $bdd->prepare('DELETE FROM competences WHERE titre = ?');
					if($req->execute([
							$post['titre'],
						]))
					{
						echo '<script>alert(\'la competence '.$post['titre'].' à bien était Supprimer\')</script>';
					}
				}		
			}

			/**
			 *   MODIFIE UNE/DES CREATION/S
			 */

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
						var_dump($req->errorinfo());
						echo '<script>alert(\'erreur impossible de metre a jour la competence '.$competence['titre'].'\')</script>';
					}
				}
			}

			/**
			 *  AJOUTE UNE CREATION
			 */

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
						var_dump($req->errorinfo());
						echo '<script>alert(\'erreur impossible de metre a jour la competence '.$competence['titre'].'\')</script>';
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
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<title>Admin</title>

		<!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
	</head>
	<body>
		<?php if (count($errors) != 0): ?>

			<?php foreach ($errors as $value): ?>
				<?=$value?><br>
			<?php endforeach ?>

		<?php endif ?>

		<?php if (!$connect): ?>
			<form method="post" action="index.php">
				<input type="hidden" name="formulaire" value="connection">

				<label>pseudo</label>
				<input type="text" name="pseudo">

				<label>password</label>
				<input type="password" name="password">

				<input type="submit" value="connect">
			</form>
		<?php else: ?>

			<section id="formulaire_infos">
				<form method="post" action="index.php" enctype="multipart/form-data">
					<input type="hidden" name="formulaire" value="infos">

					<label>Telephone</label>
					<input type="text" name="telephone" value="<?=$infos['telephone']?>">
					<br>

					<label>Email</label>
					<input type="email" name="email" value="<?=$infos['email']?>">
					<br>

					<label>lien CV</label>
					<input type="url" name="lien_cv" value="<?=$infos['lien_cv']?>">
					<br>
					
					<label>à propos</label>
					<textarea name="apropos"><?=$infos['apropos']?></textarea>
					<br>

					<label>PhotoCV</label>
					<input type="file" name="picture">
					<br>

					<input type="submit" value="Modifier">
				</form>
			</section>

			<section id="competences">
				<section id="edit_competences">
					<form method="post" action="index.php">
						<input type="hidden" name="formulaire" value="edit_competences">
						<?php foreach ($competences as $competence): ?>
							<label><?=$competence['titre']?></label>
							<input type="number" name="<?=$competence['id']?>" value="<?=$competence['points']?>">	
							<br>	
						<?php endforeach ?>
						<input type="submit" value="Modifier">
					</form>
				</section>

				<section id="add_competences">
					<form method="post" action="index.php">
						<input type="hidden" name="formulaire" value="add_competences">
						
						<label>Nom de la competence</label>
						<input type="text" name="titre">
						<br>

						<label>Points de competence</label>
						<input type="number" name="points">
						<br>

						<input type="submit" value="Ajouter">
					</form>
				</section>

				<section id="del_competences">
					<form method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="formulaire" value="del_competences">
						
						<label>Nom de la competence</label>
						<input type="text" name="titre">
						<br>

						<input type="submit" value="Supprimer">
					</form>
				</section>

				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>

				<section id="add_creation">
					<form method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="formulaire" value="add_creation">
						
						<label>Titre</label>
						<input type="text" name="titre">
						<br>

						<label>Temp de travail</label>
						<input type="text" name="temp">
						<br>

						<br>
						<label>Images</label>
						<input type="file" name="picture">
						<br>

						<label>Description</label>
						<textarea name="description"></textarea>
						<br>

						<label>Type :</label>
						<br>
						<label>Adobe Photoshop<input type="radio" name="type" value="photo"></label><br>
						<label>Adobe Illustrator<input type="radio" name="type" value="illu"></label><br>
						<label>3ds Max<input type="radio" name="type" value="c3ds"></label><br>
						<br>

						<input type="submit" value="Ajouter">
					</form>
				</section>

				<section id="edit_creation">
					<?php foreach ($creations as $creation): ?>
						<form method="post" action="index.php" enctype="multipart/form-data">
							<input type="hidden" name="formulaire" value="edit_creation">
							<input type="hidden" name="creation_id" value="<?=$creation['id']?>">
							<input type="hidden" name="creation_img" value="<?=$creation['img']?>">
							
							<label>Titre</label>
							<input type="text" name="titre" value="<?=$creation['titre']?>">
							<br>

							<label>Temp de travail</label>
							<input type="text" name="temp" value="<?=$creation['temp']?>">
							<br>

							<img src="../IMG/<?=$creation['img']?>" width="50" height="50">
							<br>
							<label>Images</label>
							<input type="file" name="picture">
							<br>

							<label>Description</label>
							<textarea name="description"><?=$creation['description']?></textarea>
							<br>

							<label>Type :</label>
							<br>
							<label>Adobe Photoshop<input type="radio" name="type" value="photo" <?= ($creation['type'] === 'photo') ? 'checked' : '' ?> ></label><br>
							<label>Adobe Illustrator<input type="radio" name="type" value="illu" <?= ($creation['type'] === 'illu') ? 'checked' : '' ?> ></label><br>
							<label>3ds Max<input type="radio" name="type" value="c3ds" <?= ($creation['type'] === 'c3ds') ? 'checked' : '' ?> ></label><br>
							<br>

							
							<input type="submit" value="Modifier">
						</form>
					<?php endforeach ?>
				</section>

				<!-- <section id="add_competences">
					<form method="post" action="index.php">
						<input type="hidden" name="formulaire" value="add_competences">
						
						<label>Nom de la competence</label>
						<input type="text" name="titre">
						<br>

						<label>Points de competence</label>
						<input type="number" name="points">
						<br>

						<input type="submit" value="Ajouter">
					</form>
				</section>

				<section id="del_competences">
					<form method="post" action="index.php">
						<input type="hidden" name="formulaire" value="del_competences">
						
						<label>Nom de la competence</label>
						<input type="text" name="titre">
						<br>

						<input type="submit" value="Supprimer">
					</form>
				</section> -->

			</section>		
		<?php endif ?>
	</body>
</html>
