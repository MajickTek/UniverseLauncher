			<div class="widget box" style="background-color: #BCB;">
				<form method="POST">
					<div style="display: flex">
						<input type="submit" name="theme" value="assembly" class="assembly logo widget-logo pane" style="border-top-left-radius: 10px;"/>
						<input type="submit" name="theme" value="sentinel" class="sentinel logo widget-logo pane" style="border-top-right-radius: 10px;"/>
					</div>
					<div style="display: flex">
						<input type="submit" name="theme" value="ventureleague" class="ventureleague logo widget-logo pane" style="border-bottom-left-radius: 10px;"/>
						<input type="submit" name="theme" value="paradox" class="paradox logo widget-logo pane" style="border-bottom-right-radius: 10px;"/>
					</div>
					<input type="submit" name="theme" value="nexus" class="pane nexus logo widget-logo" style=""/>
				</form>
			</div>
			<div class="widget box">
				<h3 style="padding-bottom: 5px;">Account Activation</h3>
				<?php
					echo "<p>To be able to log in to the game, you must Use a Play Key (acquired from Discord).</p>\n";
					echo "<p>Go to the <a href=\"https://luniverse.website/UniverseLauncher/?page=account\">Account Page</a> to enter the key.</p>\n";
					echo "<p>This only applies if you've just registered an account and have no minifigs yet.</p><br>\n";
				?>
			</div>
			<div class="widget box">
				<h3 style="padding-bottom: 5px;">Server Status</h3>
				<?php
					$sql = "SELECT * FROM servers;";
					$res = $mysql->query($sql);
					if ($res != NULL){
						$obj = $res->fetch_object();
						echo "<b>Servers</b>: " . $obj->name . "@" . $obj->ip . ":" . $obj->port . "<br>\n";
					}
				?>
				<br>
				<?php
					$sql = "SELECT COUNT(name) as cnt FROM accounts;";
					$res = $mysql->query($sql);
					if ($res != NULL){
						$obj = $res->fetch_object();
						echo "<b>Accounts</b>: " . $obj->cnt . "<br>\n";
					}
				?>
				<br>
				<?php
				    //add stuff from activity_log here
					$sql = "SELECT COUNT(sessionid) as cnt FROM sessions;";
					$res = $mysql->query($sql);
					if ($res != NULL){
						$obj = $res->fetch_object();
						echo "<b>Player</b>: " . $obj->cnt . "<br>\n";
					}
					$sql = "SELECT COUNT(instanceid) as cnt FROM instances;";
					$res = $mysql->query($sql);
					if ($res != NULL){
						$obj = $res->fetch_object();
						echo "<b>Instances</b>: " . $obj->cnt . "<br>\n";
					}
					echo "<b>Legacy AccountManager</b><br>\n";
					echo "<a href=\"http://luniverse.website:5000/logout\">Old Dashboard</a><br>\n";
				?>
			</div>
			<div class="widget box">
				<h3 style="padding-bottom: 5px;">Server Staff</h3>
				<?php
					$sql = "SELECT NAME FROM accounts WHERE gm_level > 1;";
					$res = $mysql->query($sql);
					if ($res != NULL){
						if ($res->num_rows > 0) echo "<b>Admins</b>: <br>\n";
						echo "<ul style=\"margin: 0;\">\n";
						while ($obj = $res->fetch_object()){
							echo "<li>" . $obj->NAME . "</li>\n";
						}
						echo "</ul>\n";
					}
				?>
				<?php
					$sql = "SELECT NAME FROM accounts WHERE gm_level = 1;";
					$res = $mysql->query($sql);
					if ($res != NULL){
						if ($res->num_rows > 0) echo "<b>Moderators</b>: <br>\n";
						echo "<ul style=\"margin: 0;\">\n";
						while ($obj = $res->fetch_object()){
							echo "<li>" . $obj->NAME . "</li>\n";
						}
						echo "</ul>\n";
					}
				?>
			</div>
			<div class="widget box">
				<h3 style="padding-bottom: 5px;">Links</h3>
				<b>DLU:</b>
				<ul style="margin: 0;">
					<li><a href="https://darkflameuniverse.org">DLU Website</a></li>
					<li><a href="https://github.com/DarkflameUniverse/DarkflameServer/">DLU Github</a></li>
					<!--<li><a href="http://luni.wikia.com">LUNI Wikia</a></li>
					<li><a href="http://luni-wiki.wikispaces.com">LUNI Wikispaces</a></li>-->
				</ul>
				<!--<b>Docs:</b>
				<ul style="margin: 0;">
					<li><a href="https://docs.google.com/document/d/1v9GB1gNwO0C81Rhd4imbaLN7z-R0zpK5sYJMbxPP3Kc">Packet Docs</a></li>
				</ul>-->
			</div>
			<div class="widget box">
				<h3 style="padding-bottom: 5px;">DLU Credits</h3>
				<b>Original Project:</b><br>
				Created by the DLU team<br>
				<a href="https://twitter.com/darkflameuniv">Darkflame Twitter</a><br>
				<br>
				<h3 style="padding-bottom: 5px;">DLU License</h3>
				DLU is licensed under the <a href="https://www.gnu.org/licenses/agpl-3.0.en.html">GNU Affero General Public License v3.0</a>
			</div>
			
			<!--<div class="widget box">
				Widget 1
			</div>
			<div class="widget box">
				Widget 1
			</div>-->
			