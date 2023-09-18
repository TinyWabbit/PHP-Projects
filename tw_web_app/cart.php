<!DOCTYPE html>
<html>

<head>
	<title>Shopping Cart</title>

</head>
<style>
	body {
		background-color: green;
	}
	header, nav, main, footer {
		background-color: white;
	}
	table {
		border-collapse: collapse;
		width: 100%;
	}
	th, td {
		text-align: left;
		padding: 8px;
	}
	th {
		background-color: #dddddd;
	}
	tr:nth-child(even) {
		background-color: #f2f2f2;
	}
	footer {
		background-color: green;
		margin-top: 348px;
		color: black;
		max-width: 264px;
	
	}
	
	
</style>

<body>
	<header>
		<h1><?php session_start();
$user = $_SESSION['user'];
echo $user['name']; ?> Shopping Cart</h1>
	</header>

	<nav>
		<ul>
			<li>
				<a href="shop.php">Home</a>
			</li>
			<li>
				<a href="shop.php">Products</a>
			</li>
			<li>
				<a href=
"mailto:test_user_contact@outlook.com">Contact Us</a>
			</li>
			<li>
				<a href="cart.php">Cart</a>
			</li>
		</ul>
	</nav>

	<main>
		<section>
			<table>
				<tr>
					<th>Product Name </th>
					<th>Quantity </th>
					<th>Price </th>
					<th>Total </th>
				</tr>
				<?php
				$servername = "localhost";
				$username = "root";
				$password = "mysql";
				$dbname = "shp";

				// Create connection
				$conn =
					new mysqli($servername, $username, $password, $dbname);

				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$total = 0;

				// Loop through items in cart and display in table
				foreach ($_SESSION['cart'] as $product_id => $quantity) {
					$sql = "SELECT * FROM products WHERE id = $product_id";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						$name = $row['name'];
						$price = $row['price'];
						$item_total = $quantity * $price;
						$total += $item_total;

						echo "<tr>";
						echo "<td>$name</td>";
						echo "<td>$quantity</td>";
						echo "<td>$price $</td>";
						echo "<td>$item_total $</td>";
						echo "</tr>";
					}
				}
				// Display total
				echo "<tr>";
				echo "<td colspan='3'>Total:</td>";
				echo "<td>$total $</td>";
				echo "</tr>";
				?>
			</table>
			<form action="checkout.php" method="post">
				<input type="submit"
					value="Checkout"
					class="button" />
			</form>
		</section>
	</main>

	<footer>
		<p>&COPY;2023 TW Shopping Web Application</p>
	</footer>
</body>

</html>
