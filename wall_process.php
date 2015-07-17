<?php

//edit to wall
	session_start();
	require_once("include/connection.php");
	$query = "SELECT * FROM users WHERE email = '{$_SESSION['user']['email']}';";
	$user_info = fetch_record($query);
	$_SESSION['user_id'] = $user_info["id"];

if ($_POST['action'] == "post")
	{
	postMessage($_POST['message_post']);
	unset($_POST['action']);
	}
if ($_POST['action'] == 'log_off')
{
	session_destroy();
	header("location: index.php");
}
if ($_POST['action'] == 'comment')
{
	postComment($_POST['comment']);
}
if ($_POST['action'] == 'delete_message')
{
	deleteMessage($_POST['delete_id']);
}
if ($_POST['action'] == 'delete_comment')
{
	deleteComment($_POST['delete_id']);
}
function postMessage($user_message)
{
	if(empty($user_message))
	{
		$_SESSION['post_error'] = "Did you mean to enter a message?";
		header('location: wall.php');
	}
	else 
	{
		$query = "INSERT INTO messages (message, user_id, created_at) VALUES ('". mysql_real_escape_string($user_message) . "'," .  $_SESSION['user_id'] . ", NOW());";
		mysql_query($query);
		header("location: wall.php");
	}
}
function postComment($user_comment)
{
	if (empty($user_comment))
	{
		header('location: wall.php');
	}
	else
	{
		$query = "INSERT INTO comments (comment, user_id, message_id, created_at) VALUES ('" . mysql_real_escape_string($user_comment) . "'," .  $_SESSION['user_id'] 

			. ", " . $_POST['comment_id'] . ", NOW());";
		mysql_query($query);
		header("location: wall.php");
	}
}
function deleteMessage($message_id)
{
	$query = "DELETE FROM comments where message_id = " . (int)$message_id . ";";
	mysql_query($query);
	$query = "DELETE FROM messages WHERE id=" . (int)$message_id . ";";
	mysql_query($query);
	header('location: wall.php');
}
function deleteComment($comment_id)
{
	$query = "DELETE FROM comments where id = " . (int)$comment_id . ";";
	mysql_query($query);
	header('location: wall.php');
}
?>