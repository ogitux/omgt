<h1>Create Scenario</h1>
<form action="/admin/scenario/create" method="post">
	<div class="span-3 first">Name</div><div class="span-13 last"><input type="text" id="name" name="name" value="" /></div>
	<div class="span-3 first">Game</div><div class="span-13 last"><?php echo $select_game; ?></div>
	<div class="span-3 first">&nbsp;</div><div class="span-13 last"><input type="submit" value="Save" /></div>
</form>
<a href="/admin/game/">Regresar</a>