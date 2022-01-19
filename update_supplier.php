<html>
	<head>
		<meta charset="utf-8">
		<title>Update Supplier</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="title">
				UPDATE SUPPLIER
			</div>
			<hr><br>

			<form class="form" method="post" action="">
				<label>Enter Id of the Supplier you want to change: </label>
				<input type="text" name="supp_id"><br><br>
				<label>Enter supplier name: </label>
				<input type="text" name="supp_name"><br><br>
				<label>Enter shipment Id: </label>
				<input type="text" name="supp_ship"><br><br>
				<button type="submit" class="a" name="sub">Submit to Database!</button><br>
			</form>
			<hr><br>

			<?php
				function updateSupplier($con, $query) {
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
					if (!empty($_POST['supp_id'])) {
						if (!empty($_POST['supp_name'])) {
							if (!empty($_POST['supp_ship'])) {
								$query = "UPDATE supplier SET name = '".$_POST['supp_name']."' WHERE id = ".$_POST['supp_id']." AND shipment_id = ".$_POST['supp_ship'];

								updateSupplier($con, $query);
							} else{
								echo "<label>Shipment Id Cannot be Null!</label>";
							}
						} elseif (!empty($_POST['supp_ship'])) {
							$query = "UPDATE supplier SET name = NULL WHERE id = ".$_POST['supp_id']." AND shipment_id = ".$_POST['supp_ship'];

							updateSupplier($con, $query);
						} else {
							echo "<label>Shipment Id Cannot Be Null!</label>";
						}
					} else {
						echo "<label>Supplier Id Cannot be Null!</label>";
					}
				}

				oci_close($con);
			?>
		</div>
	</body>
</html>