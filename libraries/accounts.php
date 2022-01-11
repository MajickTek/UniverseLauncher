<?php
	function getRankName($rankid){
		switch($rankid){
			case 0:
				return "Civilian";
			case 1:
				return "Forum Moderator";
			case 2:
				return "Junior Moderator";
			case 3:
				return "Moderator";
			case 4:
				return "Senior Moderator";
			case 5:
				return "Lead Moderator";
			case 6:
				return "Junior Developer";
			case 7:
				return "Inactive Developer";
			case 8:
				return "Developer";
			case 9:
				return "Operator";
			default:
				return "HACKER?";
		}
	}
	
	function updateUser($mysql){
		$return = "";
		if (isset($_POST['submit'])){
			if (isset($_POST['id']) && preg_match("/^[0-9]*$/", $_POST['id'])){
				$sql = "UPDATE accounts SET ";
				$uFlag = false;
				$user_id = $_POST['id'];
				$user_name = "";
				$user_email = "";
				$user_newpassword = "";
				$user_rank = 0;
				$user_locked = false;
				$user_banned = false;
				$flag = false;
				//$return .= "Id: " . $user_id . "<br>\n";
				if (isset($_POST['name']) && !empty($_POST['name'])){
					if(preg_match("/^[A-Za-z0-9._]*$/", $_POST['name']) == 1){
						//$return .= "Name: " . $_POST['name'] . "<br>\n";
						$user_name = $_POST['name'];
						if ($uFlag) $sql .= ", ";
						$sql .= "`NAME` = '" . $user_name . "'";
						$uFlag = true;
						$flag = true;
					}else{
						$return .= "Incorrect name syntax<br>\n";
					}
				}else{
					$return .= "No name specified<br>\n";
				}
				//if (isset($_POST['email'])){
				//	if(preg_match("/^[A-Za-z0-9._]*@[A-Za-z0-9.]*$/", $_POST['email']) == 1 || $_POST['email'] == ""){
				//		//$return .= "E-Mail: " . $_POST['email'] . "<br>\n";
				//		if ($uFlag) $sql .= ", ";
				//		$user_email = $_POST['email'];
				//		$sql .= "`email` = '" . $user_email . "'";
				//		$uFlag = true;
				//	}else{
				//		$return .= "Incorrect E-Mail syntax<br>\n";
				//		$flag = false;
				//	}
				//}else{
				//	//echo "No E-mail specified<br>\n";
				//}
				
				if(isset($_POST['password']) && !empty($_POST['password'])){
					if (preg_match("/^[A-Za-z0-9._]*$/", $_POST['password']) == 1){
						if (isset($_POST['password-repeat'])){
							if ($_POST['password-repeat'] == $_POST['password']){
								$user_newpassword = $_POST['password'];
								if ($uFlag) $sql .= ", ";
								$sql .= "`PASSWORD` = '" . str_replace("$2y$", "$2a$", password_hash($user_newpassword, PASSWORD_BCRYPT, $bcoptions)) . "'";
								//$return .= "New Password: " . $user_newpassword . "<br>";
								$uFlag = true;
							}else{
								$return .= "Repeated Password does not match<br/>";
							}
						}
					}else{
						$return .= "Invalid Password<br>\n";
					}
				}else{
					//No password specified
				}
			
				if (isset($_POST['rank']) && preg_match("/^[0-9]*$/", $_POST['rank']) == 1){
					if ($uFlag) $sql .= ", ";
					$user_rank = (int) $_POST['rank'];
					$uFlag = true;
					$sql .= "`gm_level` = '" . $user_rank . "'";
					//$return .= "Rank: " . getRankName($user_rank) . "<br>";
				}
				
				if (isset($_POST['locked']) && $_POST['locked'] == 'true'){
					$user_locked = true;
					//$return .= "User Locked<br>";
				}
				
				if ($uFlag) $sql .= ", ";
				$uFlag = true;
				$sql .= "`locked` = ";
				if ($user_locked) $sql .= "TRUE"; else $sql .= "FALSE";
								
				
				if (isset($_POST['banned']) && $_POST['banned'] == 'true'){
					$user_banned = true;
					//$return .= "User Banned<br>";
				}
				
				if ($uFlag) $sql .= ", ";
				$uFlag = true;
				$sql .= "`banned` = ";
				if ($user_banned) $sql .= "TRUE"; else $sql .= "FALSE";
				
				$sql .= " WHERE `id` = '" . $user_id . "';";
				$mysql->query($sql);
				//$return .= $sql;
			}
		}
		return $return;
	}
?>