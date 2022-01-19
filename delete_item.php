<html>
	<head>
		<meta charset="utf-8">
		<title>Delete Item</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="title">
				DELETE ITEM
			</div>

			<hr><br>

			<form class="form" method="post" action="">
				<label>Enter Id of the item you want to Delete:</label>
				<input type="text" name="item_id"><br>
				<label>Enter name of the item: </label>&emsp;
				<input type="text" name="item_name"><br><br>
				<label>Enter Quantity of the Item: </label>
				<input type="text" name="item_quantity"><br><br>
				<label>Enter Price of the Item: </label>&emsp;&ensp;
				<input type="text" name="item_price"><br><br>
				<label>Enter description of the Item: </label><br>
				<textarea name="item_description" cols="55" rows="4"></textarea><br><br>
				<button type="Submit" name="sub" class="a">Submit to Database</button><br>
			</form>
			<hr><br>

			<?php
				function deleteItem($con, $query) {
					$query_id = oci_parse($con, $query);
					$r = oci_execute($query_id);

					if ($r) {
						oci_commit($con);
						echo "<label>Item Updated Successfully into the Database.</label>";
					} else {
						oci_rollback($con);
						$error = oci_error($query_id);
						echo "<label>Item Updation not successful due to this error: ".$error['message']."</label>";
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
					if (!empty($_POST['item_id'])) {
						if (!empty($_POST['item_name'])) {
							if (!empty($_POST['item_quantity'])) {
								if (!empty($_POST['item_price'])) {
									if (!empty($_POST['item_description'])) {
										$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND name = '".$_POST['item_name']."' AND quantity = ".$_POST['item_quantity']." AND price = ".$_POST['item_price']." AND description = '".$_POST['item_description']."'";

										updateItem($con, $query);
									} else {
										$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND name = '".$_POST['item_name']."' AND quantity = ".$_POST['item_quantity']." AND price = ".$_POST['item_price'];

										updateItem($con, $query);
									}
								} elseif (!empty($_POST['item_description'])) {
									$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND name = '".$_POST['item_name']."' AND quantity = ".$_POST['item_quantity']." AND description = '".$_POST['item_description']."'";

									updateItem($con, $query);
								} else {
									$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND name = '".$_POST['item_name']."' AND quantity = ".$_POST['item_quantity'];

									updateItem($con, $query);
								}
							} elseif (!empty($_POST['item_price'])) {
								if (!empty($_POST[item_description])) {
									$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND name = '".$_POST['item_name']."' AND price = ".$_POST['item_price']." AND description = '".$_POST['item_description']."'";

									updateItem($con, $query);
								} else {
									$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND name = '".$_POST['item_name']."' AND price = ".$_POST['item_price'];

									updateItem($con, $query);
								}
							} elseif (!empty($_POST['item_description'])) {
								$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND name = '".$_POST['item_name']."' AND description = '".$_POST['item_description']."'";

								updateItem($con, $query);
							} else {
								$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND name = '".$_POST['item_name']."'";

								updateItem($con, $query);
							}
						} elseif (!empty($_POST['item_quantity'])) {
							if (!empty($_POST['item_price'])) {
								if (!empty($_POST['item_description'])) {
									$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND quantity = ".$_POST['item_quantity']." AND price = ".$_POST['item_price']." AND description = '".$_POST['item_description']."'";

									updateItem($con, $query);
								} else {
									$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND quantity = ".$_POST['item_quantity']." AND price = ".$_POST['item_price'];

									updateItem($con, $query);
								}
							} elseif (!empty($_POST['item_description'])) {
								$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND quantity = ".$_POST['item_quantity']." AND description = '".$_POST['item_description']."'";

								updateItem($con, $query);
							} else {
								$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND quantity = ".$_POST['item_quantity'];

								updateItem($con, $query);
							}
						} elseif (!empty($_POST['item_price'])) {
							if (!empty($_POST['item_description'])) {
								$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND price = ".$_POST['item_price']." AND description = '".$_POST['item_description']."'";

								updateItem($con, $query);
							} else {
								$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND price = ".$_POST['item_price'];

								updateItem($con, $query);
							}
						} elseif (!empty($_POST['item_description'])) {
							$query = "DELETE FROM items WHERE id = ".$_POST['item_id']." AND description = '".$_POST['item_description']."'";

							updateItem($con, $query);
						} else {
							$query = "DELETE FROM items WHERE id = ".$_POST[item_id];
						}
					} else {
						echo "Item Id cannot be NULL!";
					}
				}

				oci_close($con);
			?>
		</div>
	</body>
</html>