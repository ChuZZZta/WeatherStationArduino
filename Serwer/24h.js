var chart = bb.generate({
  data: {
    x: "x",
	xFormat: "%Y-%m-%d %H:%M:%S",
    columns: []
  },
  axis: {
    x: {
      type: "timeseries",
      tick: {
        format: "%Y-%m-%d %H:%M"
      }
    }
  },
  bindto: "#chart"
});
var chart2 = bb.generate({
  data: {
    x: "x",
	xFormat: "%Y-%m-%d %H:%M:%S",
    columns: []
  },
  axis: {
    x: {
      type: "timeseries",
      tick: {
        format: "%Y-%m-%d %H:%M"
      }
    }
  },
  bindto: "#chart2"
});
var chart3 = bb.generate({
  data: {
    x: "x",
	xFormat: "%Y-%m-%d %H:%M:%S",
    columns: []
  },
  axis: {
    x: {
      type: "timeseries",
      tick: {
        format: "%Y-%m-%d %H:%M"
      }
    }
  },
  bindto: "#chart3"
});
setTimeout(function() {
	chart.load({
		columns: [
			godz,
			temp,
			humi
		]
	});
	chart2.load({
		columns: [
			godz,
			press
		]
	});
	chart3.load({
		columns: [
			godz,
			rain
		]
	});
}, 100);