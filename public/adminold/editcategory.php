<?php
$pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student', [PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION ]);
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/styles.css"/>
		<title>Kate's Kitchen - Admin</title>
	</head>
	<body>
	<header>
		<section>
			<aside>
				<h3>Opening times:</h3>
				<p>Sun-Thu: 12:00-22:00</p>
				<p>Fri-Sat: 12:00-23:30</p>
			</aside>
			<h1>Kate's Kitchen</h1>

		</section>
	</header>
	<nav>
		<ul>
			<li><a href="/">Home</a></li>
			<li>Menu
				<ul>
					<li><a href="/starters.php">Starters</a></li>
					<li><a href="/mains.php">Mains</a></li>
					<li><a href="/dessert.php">Dessert</a></li>

				</ul>
			</li>
			<li><a href="/about.html">About Us</a></li>
		</ul>

	</nav>
<img src="/images/randombanner.php"/>
	<main class="sidebar">


	<section class="left">
		<ul>
			<li><a href="menu.php">Menu</a></li>
			<li><a href="categories.php">Categories</a></li>

		</ul>
	</section>

	<section class="right">

	<?php

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('UPDATE category SET name = :name WHERE id = :id ');

		$criteria = [
			'name' => $_POST['name'],
			'id' => $_POST['id']
		];

		$stmt->execute($criteria);
		echo 'Category Saved';
	}
	else {
				$currentCategory = $pdo->query('SELECT * FROM category WHERE id = ' . $_GET['id'])->fetch();
			?>


				<h2>Edit Category</h2>

				<form action="" method="POST">

					<input type="hidden" name="id" value="<?php echo $currentCategory['id']; ?>" />
					<label>Name</label>
					<input type="text" name="name" value="<?php echo $currentCategory['name']; ?>" />


					<input type="submit" name="submit" value="Save Category" />

				</form>


	<?php


		}
	}

	else {
			?>
			<h2>Log in</h2>

			<form action="index.php" method="post">

				<label>Password</label>
				<input type="password" name="password" />

				<input type="submit" name="submit" value="Log In" />
			</form>
		<?php
		}

	?>


</section>
	</main>

	<footer>
		&copy; Kate's Kitchen 2017
	</footer>
</body>
</html>


