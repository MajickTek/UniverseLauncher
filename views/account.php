<?php //require_once('libraries/forums.php'); ?>
		<div class="box pane">
			<h1 style="margin: 0;">Account</h1>
			<h3>If you came here to enter your play key, you don't need to enter your password.</h3>
			
<?php
	if (isset($_GET['name']) && $_GET['name'] != $_SESSION['user_name'] && (preg_match("/^[0-9A-Za-z]+$/", $_GET['name']) == 1)){
		$user = $_GET['name'];
		$sql = "SELECT * FROM `accounts` WHERE `NAME` = '" . $user . "'";
		$res = $mysql->query($sql);
		if ($res != NULL){
			if ($res->num_rows > 0){
				$obj = $res->fetch_object();
				$hash = "00000000000000000000000000000000";
				//if ($obj->email != "") $hash = md5(strtolower(trim( $obj->email)));
?>
			<br>
			<div style="float:left">
				<img class="avatar" src="<?php echo getAvatarLink($hash); ?>" /><br>
			</div>
			<div style="font-size: 150%; padding-left: 100px;">
				<span style="min-width: 5.5em; display: inline-block;">Name: </span>
				<?php echo $obj->name; ?>
			</div>
<?php
			}
		}
	}else{
		$updated = false;
		if (isset($_POST['update']) && $_POST['update'] == "Update Account"){
			$uFlag = false;
			$return = "";
			$sql = $sql = "UPDATE accounts SET ";
			
			//if (isset($_POST['email'])){
			//	if(preg_match("/^[A-Za-z0-9._]*@[A-Za-z0-9.]*$/", $_POST['email']) == 1 || $_POST['email'] == ""){
			//		if ($uFlag) $sql .= ", ";
			//		$user_email = $_POST['email'];
			//		if ($user_email != $_SESSION['user_email']){
			//			$sql .= "`email` = '" . $user_email . "'";
			//			$_SESSION['user_email'] = $user_email;
			//			$uFlag = true;
			//		}
			//	}else{
			//		$return .= "Incorrect E-Mail syntax<br>\n";
			//	}
			//}
			
			if(isset($_POST['password']) && !empty($_POST['password'])){
				if (preg_match("/^[A-Za-z0-9._]*$/", $_POST['password']) == 1){
					if (isset($_POST['password-repeat'])){
						if ($_POST['password-repeat'] == $_POST['password']){
							$user_newpassword = $_POST['password'];
							if ($uFlag) $sql .= ", ";
							$bcoptions = ['cost' => 12];
							$sql .= "`password` = '" . str_replace("$2y$", "$2a$", password_hash($user_newpassword, PASSWORD_BCRYPT, $bcoptions)) . "'";
							$uFlag = true;
						}else{
							$return .= "Repeated Password does not match<br/>";
						}
					}
				}else{
					$return .= "Invalid Password<br>\n";
				}
			}
			
			$sql .= " WHERE `id` = '" . $_SESSION['user_id'] . "';";
			
			if(isset($_POST['playkey'])) {
				$uniquesql = "UPDATE accounts SET play_key_id = (SELECT id FROM play_keys WHERE key_string = \"" . $_POST['playkey'] . "\" AND key_uses = 0 LIMIT 1) WHERE NAME = \"" . $_SESSION['user_name'] . "\";";
				$mysql->query($uniquesql);
				$uniquesql2 = "UPDATE accounts SET locked = 0 WHERE play_key_id > 0 AND NAME = \"" . $_SESSION['user_name'] . "\";";
				$mysql->query($uniquesql2);
			}
			if ($uFlag){
				$mysql->query($sql);
			}
			$updated = true;
		}
?>
			<form method="POST" style="font-size: 150%;">
				<span style="min-width: 5.5em; display: inline-block;">Name: </span>
				<?php echo $_SESSION['user_name'] . " | To request a name change, contact a Mythan."; ?><br>
				<div style="height: 0.2em;"></div>
				<!--<span style="min-width: 5em; display: inline-block;">E-Mail: </span>-->
				<!--<input name="email" style="width: 20em; max-width: 100%;" type="email" value="<?php echo $_SESSION['user_email']; ?>"/><br>-->
				<div style="height: 0.2em;"></div>
				<span style="min-width: 5em; display: inline-block;">Password: </span>
				<input name="password" style="width: 20em; max-width: 100%;" type="password" value=""/><br>
				<div style="height: 0.2em;"></div>
				<span style="min-width: 5em; display: inline-block;">Repeat Password:</span>
				<input name="password-repeat" style="width: 20em; max-width: 100%;" type="password" value=""/><br>
				<div style="height: 0.2em;"></div>
				<span style="min-width: 5em; display: inline-block;">Play Key:</span>
				<input name="playkey" style="width: 20em; max-width: 100%;" type="text" value=""/><br>
				<div style="height: 0.2em;"></div>
				<div style="text-align: right;">
					<?php if ($updated) echo "Account Updated!"; ?>&nbsp;&nbsp;<input style="float:none; max-width: 100%;" type="submit" name="update" value="Update Account"/>
				</div>
			</form>
		</div>
<?php } ?>