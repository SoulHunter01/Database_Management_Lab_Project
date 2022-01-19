<html>
	<head>
		<meta charset="utf-8">
		<title>Update Item</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="title">
				UPDATE CATEGORY
			</div>
			<hr><br>

			<form class="form" method="post" action="">
				<label>Enter Id of the Category you want to update: </label>
				<input type="text" name="cat_id"><br><br>
				<label>Enter name of the category:</label>
				<input type="text" name="cat_name"><br><br>
				<label>Enter ID of the Item you want to update: </label>
				<input type="text" name="item_id"><br><br>
				<button type="submit" class="a" name="sub">Submit to Database!</button><br>
			</form>
			<hr><br>

			<?php
				function updateCategory($con, $query) {
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
					if (!empty($_POST['cat_id'])) {
						if (!empty($_POST['cat_name'])) {
							if (!empty($_POST['item_id'])) {
								$query = "UPDATE category SET name = '".$_POST['cat_name']."' WHERE id = ".$_POST['cat_id']." AND item_id = ".$_POST['item_id'];

								updateCategory($con, $query);
							} else {
								echo "<label>Item Id Cannot be Null!</label>";
							}
						} if (!empty($_POST['item_id'])) {
							$query = "UPDATE category SET name = NULL WHERE id = ".$_POST['cat_id']." AND item_id = ".$_POST['item_id'];

							updateCategory($con, $query);
						} else {
							echo "<label>Item Id Cannot be Null!</label>";
						}
					} else {
						echo "<label>Category Id Cannot be Null!</label>";
					}
				}

				oci_close($con);
			?>
		</div>
	</body>
</html>