</head>
<body>
<div id="container">
    <h1>CodeIgniter with Highcharts <span style="float:right">Dida Nurwanda</span></h1>
 
    <div id="body">
        <div id="chart"></div>
    </div>
	
 
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<div id="container2">

</div>
<?php
echo json_encode($nodeidne);
?>
 
<script type="text/javascript" src="<?php echo base_url('/assets/jquery-3.2.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/highcharts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/modules/exporting.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/themes/dark-green.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/highcharts-3d.js'); ?>"></script>
<script type="text/javascript">
jQuery(function(){
    new Highcharts.Chart({
        chart: {
            renderTo: 'chart',
            type: 'line',
        },
        title: {
            text: 'Pendapatan Tahun 2013',
            x: -20
        },
        subtitle: {
            text: 'http://didanurwanda.blogspot.com',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Pendapatan (Juta)'
            }
        },
        series: [{
            name: 'Pendapatan (Juta)',
            data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111] 
        }]
    });
}); 
</script>

<script>

$(function() {
   const rand = function (from, to) {
     return Math.round(from + Math.random() * (to - from));
  };
  const chart = Highcharts.chart('container2', {
    chart: {
      type: 'column',
      options3d: {
        enabled: true,
        alpha: 20,
        beta: 30,
        depth: 400, // Set deph
        viewDistance: 5,
        frame: {
          bottom: {
            size: 1,
            color: 'rgba(0,0,0,0.05)'
          }
        }
      }
    },
    title: {
      text: ''
    },
    subtitle: {
      text: ''
    },
    yAxis: {
      min: 0,
      max: 10
    },
    xAxis: {
     
      gridLineWidth: 1,
	  categories: <?php echo json_encode($tanggalane); ?>
    },
    zAxis: {
      min: 0,
      max: 11,
      categories: <?php echo json_encode($nodeidne); ?>,
      labels: {
        y: 5,
        rotation: 18
      }
    },
    plotOptions: {
      series: {
        groupZPadding: 10,
        depth: 100,
        groupPadding: 0,
        grouping: false,
      }
    },
     series: [{
      wew: 0,
      data: [...Array(4)].map((v, i) => ({ x: i, y: rand(0, 10) }))
    }, {
      wew: 1,
      data: [...Array(4)].map((v, i) => ({ x: i, y: rand(0, 10) }))
    }, {
      we: 2,
      data: [...Array(4)].map((v, i) => ({ x: i, y: rand(0, 10) }))
    },{
      stack: 3,
      data: [...Array(4)].map((v, i) => ({ x: i, y: rand(0, 10) }))
	},{
      stack: 3,
      data: [...Array(4)].map((v, i) => ({ x: i, y: rand(0, 10) }))
    }]
  });


  // Add mouse events for rotation
  $(chart.container).on('mousedown.hc touchstart.hc', function(eStart) {
    eStart = chart.pointer.normalize(eStart);

    var posX = eStart.pageX,
      posY = eStart.pageY,
      alpha = chart.options.chart.options3d.alpha,
      beta = chart.options.chart.options3d.beta,
      newAlpha,
      newBeta,
      sensitivity = 5; // lower is more sensitive

    $(document).on({
      'mousemove.hc touchdrag.hc': function(e) {
        // Run beta
        newBeta = beta + (posX - e.pageX) / sensitivity;
        chart.options.chart.options3d.beta = newBeta;

        // Run alpha
        newAlpha = alpha + (e.pageY - posY) / sensitivity;
        chart.options.chart.options3d.alpha = newAlpha;

        chart.redraw(false);
      },
      'mouseup touchend': function() {
        $(document).off('.hc');
      }
    });
  });

});


</script>
</body>
</html>