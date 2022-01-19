<html>
	<head>
		<meta charset="utf-8">
		<title>Unassign Items</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="title">
				UNASSIGN ITEMS
			</div>
			<hr><br>
			<form class="form" method="post" action="">
				<label>Enter Order Id:</label>
				<input type="text" name="order_id"><br><br>
				<button class="a" type="submit" name="sub">Submit to Database!</button><br>
			</form>
			<hr><br>

			<?php
				function unassinItems($con, $query) {
					$query_id = oci_parse($con, $query);
					$r = oci_execute($query_id);

					if ($r) {
						oci_commit($con);
						echo "<label>Items Unassigned Successfully into the Database.</label>";
					} else {
						oci_rollback($con);
						$error = oci_error($query_id);
						echo "<label>Items not unassigned successfully due to this error: ".$error['message']."</label>";
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
						$query = "DELETE from orders WHERE id = ".$_POST['order_id'];

						unassinItems($con, $query);
					} else {
						echo "<label>Order Id Cannot be Null.</label>";
					}
				}

				oci_close($con);
			?>
		</div>
	</body>
</html>