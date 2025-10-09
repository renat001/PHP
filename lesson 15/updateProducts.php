<?php

include_once('config.php');

if(isset($_POST['update']))
{
	$id = $_POST['id'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
}
else
{
	$sql = "UPDATE users SET username=:username, name=:name, surname=:surname, email=:email WHERE id=:id";
	$prep = $conn->prepare($sql);
	$prep->bindParam(':id', $id);
	$prep->bindParam(':username', $username);
	$prep->bindParam(':name', $name);
	$prep->bindParam(':surname', $surname);
	$prep->bindParam(':email', $email);

	$prep->execute();

	header("Location:dashboard.php");
}


?>