// Setup
$(document).ready(function(){
	// Events
	$("#event_start_at, #event_finish_at").datepicker({dateFormat: 'dd-mm-yy'});
	game_format = $("#game_formats").val();
	if (game_format == '0')
	{
		$("#game_format_team").css("display","none");
	}
	
	$("#game_formats").click(function(){
		if ($(this).val() == '0')
		{
			$("#game_format_team").css("display","none");
			$("#game_format_one").css("display","block");
		}else{
			$("#game_format_one").css("display","none");
			$("#game_format_team").css("display","block");
		}
	});
	
	// Teams
	$("#add_team").submit(function(){
		$("#players").attr("name","team_players[]").attr("id","team_players");
	});
});