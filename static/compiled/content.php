

<html>
<head>
    <meta charset="utf-8">
    <title>New QoE</title>
    
    <link rel="stylesheet" href="reset.css" type="text/css">
    <link rel="stylesheet" href="styl.css" type="text/css">
        
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	
	

</head>

<body>
    
    <!-- *********  Header  ********** -->
    
     <div id="header">
        <div id="header_in">
        
           <h1><a href="index.php"><b>New </b> QoE</a></h1>
        
         <div id="menu">
         <ul>
            <li><a href="index.php" >Home</a></li>
            <li><a href="user.php" >User</a></li>
            <li><a href="content.php" class="active">content</a></li>
           
           <li><a href="context.php">Context</a></li>         
         </ul>
        </div>
        
        </div>
    </div>
    
    <!-- *********  Main part – headline ********** -->
    
        
        <div id="main_part_inner">
            <div id="main_part_inner_in">
        
            <h2>Content Detail</h2>
            
            
            
            </div>
            
        </div>
        
        
        <!-- *********  Content  ********** -->
        
		<div style="width:960px;margin:auto;">
       <form action="content.php" method="post">
		 contentID: <input type="text" name="content" />
		</br>
		
		
		
		
		<input type="submit" />
		</form>
		
		 <div id="container" style="height: 500px; min-width: 310px"></div>
		
		
		
		<div style="width:450px;float:left">
		<div id="container2" style="min-width: 110px; height: 400px; margin: 0 auto"></div>
		</div>
    
	</div>
   <!-- *********  Footer  ********** -->
    
    <hr class="cleanit">
    
     <div id="footer">
        <div id="footer_in">
            
            <p><a href="www.tsinghua.edu.cn">Tsinghua University</a> Department of Computer Science and Technology</p>
            <span>Author: <a href="http://media.cs.tsinghua.edu.cn/~wangzhi/">Wang Zhi</a> - Zhou Chao </span>

        
        </div>
    </div>
         

</body>

<script type="text/javascript">
$(function () {
$.getJSON('http://localhost/showPage/service/contentDevice.php?callback=?&contentid=<?php echo $content; ?>', function(data) {
    $('#container2').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'device '
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Users Rate',
            data: data
        }]
    });
	 });
});
    

		</script>
		
		
		
		<script type="text/javascript">
$(function() {
	$.getJSON('http://localhost/showPage/service/indexCdf.php?callback=?&contentid=<?php echo $content; ?>&type=3', function(data) {

		// Create the chart
		$('#container').highcharts('StockChart', {
			

			rangeSelector : {
				selected : 1
			},

			title : {
				text : 'Time&cdf '
			},

			series : [{
				name : 'Time&cdf ',
				data : data,
				type : 'area',
				threshold : null,
				tooltip : {
					valueDecimals : 2
				},
				fillColor : {
					linearGradient : {
						x1: 0, 
						y1: 0, 
						x2: 0, 
						y2: 1
					},
					stops : [[0, Highcharts.getOptions().colors[0]], [1, 'rgba(0,0,0,0)']]
				}
			}]
		});
	});
});

		</script>
		
		
		<script src="hsjs/highstock.js"></script>
<script src="hsjs/modules/exporting.js"></script>
<script src="hcjs/highcharts.js"></script>
<script src="hcjs/modules/exporting.js"></script>


</html>
