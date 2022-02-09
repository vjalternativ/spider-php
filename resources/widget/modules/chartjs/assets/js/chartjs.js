var chart;

function getSampleData() {
	var json = document.getElementById("chartjson").innerHTML;
	return JSON.parse(json);
}
window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};


function getChartConfiguration() {

	var color = Chart.helpers.color;
	var cfg = {
		data: {
			datasets: [{
				label: 'Daily Price Trend',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				data: getSampleData(),
				type: 'line',
				pointRadius: 0,
				fill: false,
				lineTension: 0,
				borderWidth: 2
			}]
		},
		options: {
			animation: {
				duration: 0
			},
			scales: {
				xAxes: [{
					type: 'time',
					distribution: 'series',
					offset: true,
					ticks: {
						major: {
							enabled: true,
							fontStyle: 'bold'
						},
						source: 'data',
						autoSkip: true,
						autoSkipPadding: 75,
						maxRotation: 0,
						sampleSize: 100
					}
				}],
				yAxes: [{
					gridLines: {
						drawBorder: false
					},
					scaleLabel: {
						display: true,
						labelString: 'Closing price (INR)'
					}
				}]
			},
			tooltips: {}
		}
	};

	return cfg;
}

function drawchart(id) {
	var ctx = document.getElementById(id).getContext('2d');
	ctx.canvas.width = 100;
	ctx.canvas.height = 30;
	let cfg = getChartConfiguration();
	chart = new Chart(ctx, cfg);

}


function destroyChart() {
	chart.destroy();
}

function updateChart(dataset) {
	chart.data.datasets = dataset; 
	chart.update();
 
}

$(document).ready(function() {

	drawchart("myChart");
});
