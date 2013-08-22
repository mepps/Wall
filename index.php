<?php
	session_start();
	require("include/connection.php");
	require("include/header.php");
?>

	<?php
	if (isset($_SESSION['error_messages']))
	{
		 foreach($_SESSION['error_messages'] as $error_message)
		{
			echo "<p>" . $error_message . "<p>";
	 	}
		unset($_SESSION['error_messages']);
	 }
	if (isset($_SESSION['success_message']))
	{
		echo "<p>" . $_SESSION['success_message'] . "</p>";
		unset($_SESSION['success_message']);
	}

		 ?>
		<h2>Login</h2>
		<form action="process.php" method="post">
			<input type="hidden" name="action" value="login" />
			<div class="field_block">
				<label for="email">Email:</label>
				<input type="text" name="email" id="email" placeholder="Email" />
			</div>		
			<div class="field_block">
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" placeholder="Password" />
			</div>
			<input type="submit" name="login" value="Login" />
		<h2>Register</h2>
		</form>
		<form action="process.php" method="post">
			<input type="hidden" name="action" value="register" />
			<div class="field_block">
				<label for="email">Email:</label>
				<input type="text" name="email" id="email" placeholder="Email" />
			</div>
				<div class="field_block">
				<label for="first_name">First Name: </label>
				<input type="text" name="first_name" id="first_name" placeholder="First name" />
			</div>
			<div class="field_block">
				<label for="last_name">Last Name: </label>
				<input type="text" name="last_name" id="last_name" placeholder="Email"  />
			</div>
			<div class="field_block">
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" placeholder="Password" />
			</div>
			<div class="field_block">
				<label for="confirm_password">Confirm Password:</label>
				<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" />
			</div>
			<input type="submit" name="register" value="Register" />
		</form>
	</div>
</body>
</html>