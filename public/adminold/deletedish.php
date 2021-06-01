<?php
$pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student', [PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION ]);
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

	$stmt = $pdo->prepare('DELETE FROM menu WHERE id = :id');
	$stmt->execute(['id' => $_POST['id']]);


	header('location: menu.php');
}


