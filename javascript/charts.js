function drawPieChart(array, options, div) {
	var data = google.visualization.arrayToDataTable(array);
	var chart = new google.visualization.PieChart(document.getElementById(div));
	chart.draw(data, options);
}
function drawLineChart(array, options, div) {
	var data = google.visualization.arrayToDataTable(array);
	var chart = new google.visualization.LineChart(document.getElementById(div));
	chart.draw(data, options);
}
function drawBarChart	(array, options, div) {
  var data = google.visualization.arrayToDataTable(array);
  var view = new google.visualization.DataView(data);
  view.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);
  var chart = new google.visualization.BarChart(document.getElementById(div));
  chart.draw(view, options);
}