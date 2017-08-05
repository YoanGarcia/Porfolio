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

			if($post['formulaire'] === 'edition')
			{
				if(!isset($post['nom']) || empty($post['nom']))
				{
					$errors[] = 'les nom ne doit pas étre vide';
				}
				
				if(!isset($post['prenom']) || empty($post['prenom']))
				{
					$errors[] = 'les prenom ne doit pas étre vide';
				}

				if(!isset($post['email']) || empty($post['email']))
				{
					$errors[] = 'l\'email ne doit pas étre vide';
				}

				if(!isset($post['html']) || empty($post['html']))
				{
					$post['html'] = (int) $post['html'];

					if($post['html'] < 0 || $post['html'] > 5 || !is_numeric($post['html']))
					{
						$errors[] = 'html doit étre un nombre';
					}
				}

				if(!isset($post['css']) || empty($post['css']))
				{
					$post['css'] = (int) $post['css'];

					if($post['css'] < 0 || $post['css'] > 5 || !is_numeric($post['css']))
					{
						$errors[] = 'css doit étre un nombre';
					}
				}

				if(!isset($post['php']) || empty($post['php']))
				{
					$post['php'] = (int) $post['php'];

					if($post['php'] < 0 || $post['php'] > 5 || !is_numeric($post['php']))
					{
						$errors[] = 'php doit étre un nombre';
					}
				}

				if(!isset($post['js']) || empty($post['js']))
				{
					$post['js'] = (int) $post['js'];

					if($post['js'] < 0 || $post['js'] > 5 || !is_numeric($post['js']))
					{
						$errors[] = 'js doit étre un nombre';
					}
				}

				if(!isset($post['office']) || empty($post['office']))
				{
					$post['office'] = (int) $post['office'];

					if($post['office'] < 0 || $post['office'] > 5 || !is_numeric($post['office']))
					{
						$errors[] = 'office doit étre un nombre';
					}
				}

				if(!isset($post['photo']) || empty($post['photo']))
				{
					$post['photo'] = (int) $post['photo'];

					if($post['photo'] < 0 || $post['photo'] > 5 || !is_numeric($post['photo']))
					{
						$errors[] = 'photo doit étre un nombre';
					}
				}

				if(!isset($post['illustrator']) || empty($post['illustrator']))
				{
					$post['illustrator'] = (int) $post['illustrator'];

					if($post['illustrator'] < 0 || $post['illustrator'] > 5 || !is_numeric($post['illustrator']))
					{
						$errors[] = 'illustrator doit étre un nombre';
					}
				}

				if(!isset($post['anglais']) || empty($post['anglais']))
				{
					$post['anglais'] = (int) $post['anglais'];

					if($post['anglais'] < 0 || $post['anglais'] > 5 || !is_numeric($post['anglais']))
					{
						$errors[] = 'anglais doit étre un nombre';
					}
				}

				if(count($errors) == 0)
				{
					$req = $bdd->prepare('UPDATE infos SET nom = ?, prenom = ?, email = ?, html = ?, css = ?, php = ?, js = ?, office = ?, photo = ?, illustrator = ?, anglais = ? WHERE id = 1');
					if($req->execute([
							$post['nom'],
							$post['prenom'],
							$post['email'],
							$post['html'],
							$post['css'],
							$post['php'],
							$post['js'],
							$post['office'],
							$post['photo'],
							$post['illustrator'],
							$post['anglais'],
						]))
					{
						echo '<script>alert(\'les informations ont bien était mises à jour\')</script>';
					}
				}
			}			
		}
	}

	$req = $bdd->prepare('SELECT * FROM infos  WHERE id = 1');
	$req->execute();
	$infos = $req->fetch();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<title>Admin</title>
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
			<form method="post" action="index.php">
				<input type="hidden" name="formulaire" value="edition">

				<label>Nom</label>
				<input type="text" name="nom" value="<?=$infos['nom']?>">
				<br>

				<label>Prenom</label>
				<input type="text" name="prenom" value="<?=$infos['prenom']?>">
				<br>

				<label>Email</label>
				<input type="email" name="email" value="<?=$infos['email']?>">
				<br>

				<label>HTML5</label>
				<input type="number" name="html" value="<?=$infos['html']?>">
				<br>

				<label>CSS3</label>
				<input type="number" name="css" value="<?=$infos['css']?>">
				<br>

				<label>PHP</label>
				<input type="number" name="php" value="<?=$infos['php']?>">
				<br>

				<label>Javascript</label>
				<input type="number" name="js" value="<?=$infos['js']?>">
				<br>

				<label>Office</label>
				<input type="number" name="office" value="<?=$infos['office']?>">
				<br>

				<label>Photoshop</label>
				<input type="number" name="photo" value="<?=$infos['photo']?>">
				<br>

				<label>Illustrator</label>
				<input type="number" name="illustrator" value="<?=$infos['illustrator']?>">
				<br>

				<label>Anglais</label>
				<input type="number" name="anglais" value="<?=$infos['anglais']?>">
				<br>
				<br>
				<br>
				<input type="submit" value="edite">
			</form>
		<?php endif ?>
	</body>
</html>
