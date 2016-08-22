var playerId = null;
var token = null;

$(document).ready( function(){
    setupClickHandlers();
    playerId = $('#playerId').val();
    token = $('#token').val();
});

function setupClickHandlers(){
    $('#add_friend').on('click', function(){
        console.log( 'Yay' );
        var url = '/friends/add/' + playerId;

        var map = {
            '_token' : token,
            playerId : playerId
        };

        $.ajax({
            url : url,
            type : 'PUT',
            data : map
        })
        .fail(function(d){
            console.log('Adding player as a friend failed');
        })
        .done(function(d){
            alert('Friend Added!');
            $('#add_friend').remove();
        });
    });

    $('#remove_friend').on('click', function(){
        var url = '/friends/remove/' + playerId;

        var map = {
            '_token' : token,
            playerId : playerId
        };

        $.ajax({
            url : url,
            type : 'DELETE',
            data : map
        })
        .fail(function(d){
            console.log('Removing player as a friend failed');
        })
        .done(function(d){
            alert('Friend Removed');
            $('#remove_friend').remove();
        });
    });
}
