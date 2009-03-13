// Setup
$(document).ready(function(){
	$("#event_start_at, #event_finish_at").datepicker({dateFormat: 'dd-mm-yy'});
	
	// Teams
	$("#add_team").submit(function(){
		$("#players").attr("name","team_players[]").attr("id","team_players");
	});
});