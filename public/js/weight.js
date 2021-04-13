var $script = $('#script');
var result = JSON.parse($script.attr('data-param'));
var label = result[0];
var weight_log = result[1];
//グラフを描画
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
	type: 'line',
	data : {
		labels: label,
		datasets: [
			{
				label: '体重',
				data: weight_log,
				borderColor: "rgba(0,0,255,1)",
      			backgroundColor: "rgba(0,0,0,0)"
			}
		]
	},
	options: {
		title: {
			display: true,
			text: '体重ログ'
		},
		maintainAspectRatio: false 
	}
});