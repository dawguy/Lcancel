$(document).ready(function(){
    init();
});

function init(){
    console.log(matches);
    console.log(characters);
    d3.select(".chart")
      .selectAll("div")
        .data(matches)
      .enter().append("div")
        .style("width", function(d) { return d * 10 + "px"; })
        .text(function(d) { return d; });
}
