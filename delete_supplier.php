<html>
	<head>
		<meta charset="utf-8">
		<title>Delete Supplier</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="title">
				DELETE SUPPLIER
			</div>
			<hr><br>

			<form class="form" method="post" action="">
				<label>Enter Id of supplier you want to delete: </label>
				<input type="text" name="supp_id"><br><br>
				<button class="a" type="submit" name="sub">Submit to Database!</button><br>
			</form>
			<hr><br>

			<?php
				function deleteSupplier($con, $query) {
					$query_id = oci_parse($con, $query);
					$r = oci_execute($query_id);

					if ($r) {
						oci_commit($con);
						echo "<label>Supplier deletion Successfully into the Database.</label>";
					} else {
						oci_rollback($con);
						$error = oci_error($query_id);
						echo "<label>Supplier Deletion not successful due to this error: ".$error['message']."</label>";
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
						$query = "DELETE FROM supplier WHERE id = ".$_POST['supp_id'];

						deleteSupplier($con, $query);
					} else {
						echo "<label>Supplier Id Cannot be Null!</label>";
					}
				}

				oci_close($con);
			?>
		</div>
	</body>
</html>