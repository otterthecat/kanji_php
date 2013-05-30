<fieldset id="<?php echo $fieldsetId ?>">
	<form action="<?php echo $postTo; ?>" method="post">
		<label for="<?php echo $username; ?>">User</label>
		<input name="<?php echo $username ?>" type="text"/>

		<label for="<?php echo $password; ?>">Password</label>
		<input name="<?php echo $password; ?>" type="text"/>

		<button type="submit">Login</button>
	</form>
</fieldset>