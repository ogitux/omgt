<h1>Edit Tournament</h1>
<form action="/tournament/edit/<?php echo $id; ?>" method="post">
	<div class="span-3 first">Name</div><div class="span-13 last"><input type="text" id="name" name="name" value="<?php echo $name; ?>" /></div>
	<div class="span-3 first">Game</div><div class="span-13 last"><?php echo $select_game; ?></div>
	<div class="span-3 first">Begin Date</div><div class="span-13 last"><input name="begin_date" id="begin_date" value="<?php echo $begin_date; ?>" class="date-picker" /></div>
	<div class="span-3 first">End Date</div><div class="span-13 last"><input name="end_date" id="end_date" value="<?php echo $end_date; ?>" class="date-picker" /></div>
	<div class="span-3 first">&nbsp;</div><div class="span-13 last"><input type="submit" value="Save Tournament"  /></div>
</form>
<a href="/tournament/">Regresar</a>