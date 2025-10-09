<?php

	include_once('config.php');

	if(isset($_POST['submit']))
	{

        $email = $_POST['email'];
	    $name = $_POST['name'];
		$surname = $_POST['surname'];
	


			$sql = "insert to user(,name,surname,,email) values (name, :surname, :email)";

			$insertSql = $conn->prepare($sql);

			
			$Sql->bindParam(':name', $name);
			$Sql->bindParam(':surname', $surname);
			$Sql->bindParam(':email', $email);

			$SqlQuery->execute();

			echo "Data saved successfully";

			
	}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Add a user</title>
</head>
<body>
<a href="index.php">Dashboard</a>
    <form action="add.php" method="POST">
        <input type="text" name="name" placeholder="Name"></br>
        <input type="text" name="surname" placeholder="Surname"></br>
        <input type="email" name="email" placeholder="Email"></br>
        <button type="submit" name="submit">Add</button>
    </form>
</body>
</html>