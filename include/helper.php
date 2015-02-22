<?php

function show_created_date($post){
	echo ' on '.date('M d, Y', strtotime($post['created_at']));	
}

function get_posts(){
	$query = "SELECT t1.id, t1.message, t1.created_at, t1.updated_at, t1.user_id, t2.first_name FROM messages as t1 LEFT JOIN users as t2 on t1.user_id = t2.id WHERE 1 ORDER BY t1.created_at DESC;";
	return fetch_all($query);
}

function get_comments($post){
	$query = "SELECT t1.id, t1.comment, t1.created_at, t1.updated_at, t1.user_id, t2.first_name FROM comments as t1 LEFT JOIN users as t2 on t1.user_id = t2.id WHERE message_id=" . $post['id'] . " ORDER BY t1.created_at DESC;";
	return fetch_all($query);

}