function init() {

    //widht and height
    var w = 500;
    var h = 300;

    //expressing data as a SVG path using geoPath
    //using geoMercator since we need to specify a projection
    var projection = d3.geoMercator()
                    .center([145, -36.5])
                    .translate([w / 2, h / 2])
                    .scale(2450);

    var path = d3.geoPath()
                .projection(projection);

    //add SVG canvas and read the GeoJSON file using d3.json()
    var svg = d3.select("#chart")
                .append("svg")
                .attr("width", w)
                .attr("height", h)
                .attr("fill", "#043051")

    d3.json("LGA_VIC.json").then(function(json) {
        svg.selectAll("path")
            .data(json.features)
            .enter()
            .append("path")
            .attr("d", path);
    });
}

window.onload = init;