<html>
<head>
	<script type="text/javascript" src="js/jquery.js" /></script>
</head>
<body>

<h1>Create Tournament</h1>
<form action="/index.php/tournament/create" method="post">
Name : <input type="text" id="name" name="name" value="" /> <br/>
Game : <?php echo $select_game; ?><br/>
Begin Date : <input name="begin_date" id="begin_id" value="" /><br/>
End Date : <input name="end_date" id="end_date" value="" /><br/>
<input type="submit" value="Save"  />
</form>
<a href="/index.php/tournament/">Regresar</a>

</body>
</html>