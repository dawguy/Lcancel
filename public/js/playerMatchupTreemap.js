$(document).ready(function(){
    init();
});

/*
    Treemap code based off https://bl.ocks.org/mbostock/4063582
    https://bl.ocks.org/mbostock/2838bf53e0e65f369f476afd653663a2
    http://bl.ocks.org/shimizu/6d60e554dcbba406721e73ed5afdf713
*/
function init(){
    var p1 = playerOne;
    var p2 = playerTwo;
    var url = "/matchup/playerJson/playerOne/" + p1 + "/playerTwo/" + p2;

    var margin = {
        top : 20,
        right : 20,
        bottom : 20,
        left : 20
    };
    var width = 800 - margin.left - margin.right;
    var height = 800 - margin.top - margin.bottom;

    var color = d3.scaleOrdinal()
    .range(d3.schemeCategory10
    .map(function(c) { c = d3.rgb(c); c.opacity = 0.6; return c; }));

    var svg = d3.select(".graph").append("svg")

    var chartLayer = svg.append("g").classed("chartLayer", true);

    svg.attr("width", width).attr("height", height)

    chartLayer
        .attr("width", width)
        .attr("height", width)
        .attr("transform", "translate("+[margin.left, margin.top]+")")

    d3.json(url, function(error, root) {
        if(error) throw error;
        var tree = d3.hierarchy(root)
            .sum(function(d){ return d.total; });

        var treemap = d3.treemap()
            .size([width,height])
            .padding(1)
            .round(true);

        treemap(tree);

        drawChart(tree);
    });

    function drawChart(root) {
       var node = chartLayer
           .selectAll(".node")
           .data(root.leaves(), function(d){ return d.name })

       node
           .selectAll("rect")
           .data(root.leaves(), function(d){ return d.name })

       node
           .selectAll("text")
           .data(root.leaves(), function(d){ return d.name })

       var newNode = node.enter()
           .append("g")
           .attr("class", "node")

       newNode.append("rect")
       newNode.append("text")

       chartLayer
           .selectAll(".node rect")
           .transition()
           .duration(1000)
           .attr("x", function(d) { return d.x0 })
           .attr("y", function(d) { return d.y0  })
           .attr("width", function(d) { return d.x1 - d.x0 })
           .attr("height", function(d) { return d.y1 - d.y0})
           .attr("fill", function(d) { while (d.depth > 1) d = d.parent; return color(d.data.id); })

       chartLayer
           .selectAll(".node text")
           .transition()
           .delay(function(d,i){ return i * 100 })
           .duration(1000)
           .text(function(d){ return d.data.id })
           .attr("y", "1.5em")
           .attr("x", "0.5em")
           .attr("font-size", "0.6em")
           .attr("transform", function(d){ return "translate("+[d.x0, d.y0]+")" })

    }
}
