<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>The Wall</title>
	<link rel="stylesheet" type="text/css" href="css/wall_project.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

	<script type="text/javascript">
		function confirmDelete()
		{
			var con = confirm("Deleting is a serious decision to make. Are you sure you want to do this?");
			if (con = "Cancel")
			{
				return false;
			}
			else
			{
				return true;
			}

		}
	</script>

</head>
<body>
	<div id="container">
	<div id="header">
		<h1>The Wall</h1>
	</div>