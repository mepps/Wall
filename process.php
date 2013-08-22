<?php
	session_start();
	require_once("include/connection.php");


if(isset($_POST['action']) and $_POST['action'] == "login")
{
	loginAction();
}
else if(isset($_POST['action']) and $_POST['action'] == "register")
{
	registerAction();
}
else
{
	session_destroy();
	header("location: index.php");
}

	function loginAction()
	{
		$errors = NULL;

		if(!(isset($_POST['email']) and filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
		{
			$errors[] = "Email is not valid.";
		}
		if(!(isset($_POST['password']) and strlen($_POST['password']) > 6))
		{
			$errors[] = "Please double check your password (length must be greater than 6).";
		}

		if($errors != NULL)
		{
			$_SESSION['error_messages'] = $errors;
			header('location: index.php');
		}
		else
		{
			$query = "SELECT * FROM users WHERE email = '{$_POST['email']}' AND password = '" . md5($_POST['password']) . "'";
			$users = fetch_all($query);

			if(count($users)>0)
			{
				$_SESSION['logged_in'] = true;
				$_SESSION['user']['first_name'] = $users[0]['first_name'];
				$_SESSION['user']['last_name'] = $users[0]['last_name'];
				$_SESSION['user']['email'] = $users[0]['email'];
				header('location: wall.php');
			}
			else
			{
				$errors[] = "Invalid login information.";
				$_SESSION['error_messages'] = $errors;
				header('location: index.php');
			}
		}
	}

	function registerAction()
	{
		$errors = NULL;

		//email validation
		if(empty($_POST['email']))
		{
			$errors[] = "Email address cannot be blank.";
		}
		else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$errors[] = "Email address must be valid.";
		}

		// first namme
		if(empty($_POST['first_name']))
		{
			$errors[] = "First name cannot be blank.";
		}
		else if (is_numeric($_POST['first_name']))
		{
			$errors[] = "First name cannot contain numbers.";
		}
		//last name validation
		if(empty($_POST['last_name']))
		{
			$errors[] = "Last name cannot be blank.";
		}
		else if (is_numeric($_POST['last_name']))
		{
			$errors[] = "Last name cannot contain numbers.";
		}
		//password validation
		if (empty($_POST['password'])) 
		{
			$errors[] = "Password cannot be blank.";		

		}
		else if (strlen($_POST['password']) < 6)
		{
			$errors[] = "Password should be at least 6 characters.";
		}
		//confirm password validation
		if(empty($_POST['confirm_password']))
		{
			$errors[] = "Please confirm your password.";
		}
		else if ($_POST['password'] != $_POST['confirm_password'])
		{
			$errors[] = "Passwords do not match.";
		}
		if(!($errors == NULL))
		{
			$_SESSION['error_messages'] = $errors;
			header("location: index.php");
		}
		else
		{
			//see if the email address is already taken
			$query = "SELECT * FROM users WHERE email = '".mysql_real_escape_string($_POST['email'])."'";
			$users = fetch_all($query);

			//see if someone already registered with that email address
			if(count($users)>0)
			{
				$errors[] = "Someone has already registered with that email address. Do you want to log in?";
				$_SESSION['error_messages'] = $errors;
				header("location: index.php");
			}
			else
			{
				$query = "INSERT INTO users (first_name, last_name, email, password, created_at) VALUES ('".mysql_real_escape_string($_POST['first_name'])."', '".mysql_real_escape_string($_POST['last_name'])."', '". mysql_real_escape_string($_POST['email']). "', '" . md5($_POST['password']) . "', NOW())";
				mysql_query($query);

				$_SESSION['success_message'] = "User was succcessfully created!";
				header("location: index.php");
			}
		}
	}	

?>