<div class="box pane">
	<?php if (isset($_SESSION['gm_level']) && $_SESSION['gm_level'] > 1){ ?>
	<h1 style="margin: 0;">Pets</h1>
	<br/>
	<?php
		if (isset($_GET['approve_id']) && preg_match("/^[0-9]*$/", $_GET['approve_id']) == 1){
			$id = $_GET['approve_id'];
			$name_sql = "SELECT * FROM `pet_names` WHERE `id` = '" . $id . "';";
			$name_res = $mysql->query($name_sql);
			if ($name_res == NULL) echo $mysql->error;
			if ($name_res->num_rows > 0){
				$name_obj = $name_res->fetch_object();
				$update = "UPDATE `pet_names` SET `approved` = 2". " WHERE `id` = '" . $id . "';";
				$update_res = $mysql->query($update);
				if ($update_res == NULL) echo $mysql->error; else echo "Name Accepted<br>\n";
			}
		}
		
		if (isset($_GET['decline_id']) && preg_match("/^[0-9]*$/", $_GET['decline_id']) == 1){
			$id = $_GET['decline_id'];
			$update = "UPDATE `pet_names` SET `approved` = 0 WHERE `id` = '" . $id . "';";
			$update_res = $mysql->query($update);
			if ($update_res == NULL) echo $mysql->error; else echo "Name Declined<br>\n";
		}
	?>
	
	<form method="POST" style="font-size: 150%;" action="?page=<?php echo $page; ?>&filter=1">
		<span style="min-width: 5em; display: inline-block;">Filter: Unapproved Names</span>
		<input style="float:none; max-width: 100%;" type="submit" name="update" value="Apply"/>
		<br />
	</form>
	<br />
	
	<table>
		<tr><th>ID</th><th>Name</th><th>Approved</th></tr>
	<?php 
		$sql = "SELECT * from pet_names";
		$test = isset($_GET['filter']) ? $_GET['filter'] : '';
		if($test != '') {
			$sql = $sql . " WHERE approved < 2";
		}
		$sql = $sql . ";";
		$res = $mysql->query($sql);
		if ($res == NULL){
			echo $mysql->error;
		}
		$c = $res->num_rows;
		for ($ca = 0; $ca < $c; $ca++){
			$obj = $res->fetch_object(); ?>
		<tr>
			<td><?php echo $obj->id; ?></td>
			<td><?php echo $obj->pet_name; ?></td>
			<td><?php echo $obj->approved; ?></td>
			<?php if ($obj->approved < 2){ ?>
			<td><a href="?page=<?php echo $page; ?>&approve_id=<?php echo $obj->id; if($test != '') {echo "&filter=1";}?>">Approve</a></td>
			<td><a href="?page=<?php echo $page; ?>&decline_id=<?php echo $obj->id; ?>">Decline</a></td>
			<?php } ?>
		</tr><?php
		}
	?>
	</table>
	<?php }else{ ?>
	<div class="alert">
		You are not allowed to access this page
	</div>
	<?php } ?>
</div>