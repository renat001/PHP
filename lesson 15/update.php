<?php

 include_once('config.php');

   if(isset($_POST['update']))
  {
	$id = $_POST['id'];
	$username = $_POST['title'];
	$name = $_POST['description'];
	$surname = $_POST['quantity'];
	$email = $_POST['price'];
	if(empty($title) || empty($description) || empty($quantity) || empty($price))
	{
		echo "You need to fill all the fields.";
		header("refresh:2; url=product.php");
	}
	else
	{
	   $sql = "UPDATE products SET  title=:title, description=:description, quantity=:quantity, price=:price, WHERE id=:id";
	   
	   $updateSql = $conn->prepare($sql);


	   $updateSql->bindParam(':id', $id);
	   $updateSql->bindParam(':title', $title);
	   $updateSql->bindParam(':description', $description);
	   $updateSql->bindParam(':quantity', $quantity);
	   $updateSql->bindParam(':price', $price);
	

	   header("Location:productDashboard.php");
	}
  }
?>