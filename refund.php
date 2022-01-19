<html>
	<head>
		<meta charset="utf-8">
		<title>Refund Items</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="title">
				REFUND ITEMS
			</div>
			<hr><br>
			<form class="form" method="post" action="">
				<label>Enter Item ID: </label>
				<input type="text" name="item_id"><br><br>
				<label>Enter Quantity:</label>
				<input type="text" name="item_quant"><br><br>
				<button type="submit" name="sub" class="a">Submit to Database!</button>
			</form>
			<hr><br>

			<?php
				function refundItems($con, $query) {
					$query_id = oci_parse($con, $query);
					$r = oci_execute($query_id);

					if ($r) {
						oci_commit($con);
						echo "<label>Items refunded Successfully into the Database.</label>";
					} else {
						oci_rollback($con);
						$error = oci_error($query_id);
						echo "<label>Items not successfully refunded due to this error: ".$error['message']."</label>";
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
						if (!empty($_POST[item_quant])) {
							$query = "UPDATE items SET quantity = (quantity + ".$_POST['item_quant'].") WHERE id = ".$_POST['item_id'];

							refundItems($con, $query);
						} else {
							$query = "INSERT INTO items(id, name, quantity, price, description) VALUES(".$_POST['item_id'].", NULL, NULL, NULL, NULL)";

							refundItems($con, $query);
						}
					} else {
						echo "<label>Invalid Transaction</label>";
					}
				}

				oci_close($con);
			?>
	</body>
</html>