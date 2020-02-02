<?php
script('pwk', 'settings/admin');
style('pwk', 'settings');
?>

<div id="pwkSettings" class="section">
	<h2>Pwk/Matomo Tracking</h2>
	<p class="settings-hint">If you have no Pwk/Matomo instance, go to <a href="https://matomo.org" target="_blank">matomo.org</a> for further instructions.</p>
	<p id="pwkAdblockerWarning" style="border-left:2px red solid;padding-left:1em">It seems that you use a content blocker plugin in your browser to stop trackers like Matomo. Unfortunately, your plugin also breaks this settings form, so you might want to disable the content blocker for your NextCloud.</p>

	<form>
		<table>
			<tr>
				<td><label for="pwkSiteId">Site ID </label></td>
				<td><input type="number" name="siteId" id="pwkSiteId" pattern="[0-9]+" value="<?php p($_['siteId']);?>" /></td>
			</tr>
			<tr>
				<td><label for="pwkUrl">Pwk/Matomo Url </label></td>
				<td><input type="text" name="url" id="pwkUrl" value="<?php p($_['url']);?>" /></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="checkbox" name="trackDir" id="pwkTrackDir" class="checkbox" <?php if ($_['trackDir']): ?> checked="checked"<?php endif; ?> />
					<label for="pwkTrackDir">Track file browsing</label>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="checkbox" name="trackUser" id="pwkTrackUser" class="checkbox" <?php if ($_['trackUser']): ?> checked="checked"<?php endif; ?> />
					<label for="pwkTrackUser">Track user id</label>
				</td>
			</tr>
		</table>
	</form>
</div>
