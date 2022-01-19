<html>
	<head>
		<meta charset="utf-8">
		<title>Delete Category</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="title">
				DELETE CATEGORY
			</div>
			<hr><br>

			<form class="form" method="post" action="">
				<label>Enter Id of the Category you want to delete: </label>
				<input type="text" name="cat_id"><br><br>
				<label>Enter name of the category: </label>
				<input type="text" name="cat_name"><br><br>
				<label>Enter Id of the Item you want to delete: </label>
				<input type="text" name="item_id"><br><br>
				<button class="a" type="submit" name="sub">Submit to Database!</button><br>
			</form>
			<hr><br>

			<?php
				function deleteCategory($con, $query) {
					$query_id = oci_parse($con, $query);
					$r = oci_execute($query_id);

					if ($r) {
						oci_commit($con);
						echo "<label>Category deleted Successfully into the Database.</label>";
					} else {
						oci_rollback($con);
						$error = oci_error($query_id);
						echo "<label>Category Deletion not successful due to this error: ".$error['message']."</label>";
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

				if (!empty($_POST['cat_id'])) {
					$query = "DELETE DROM category WHERE id = ".$_POST['cat_id'];

					deleteCategory($con, $query);
				} else {
					echo "<label>Category ID Cannot be Null!</label>";
				}
			?>
		</div>
	</body>
</html>