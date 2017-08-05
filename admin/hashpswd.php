<?php
	
	if(!empty($_POST))
	{
		echo '<pre>'.password_hash($_POST['pswd'], PASSWORD_DEFAULT).'</pre>';
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>hash</title>
</head>
<body>
	<form method="post" action="hashpswd.php">
		<input type="text" name="pswd">
		<input type="submit">
	</form>
</body>
</html>