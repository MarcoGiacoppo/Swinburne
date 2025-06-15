function init() {
    //setting up the data
    var w = 300;
    var h = 300;

    var dataset = [5, 6, 10, 20, 25, 45];
    //setting up the pie chart parameters
    var outerRadius = w / 2;
    var innerRadius = 0;
    
    //generate the paths for the data bound to the arcs group
    var arc = d3.arc()
                .outerRadius(outerRadius)
                .innerRadius(innerRadius);
    //this generates the angles we need to draw the segments
    var pie = d3.pie();

    var svg = d3.select("#chart")
                .append("svg")
                .attr("width", w)
                .attr("height", h);
    //attaching colour fill into something i found on colorbrewer
    var color = d3.scaleOrdinal(d3.schemePastel2);  

    var arcs = svg.selectAll("g.arc")
                .data(pie(dataset))
                .enter()
                .append("g")
                .attr("class", "arc")
                .attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

    arcs.append("path")
        .attr("fill", function(d, i) {
                return color(i);
        })
        .attr("d", function(d, i) {
                return arc(d, i);
        })	
    //adding some text labels to the chart
    arcs.append("text")
        .text(function(d) {
            return d.value;
        })
        //pushing the text out to their respective segments
        .attr("transform", function(d) {
            return "translate(" + arc.centroid(d) + ")";
        });
}

window.onload = init;