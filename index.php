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
/*
Коллеги, добрый день!
Базовое задание:
Необходимо выбрать все данные из таблицы books (если используете сервер Нетологии, то база данных global, если нет, то дамп базы данных находится в файле dump.txt) и вывести их на странице в виде таблицы.
Расширенное задание:
Добавить возможность фильтровать данные по трем параметрам: ISBN, name, author. Для ввода данных для фильтрации следует использовать текстовые поля. Фильтр должен работать по принципу поиска введенной подстроки в любом месте строки (как мы разбирали во время лекции).
Задание для самых отчаянных:
Фильтры должны суммироваться, т.е. если пользователь ввел фильтр по ISBN, который возвращает 3 записи, и при этом ввел фильтр по имени автора, который возвращает 2 записи, то в результате будут выведены записи, которые соответсвуют фильтру по ISBN и по имени автора. При этом введенные значения фильтров должны сохраняться в полях для ввода после вывода страницы с результатами.
Пример того, как все должно работать в «максимальной комплектации»: http://university.netology.ru/u/vfilipov/homework.php
Рекомендую делать по порядку, выполняя задачи начиная от простого к сложному.
*/
	error_reporting(E_ALL);
	$pdo = new PDO("mysql:host=localhost;dbname=bd1","root","");
	//$pdo = new PDO("mysql:host=localhost;dbname=global","root","");
	
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