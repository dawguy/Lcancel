$(document).ready(function(){
    init();
});

var matchupsBarData = [];

function init(){
    console.log(matches);
    console.log(characters);

    for(var i = 0; i < matches.length; i++){
        var match = matches[i]
        var character = characters[match['winner_character']];

        if(typeof matchupsBarData[character] === 'undefined'){
            matchupsBarData[character] = 1;
        }
        else {
            matchupsBarData[character] += 1;
        }
    }

    console.log(matchupsBarData);

    var data = Object.keys(matchupsBarData)
        .map(function(key){
            return matchupsBarData[key]
        });

    d3.select(".chart")
      .selectAll("div")
        .data(data)
      .enter().append("div")
        .style("width", function(d) { return d * 10 + "px"; })
        .style("background-color", function(d) { return 'gray'; })
        .style("color", function(d) { return 'black'; })
        .text(function(d) { return d; });
}
