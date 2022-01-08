<div class="box pane">
	<h1 style = "margin: 0;">Bug Report / User Report</h1>
	<h3>Jokes will be discarded.</h3>
	
	<?php
		$updated = false;
		if (isset($_POST['update']) && $_POST['update'] == "Send Report"){
			$uFlag = false;
			$sql = "INSERT INTO bug_reports (body, client_version, other_player_id, selection) VALUES (";
			
			if(isset($_POST['body'])) {
				$sql .= "\"" . $_POST['body'] . "\", \"website\", ";
				$uFlag = true;
			}
			
			if(isset($_POST['other_player_name'])) {
				$sql .= "(SELECT account_id FROM charinfo WHERE name = \"" . $_POST['other_player_name'] . "\"), \"php\");";
			} else {
				$sql .= "0, \"php\");";
			}
			
			if ($uFlag){
				$mysql->query($sql);
			}
			$updated = true;
		}
	?>
	<br />
	<form method="POST" style="font-size: 150%">
		<span style="min-width: 5.5em; display: inline-block;">Short Description: </span>
		<input name="body" style="width: 20em; max-width: 100%;" type="text" value=""/><br>
		<div style="height: 0.2em;"></div>
		<span style="min-width: 5.5em; display: inline-block;">Client Version: 1.10.64</span>
		<div style="height: 0.2em;"></div>
		<span style="min-width: 5.5em; display: inline-block;">Troublesome Minifig (optional): </span>
		<input name="other_player_name" style="width: 20em; max-width: 100%;" type="text" value=""/><br>
		<div style="height: 0.2em;"></div>
		<div style="text-align: right;">
			<?php if ($updated) echo "Report Submitted!"; ?>&nbsp;&nbsp;<input style="float:none; max-width: 100%;" type="submit" name="update" value="Send Report"/>
		</div>
	</form>
</div>