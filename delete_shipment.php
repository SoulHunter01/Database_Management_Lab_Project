<html>
	<head>
		<meta charset="utf-8">
		<title>Delete Shipment</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="title">
				DELETE SHIPMENT
			</div>
			<hr><br>

			<form class="form" method="post" action="">
				<label>Enter Id of shipment you want to delete: </label>
				<input type="text" name="ship_id"><br><br>
				<button class="a" type="submit" name="sub">Submit to Database!</button><br>
			</form>
			<hr><br>

			<?php
				function deleteShipment($con, $query) {
					$query_id = oci_parse($con, $query);
					$r = oci_execute($query_id);

					if ($r) {
						oci_commit($con);
						echo "<label>Shipment deletion Successfully into the Database.</label>";
					} else {
						oci_rollback($con);
						$error = oci_error($query_id);
						echo "<label>Shipment Deletion not successful due to this error: ".$error['message']."</label>";
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
					if (!empty($_POST['ship_id'])) {
						$query = "DELETE FROM shipment WHERE id = ".$_POST['ship_id'];

						deleteShipment($con, $query);
					} else {
						echo "<label>Shipment Id Cannot be Null.</label>";
					}
				}

				oci_close($con);
			?>
		</div>
	</body>
</html>