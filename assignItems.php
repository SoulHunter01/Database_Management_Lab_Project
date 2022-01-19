<html>
	<head>
		<meta charset="utf-8">
		<title>Assign Items</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="title">
				ASSIGN ITEMS
			</div>
			<hr><br>

			<form class="form" method="post" action="">
				<label>Enter order Id:</label>
				<input type="text" name="order_id"><br><br>
				<label>Enter Shipment Id:</label>
				<input type="text" name="ship_id"><br><br>
				<label>Enter Supplier Id: </label>
				<input type="text" name="supp_id"><br><br>
				<button type="submit" class="a" name="sub">Sbmit to Database!</button>
			</form><br>
			<hr><br>

			<?php
				function assignItems($con, $query) {
					$query_id = oci_parse($con, $query);
					$r = oci_execute($query_id);

					if ($r) {
						oci_commit($con);
						echo "<label>Items Assigned Successfully into the Database.</label>";
					} else {
						oci_rollback($con);
						$error = oci_error($query_id);
						echo "<label>AItems Assignment not successful due to this error: ".$error['message']."</label>";
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
					if (!empty($_POST['order_id'])) {
						if (!empty($_POST['ship_id'])) {
							if (!empty($_POST['supp_id'])) {
								$query = "INSERT INTO orders(order_id, ship_id, supp_id) VALUES(".$_POST['order_id'].", ".$_POST['ship_id'].", ".$_POST['supp_id'].")";

								assignItems($con, $query);
							} else {
								echo "<label>Supplier Id Cannot be Null.</label>";
							}
						} else {
							echo "<label>Shipment Id Cannot be Null.</label>";
						}
					} else {
						echo "<label>Order Id Cannot be Null.</label>";
					}
				}

				oci_close($con);
			?>
		</div>
	</body>
</html>