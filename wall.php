<?php

//this is a nice wall yes it is!
	session_start();
	if (!isset($_SESSION['user']['email']))
		header('location:index.php');
	require_once("include/connection.php");
	require_once("include/header.php");
?>

<form action="wall_process.php" method="post">
	<input type="hidden" name="action" value ="post" />
	<input type="text" name="message_post" id="message_post" placeholder="What do you want to say?" />
	<input type="submit" name="post" value="Post" />
</form>
<h2><?php if (isset($_SESSION['post_error'])) 
{
	echo $_SESSION['post_error'];
	unset($_SESSION['post_error']);

}?></h2>
<div id = "wall_posts">
<?php
$query = "SELECT t1.id, t1.message, t1.created_at, t1.updated_at, t1.user_id, t2.first_name FROM messages as t1 LEFT JOIN users as t2 on t1.user_id = t2.id WHERE 1 ORDER BY t1.created_at DESC;";
$posts = fetch_all($query);

foreach($posts as $post)
{	
?>	<div class='wall_post'>
		<h2 class='post_info'>written by <?=$post["first_name"]?> at <?=$post['created_at']?> </h2>
		<p class='post_message'> <?=$post['message']?>
		<form action='wall_process.php'  method='post' onsubmit='confirmDelete()'>
			<input type='hidden' name='action' value='delete_message' />
			<input type='hidden' name='delete_id' value=<?=$post['id']?> />
			<input type='submit' class='delete' name='submit' value='Delete' />
		</form>	</p>
		<form action='wall_process.php' method='post' />
			<input type='hidden' name='action' 	value='comment'  />
			<input type='hidden' name='comment_id' 	value= <?=$post['id']?> />
			<input type='text' name='comment' placeholder='Reply to this post.' />
			<input type='submit' name='submit' value='Comment' />
		</form>	
		<div class='comments'>
			<?php 
			$query = "SELECT t1.id, t1.comment, t1.created_at, t1.updated_at, t1.user_id, t2.first_name FROM comments as t1 LEFT JOIN users as t2 on t1.user_id = t2.id WHERE message_id=" . $post['id'] . " ORDER BY t1.created_at DESC;";
			$comments = fetch_all($query);
			foreach ($comments as $comment)
			{?>
			<h3 class='post_info'>reply from <?=$comment['first_name']?> at <?=$comment['created_at']?> </h3>
			<p class='comment'><?=$comment['comment']?>
			<form  action='wall_process.php' method='post' onsubmit='confirmDelete()' >
				<input type='hidden' name='action' value='delete_comment' />
				<input type='hidden' name='delete_id' value=<?=$comment['id']?> />
				<input type='submit' class='delete' name='submit' value='Delete' />
			</form></p>

	<?php } ?>
</div>
	</div>
<?php
}
?>

<br />
<form form action="wall_process.php" method="post" />
<input type="hidden" name="action" value="log_off" />
<input type="submit" name="log_off" value="Log Off" />
</form>
</div><!--closes wall posts-->
</div><!--closes container-->
</body>
</html>
