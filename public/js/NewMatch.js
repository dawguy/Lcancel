var selectedPlayer;
var playerDiv;

var player1Id;
var player2Id;

var player1Lives = 4;
var player2Lives = 4;

var player1Character;
var player2Character;

var stage = 'Battlefield';

var fullOpacity    = 1;
var partialOpacity = .1;

$(document).ready(function(){
	setupClickHandlers();
    setupSearchHandlers();
    player1Character = $('.player1Character').data('character');
    player1Id = $('#player1Id').data('user');
});

function submit(){
	
}

function setupSearchHandlers(){
    $('#player_search').autocomplete({
    	source : 'users/search',
    	select : function(event, ui){
    		$('#player_search').val(ui.item.value);
    		var playerName = ui.item.value
    		var playerId = ui.item.id;

    		select_player_two(playerName,playerId);
    	},
    	appendTo : '#player_search_container'
    });
}

function select_player_two(playerName, playerId){
		if(typeof playerDiv !== 'undefined'){
			$(playerDiv).css('background', '#9494b8');
		}

		$('#opponent').text(playerName);

		selectedPlayer = {
			name : playerName,
			id : playerId
		};

		player2Id = playerId;
		playerDiv = this;

		var url = 'users/mainCharacter/' + player2Id;
		$.get(url)
		.done( function(data, text_status){
			player2Character = data.name;
			$('#player2_character_' + data.id).trigger('click');
		});
}

function characterClicked(){
	var playerNumber    = $(this).data('playernumber');
	var characterChoice = $(this).data('character');
	var imgPath         = $(this).attr('src');

	var playerCharacterSelectId = '#player' + playerNumber + 'CharacterSelect';
	var playerCharacterId       = '#player' + playerNumber + 'Character';
	var playerStockClass        = '.player' + playerNumber + 'Stock';

	if(playerNumber == 1){
		player1Character = characterChoice;
	} else {
		player2Character = characterChoice;
	}

	$(playerCharacterId).attr('src', imgPath);
	$(playerStockClass).attr('src', imgPath);
	$(playerCharacterSelectId).hide();
}

function setupClickHandlers(){
	$('.player').on('click', function(d){
		var player = $(this).data();
		var playerName = this.innerHTML;
		var playerId = player.playerid;
		
		select_player_two(playerName,playerId);
	});

	$('#submitMatch').on('click', function(e){
		var player1 = {
			'character' : player1Character,
			'stocks'    : player1Lives,
			'playerId'  : player1Id
		};

		var player2 = {
			'character' : player2Character,
			'stocks'    : player2Lives,
			'playerId'  : player2Id
		};

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
			console.log('Put Success! New match');
		});
	});

	$('.player1Character').on('click', function(d){
		$('#player1CharacterSelect').toggle();
	});

	$('.player2Character').on('click', function(){
		$('#player2CharacterSelect').toggle();
	});

	for(var i = 1; i <= 27; i++){
		$('#player1_character_' + i).on('click', characterClicked);
		$('#player2_character_' + i).on('click', characterClicked);
	}
	// Player 1
	$('#player1_0Lives').on('click', function(){
		player1Lives = 0;
		$('#player1_0Lives').css('opacity', fullOpacity);
		$('#player1_1Lives').css('opacity', partialOpacity);
		$('#player1_2Lives').css('opacity', partialOpacity);
		$('#player1_3Lives').css('opacity', partialOpacity);
		$('#player1_4Lives').css('opacity', partialOpacity);
	});

	$('#player1_1Lives').on('click', function(){
		player1Lives = 1;
		$('#player1_0Lives').css('opacity', partialOpacity);
		$('#player1_1Lives').css('opacity', fullOpacity);
		$('#player1_2Lives').css('opacity', partialOpacity);
		$('#player1_3Lives').css('opacity', partialOpacity);
		$('#player1_4Lives').css('opacity', partialOpacity);
	});

	$('#player1_2Lives').on('click', function(){
		player1Lives = 2;
		$('#player1_0Lives').css('opacity', partialOpacity);
		$('#player1_1Lives').css('opacity', fullOpacity);
		$('#player1_2Lives').css('opacity', fullOpacity);
		$('#player1_3Lives').css('opacity', partialOpacity);
		$('#player1_4Lives').css('opacity', partialOpacity);
	});

	$('#player1_3Lives').on('click', function(){
		player1Lives = 3;
		$('#player1_0Lives').css('opacity', partialOpacity);
		$('#player1_1Lives').css('opacity', fullOpacity);
		$('#player1_2Lives').css('opacity', fullOpacity);
		$('#player1_3Lives').css('opacity', fullOpacity);
		$('#player1_4Lives').css('opacity', partialOpacity);
	});

	$('#player1_4Lives').on('click', function(){
		player1Lives = 4;
		$('#player1_0Lives').css('opacity', partialOpacity);
		$('#player1_1Lives').css('opacity', fullOpacity);
		$('#player1_2Lives').css('opacity', fullOpacity);
		$('#player1_3Lives').css('opacity', fullOpacity);
		$('#player1_4Lives').css('opacity', fullOpacity);
	});

	// Player 2
	$('#player2_0Lives').on('click', function(){
		player2Lives = 0;
		$('#player2_0Lives').css('opacity', fullOpacity);
		$('#player2_1Lives').css('opacity', partialOpacity);
		$('#player2_2Lives').css('opacity', partialOpacity);
		$('#player2_3Lives').css('opacity', partialOpacity);
		$('#player2_4Lives').css('opacity', partialOpacity);
	});

	$('#player2_1Lives').on('click', function(){
		player2Lives = 1;
		$('#player2_0Lives').css('opacity', partialOpacity);
		$('#player2_1Lives').css('opacity', fullOpacity);
		$('#player2_2Lives').css('opacity', partialOpacity);
		$('#player2_3Lives').css('opacity', partialOpacity);
		$('#player2_4Lives').css('opacity', partialOpacity);
	});

	$('#player2_2Lives').on('click', function(){
		player2Lives = 2;
		$('#player2_0Lives').css('opacity', partialOpacity);
		$('#player2_1Lives').css('opacity', fullOpacity);
		$('#player2_2Lives').css('opacity', fullOpacity);
		$('#player2_3Lives').css('opacity', partialOpacity);
		$('#player2_4Lives').css('opacity', partialOpacity);
	});

	$('#player2_3Lives').on('click', function(){
		player2Lives = 3;
		$('#player2_0Lives').css('opacity', partialOpacity);
		$('#player2_1Lives').css('opacity', fullOpacity);
		$('#player2_2Lives').css('opacity', fullOpacity);
		$('#player2_3Lives').css('opacity', fullOpacity);
		$('#player2_4Lives').css('opacity', partialOpacity);
	});

	$('#player2_4Lives').on('click', function(){
		player2Lives = 4;
		$('#player2_0Lives').css('opacity', partialOpacity);
		$('#player2_1Lives').css('opacity', fullOpacity);
		$('#player2_2Lives').css('opacity', fullOpacity);
		$('#player2_3Lives').css('opacity', fullOpacity);
		$('#player2_4Lives').css('opacity', fullOpacity);
	});

	$('#player1_4Lives').mouseenter( function(){ addShadow('.p1s4'); });
	$('#player1_4Lives').mouseleave( function(){ removeShadow('.p1s4'); });

	$('#player1_3Lives').mouseenter( function(){ addShadow('.p1s3'); });
	$('#player1_3Lives').mouseleave( function(){ removeShadow('.p1s3'); });

	$('#player1_2Lives').mouseenter( function(){ addShadow('.p1s2'); });
	$('#player1_2Lives').mouseleave( function(){ removeShadow('.p1s2'); });

	$('#player1_1Lives').mouseenter( function(){ addShadow('.p1s1'); });
	$('#player1_1Lives').mouseleave( function(){ removeShadow('.p1s1'); });


	$('#player2_4Lives').mouseenter( function(){ addShadow('.p2s4'); });
	$('#player2_4Lives').mouseleave( function(){ removeShadow('.p2s4'); });

	$('#player2_3Lives').mouseenter( function(){ addShadow('.p2s3'); });
	$('#player2_3Lives').mouseleave( function(){ removeShadow('.p2s3'); });

	$('#player2_2Lives').mouseenter( function(){ addShadow('.p2s2'); });
	$('#player2_2Lives').mouseleave( function(){ removeShadow('.p2s2'); });

	$('#player2_1Lives').mouseenter( function(){ addShadow('.p2s1'); });
	$('#player2_1Lives').mouseleave( function(){ removeShadow('.p2s1'); });
}

function addShadow(e){
	$(e).css('box-shadow', '0 0 10px rgba(216, 145, 145, 1)');
}

function removeShadow(e){
	$(e).css('box-shadow', '');
}
