var selectedPlayer;
var playerDiv;

var player1Lives = 4;
var player2Lives = 4;

var player1Character;
var player2Character;

var fullOpacity    = 1;
var partialOpacity = .1;

$(document).ready(function(){
	setupClickHandlers();
});

function submit(){
	
}

function setupClickHandlers(){
	$('.player').on('click', function(d){
		var player = $(this).data();
		var playerName = this.innerHTML;
		var playerId = player.playerid;
		
		if(typeof playerDiv !== 'undefined'){
			$(playerDiv).css('background', '#9494b8');
		}

		$(this).css('background', '#3399ff');


		$('#opponent').text(playerName);

		selectedPlayer = {
			name : playerName,
			id : playerId
		};
		playerDiv = this;
	});

	$('.player1Character').on('click', function(d){
		$('#player1CharacterSelect').toggle();
	});

	$('.player2Character').on('click', function(){
		$('#player2CharacterSelect').toggle();
	});

	$('.characterSelect').on('click', function(){
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
		$(playerCharacterSelectId).toggle();
	});

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