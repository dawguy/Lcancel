var player1 = {};
var player2 = {};
var stage = 'Battlefield';
var player1Matches = {};
var player2Matches = {};

$(document).ready(function(){
	//From stackoverflow. Updates autocomplete's element sizes to not span entire screen
	//http://stackoverflow.com/questions/5643767/jquery-ui-autocomplete-width-not-set-correctly
	jQuery.ui.autocomplete.prototype._resizeMenu = function () {
	  var ul = this.menu.element;
	  ul.outerWidth(this.element.outerWidth());
	}

	setupClickHandlers();
    setupSearchHandlers();
});

function submit(){

}

function setupSearchHandlers(){
	$('#player1Name').autocomplete({
		source : 'users/search',
		select : function(event, ui){
			$('#player1Name').val(ui.item.value);
			player1.playerName = ui.item.value;
			player1.playerId = ui.item.id;
			playerNameChosen(1,ui.item);
		}
	});

		$('#player2Name').autocomplete({
    	source : 'users/search',
    	select : function(event, ui){
    		$('#player2Name').val(ui.item.value);
				player2.playerName = ui.item.value;
				player2.playerId = ui.item.id;
    		playerNameChosen(2,ui.item);
    	}
    });
}

function playerNameChosen(playerNumber,playerInfo){
		$('#player' + playerNumber + 'Id').text(playerInfo.value);

		//Determines the main character for a player
		var url = 'users/playerInfo/' + playerInfo.id;
		$.get(url)
		.done( function(data, text_status){
				if(playerNumber == 1){
					  var characterInfo = data.character;
						player1.primaryCharacterId = characterInfo.id;
						player1.primaryCharacterName = characterInfo.name;
						player1.character = $('#player1CharacterSelect').val(characterInfo.id).change();
						var playerStats = data.matches;
						player1Matches = playerStats;
						$('#player1StatsWins').text(playerStats.won.length);
						$('#player1StatsLosses').text(playerStats.lost.length);
						$('#player1StatsElo').text(1000);
				}

				if(playerNumber == 2){
					var characterInfo = data.character;
					player2.primaryCharacterId = characterInfo.id;
					player2.primaryCharacterName = characterInfo.name;
					player2.character = $('#player2CharacterSelect').val(characterInfo.id).change();
					var playerStats = data.matches;
					player2Matches = playerStats;
					$('#player2StatsWins').text(playerStats.won.length);
					$('#player2StatsLosses').text(playerStats.lost.length);
					$('#player2StatsElo').text(1000);
				}
		});
}

function updateStats(winningPlayerNumber){
	if(winningPlayerNumber === 1){
		var newWins = parseInt($('#player1StatsWins').text(), 10) + 1;
		var newLosses = parseInt($('#player2StatsLosses').text(), 10) + 1;
		$('#player1StatsWins').text(newWins);
		$('#player2StatsLosses').text(newLosses);
	} else {
		var newWins = parseInt($('#player2StatsWins').text(), 10) + 1;
		var newLosses = parseInt($('#player1StatsLosses').text(), 10) + 1;
		$('#player2StatsWins').text(newWins);
		$('#player1StatsLosses').text(newLosses);
	}
}

function setupClickHandlers(){
	$('#submitMatch').on('click', function(e){
		player1.character = $('#player1CharacterSelect').val();
		player1.stocks = $('#player1Stocks').val();
		player2.character = $('#player2CharacterSelect').val();
		player2.stocks = $('#player2Stocks').val();

		if(typeof player1.playerId === 'undefined' || typeof player2.playerId === 'undefined'){
			alert('You must choose 2 players.');
			return;
		}

		if(player1.playerId === player2.playerId){
			alert('You must choose 2 different players.');
			return;
		}

		var url = '/match';
		var token = $('#token').val();

		var map = {
			'_token'  : token,
			'player1' : player1,
			'player2' : player2,
			'stage'   : stage
		};

		$.ajax({
			url : url,
			type : 'PUT',
			data : map
		})
		.fail(function(d){
			console.log('Match create failed!');
		})
		.done(function(d){
			alert('Match added!');
			$('#player1Stocks').val(0).change();
			$('#player2Stocks').val(0).change();
			if(player1.stocks < player2.stocks){
				updateStats(2);
			} else {
				updateStats(1);
			}
		});
	});
}
