function init() {

    // height and width of the map
    var w = 600;
    var h = 300;
    var padding = 50;

    var dataset = [];

    d3.csv("Unemployment_78-95.csv", function(d) {
        return {
            //javascript date using newDate, -1 is there because js month starts at 0
            date: new Date(+d.year, +d.month - 1),
            number: +d.number
        };
        //loading data into dataset
    }).then(function(data) {
        dataset = data;

        lineChart(dataset);
        console.table(dataset, ["date", "number"]);
    });    

    function lineChart(dataset) {
        // we use scaleTime because its a date, not a straight number
        // and we need to refer to the column heading
        xScale = d3.scaleTime()
                .domain([
                    d3.min(dataset, function(d) { return d.date; }),
                    d3.max(dataset, function(d) { return d.date; })
                ])
                .range([padding + 20, w - padding]); 

        yScale = d3.scaleLinear()
                .domain([0, d3.max(dataset, function(d) { return d.number; })])
                .range([h - padding, padding]);
        //using d3.line to create the line and tell them where to find x and y
        line = d3.line()
                 .x(function(d) { return xScale(d.date); })
                 .y(function(d) { return yScale(d.number); });

        area = d3.area()
                 .x(function (d) { return xScale(d.date); })
                 
                 //base line for area shape
                 .y0(function() { return yScale.range()[0]; })
                 
                 .y1(function(d) { return yScale(d.number); });

        var svg = d3.select("#chart")
                    .append("svg")
                    .attr("width", w)
                    .attr("height", h);
                //we use datum() to bind the data to a single path element
                svg.append("path")
                    .datum(dataset)
                    .attr("class", "line")
                    .attr("d", area);
        
        var xAxis = d3.axisBottom()
                    .ticks(10)
                    .scale(xScale);

        var yAxis = d3.axisLeft()
                    .ticks(10)
                    .scale(yScale);

                svg.append("g")
                    .attr("transform", "translate(0, " + (h - padding) + ")")
                    .call(xAxis);
            
                svg.append("g")
                    .attr("transform", "translate(" + (padding + 20) + ", 0)")
                    .call(yAxis);
                
                svg.append("line")
                    .attr("class", "line halfMilMark")
                    //start of line
                    .attr("x1", padding + 20)
                    .attr("y1", yScale(500000))
                    //end of line
                    .attr("x2", w - padding)
                    .attr("y2", yScale(500000));
                
                svg.append("text")
                    .attr("class", "halfMilLabel")
                    .attr("x", padding + 30)
                    .attr("y", yScale(500000) - 7)
                    .text("Half a million unemployed");
    }
}

window.onload = init;