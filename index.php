<!DOCTYPE html>
<html>
<head>
	<title>Поиск книг</title>
	<meta charset="utf-8">
	<link type="text/css" href="style.css" rel="stylesheet" charset="utf-8">	
</head>
<h1>Поиск книги</h1>
<body>	
<?php
	error_reporting(E_ALL);
	
	$pdo = new PDO("mysql:host=localhost;dbname=global","babushkin","neto0410");
	$pdo->exec("set names utf8");
	
	if (!empty($_GET)) 
	{
		$isbn = htmlspecialchars($_GET['isbn']);
		$name = htmlspecialchars($_GET['name']);
		$author = htmlspecialchars($_GET['author']);		
		$sql = "SELECT * FROM books WHERE name LIKE '%$name%' AND isbn LIKE '%$isbn%' AND author LIKE '%$author%'";
	}
	else
	{
		$isbn = "";
		$name = "";
		$author = "";	
		$sql = "SELECT * FROM books";
	}
?>
<form action="" method="get">
	<input type="text" name="isbn" placeholder="ISBN" value="<?= $isbn ?>" /> 
	<input type="text" name="name" placeholder="Название" value="<?= $name ?>" /> 
	<input type="text" name="author" placeholder="Автор" value="<?= $author ?>" /> 
	<input type="submit" value="Найти" />&nbsp;&nbsp;
	<a href="index.php">Сбросить фильтр</a>
</form>
<table>
<tr><th>Название</th><th>Автор</th><th>Год выпуска</th><th>Жанр</th><th>ISBN</th></tr>
<?php	
	foreach ($pdo->query($sql) as $row) 
	{
		?><tr><td><?= $row['name'] ?></td><td><?= $row['author'] ?></td><td><?= $row['year'] ?></td><td><?= $row['genre'] ?></td><td><?= $row['isbn'] ?></td></tr><?php
	}
?>	
</table>
</body>
</html>
