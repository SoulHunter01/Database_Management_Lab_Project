<html>
	<head>
		<meta charset="utf-8">
		<title>Insert Category</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="title">
				INSERT CATEGORY
			</div>
			<hr><br>
			<form class="form" method="post" action="">
				<label>Enter Category Id:</label>&emsp;&emsp;&emsp;
				<input type="text" name="category_id"><br><br>
				<label>Enter name of Category:</label>
				<input type="text" name="category_name"><br><br>
				<label>Enter Item Id:</label>&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;
				<input type="text" name="item_id"><br><br>
				<button class="a" type="submit" name="sub">Submit to Database!</button>
			</form><br>
			<hr><br>

			<?php
				function insertCategory($con, $query) {
					$query_id = oci_parse($con, $query);
					$r = oci_execute($query_id);

					if ($r) {
						oci_commit($con);
						echo "<label>Category Inserted Successfully into the Database.</label>";
					} else {
						oci_rollback($con);
						$error = oci_error($query_id);
						echo "<label>Category Insertion not successful due to this error: ".$error['message']."</label>";
					}
				}

				$db_sid = "(DESCRIPTION =
					(ADDRESS = (PROTOCOL = TCP)(HOST =
						DESKTOP-O4G52F0)(PORT = 1521))
					(CONNECT_DATA =
						(SERVER = DEDICATED)
						(SERVICE_NAME = zaid)
					)
				)";

				$db_user = "scott";
				$db_pass = "1234";

				$con = oci_connect($db_user, $db_pass, $db_sid);

				if ($con) {
					echo "<label>Oracle Connection Successful</label><br>";
				} else {
					die('Could Not Connect to Oracle Database.');
				}

				if (isset($_POST['sub'])) {
					if (!empty($_POST['category_id'])) {
						if (!empty($_POST['category_name'])) {
							if (!empty($_POST['item_id'])) {
								$query = "INSERT INTO category(id, name, item_id) VALUES(".$_POST['category_id'].", '".$_POST['category_name']."', ".$_POST['item_id'].")";

								insertCategory($con, $query);
							} else {
								echo "<label>Item Id Cannot be NUll!</label>";
							}
						} elseif (!empty($_POST['item_id'])) {
							$query = "INSERT INTO category(id, name, item_id) VALUES(".$_POST['category_id'].", NULL, ".$_POST['item_id'].")";

							insertCategory($con, $query);
						} else {
							echo "<label>Item Id Cannot be NULL!</label>";
						}
					} else {
						echo "<label>Category Id cannot be NULL!</label>";
					}
				}

				oci_close($con);
			?>
		</div>
	</body>
</html>