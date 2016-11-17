var player1 = {};
var player2 = {};
var stage = 'Battlefield';

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
		var url = 'users/mainCharacter/' + playerInfo.id;
		$.get(url)
		.done( function(data, text_status){
				if(playerNumber == 1){
						player1.primaryCharacterId = data.id;
						player1.primaryCharacterName = data.value;
						player1.character = $('#player1CharacterSelect').val(data.id).change();
				}

				if(playerNumber == 2){
						player2.primaryCharacterId = data.id;
						player2.primaryCharacterName = data.value;
						player2.character = $('#player2CharacterSelect').val(data.id).change();
				}
		});
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
		});
	});
}
