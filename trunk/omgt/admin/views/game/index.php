<div id="games_tabs">
	<ul class="tabs"> 
		<li><a class="selected" href="#games">Games</a></li> 
		<li><a href="#scenarios">Scenarios</a></li> 
	</ul> 
	
	<div id="games" class="tabs_content">
		<a href="/admin/game/create/">Create Game</a>
		<?php echo $game_list; ?>
	</div>
	<div id="scenarios" class="tabs_content">
		<a href="/admin/scenario/create/">Create Scenario</a>
		<?php echo $scenario_list; ?>
	</div>
	
	<a href="/admin/">Regresar</a>
</div>
