<html>
	<head>
		<meta charset="utf-8">
		<title>Insert Shipment</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="title">
				INSERT SHIPMENT
			</div>
			<hr><br>

			<form class="form" method="post" action="">
				<label>Enter shipment id: </label>
				<input type="text" name="ship_id"><br><br>
				<label>Enter Date of shipment: </label>
				<input type="text" name="ship_date" placeholder="dd-mm-yyyy"><br><br>
				<label>Enter Time of Shipment: </label>
				<input type="text" name="ship_time" placeholder="hh:mm:ss"><br><br>
				<label>Enter supplier id: </label>
				<input type="text" name="supp_id"><br><br>
				<button class="a" name="sub" type="submit">Submit to Database!</button>
			</form><br>
			<hr><br>

			<?php
				function insertShipment($con, $query) {
					$query_id = oci_parse($con, $query);
					$r = oci_execute($query_id);

					if ($r) {
						oci_commit($con);
						echo "<label>Shipment Inserted Successfully into the Database.</label>";
					} else {
						oci_rollback($con);
						$error = oci_error($query_id);
						echo "<label>Shipmnent Insertion not successful due to this error: ".$error['message']."</label>";
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
						if (!empty($_POST['ship_date'])) {
							if (!empty($_POST['ship_time'])) {
								if (!empty($_POST['supp_id'])) {
									$query = "INSERT INTO shipment(id, ship_date, ship_time, supp_id) VALUES(".$_POST['ship_id'].", TO_DATE('".$_POST['ship_date']."', 'dd-mm-yyyy'), ".$_POST['ship_time'].", ".$_POST['supp_id'].")";

									insertShipment($con, $query);
								} else {
									echo "<label>Supplier Id Cannot be Null.</label>";
								}
							} else {
								$query = "INSERT INTO shipment(id, ship_date, ship_time, supp_id) VALUES(".$_POST['ship_id'].", TO_DATE('".$_POST['ship_date']."', 'dd-mm-yyyy'), NULL, ".$_POST['supp_id'].")";

								insertShipment($con, $query);
							}
						} elseif (!empty($_POST['ship_time'])) {
							$query = "INSERT INTO shipment(id, ship_date, ship_time, supp_id) VALUES(".$_POST['ship_id'].", NULL, ".$_POST['ship_time'].", ".$_POST['supp_id'].")";

							insertShipment($con, $query);
						} else {
							$query = "INSERT INTO shipment(id, ship_date, ship_time, supp_id) VALUES(".$_POST['ship_id'].", NULL, NULL, ".$_POST['supp_id'].")";

							insertShipment($con, $query);
						}
					} else {
						echo "<label>Shipment Id Cannot be Null!</label>";
					}
				}

				oci_close($con);
			?>
		</div>
	</body>
</html>