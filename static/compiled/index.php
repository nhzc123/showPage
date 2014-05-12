<!DOCTYPE html>

<html>
  <head>
    <meta  charset="utf-8" />
    <title>New QoE</title>
    
    
    <link rel="stylesheet" href="reset.css" type="text/css">
    <link rel="stylesheet" href="styl.css" type="text/css">
   <link rel="stylesheet" href="tab.css" type="text/css"> 
        
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="jquery.min.js"></script>

<script src="echartjs/esl.js"></script>
		
    <script type="text/javascript">


      $(document).ready(function(){
       


  var seriesOptions = [],
    yAxisOptions = [],
    seriesCounter = 0,
    names = ['0~20%','20~40%','40~60%','60~80%','80~100%'],
    colors = Highcharts.getOptions().colors;

      $.ajax({
            type : "get",
            async:false,
            url : "service/indexCdf.php?callback=?&type=2",
            dataType : "jsonp",
            jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
            success : function(data){

      seriesOptions[0] = {
        name: "totalNumber",
        data: data
      };
     
    
     $.each(names, function(i, name) {

      nu=i+3;
    $.getJSON('service/indexCdf.php?callback=?&type='+nu, function(data) {

      seriesOptions[i+1] = {
        name: name,
        data: data
      };

      // As we're loading the data asynchronously, we don't know what order it will arrive. So
      // we keep a counter and create the chart when all the data is loaded.
      seriesCounter++;

      if (seriesCounter == names.length) {
        createChart();
      }
    });
  }); 
 

            }});
//开始查询其他三条曲线，已经由第一个ajax请求完毕



function createChart(){



    $('#engagement').highcharts('StockChart', {
        chart: {
        },

        rangeSelector: {
        inputEnabled: $('#engagement').width() > 480,
            selected: 4
        },

        title:{
          text:'engagement',
      },

        yAxis: {
          labels: {
            formatter: function() {
              return this.value ;
            }
          },
          plotLines: [{
            value: 0,
            width: 2,
            color: 'silver'
          }]
        },
        
        
        tooltip: {
          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> <br/>',
          valueDecimals: 2
        },
        
        series: seriesOptions

    });




    $('#cdn2').highcharts('StockChart', {
        chart: {
        },

        rangeSelector: {
        inputEnabled: $('#engagemen').width() > 480,
            selected: 4
        },

        title:{
          text:'engagement',
      },

        yAxis: {
          labels: {
            formatter: function() {
              return this.value ;
            }
          },
          plotLines: [{
            value: 0,
            width: 2,
            color: 'silver'
          }]
        },
        
        
        tooltip: {
          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> <br/>',
          valueDecimals: 2
        },
        
        series: seriesOptions

    });



}


//cdn_ws--------------------------


  var seriesOptions = [],
    yAxisOptions = [],
    seriesCounter_ws = 0,
    names = ['0~20%','20~40%','40~60%','60~80%','80~100%'],
    colors = Highcharts.getOptions().colors;

      $.ajax({
            type : "get",
            async:false,
            url : "service/indexCdf_ws.php?callback=?&type=2",
            dataType : "jsonp",
            jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
            success : function(data){

      seriesOptions[0] = {
        name: "totalNumber",
        data: data
      };
     
    
     $.each(names, function(i, name) {

      nu=i+3;
    $.getJSON('service/indexCdf_ws.php?callback=?&type='+nu, function(data) {

      seriesOptions[i+1] = {
        name: name,
        data: data
      };

      // As we're loading the data asynchronously, we don't know what order it will arrive. So
      // we keep a counter and create the chart when all the data is loaded.
      seriesCounter_ws++;

      if (seriesCounter_ws == names.length) {
        createChart_ws();
      }
    });
  }); 
 

            }});
//开始查询其他三条曲线，已经由第一个ajax请求完毕



function createChart_ws(){

    $('#cdn2').highcharts('StockChart', {
        chart: {
        },

        rangeSelector: {
        inputEnabled: $('#engagemen').width() > 480,
            selected: 4
        },

        title:{
          text:'engagement',
      },

        yAxis: {
          labels: {
            formatter: function() {
              return this.value ;
            }
          },
          plotLines: [{
            value: 0,
            width: 2,
            color: 'silver'
          }]
        },
        
        
        tooltip: {
          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> <br/>',
          valueDecimals: 2
        },
        
        series: seriesOptions

    });




}

//cdn_lx--------------------------


  var seriesOptions = [],
    yAxisOptions = [],
    seriesCounter_lx = 0,
    names = ['0~20%','20~40%','40~60%','60~80%','80~100%'],
    colors = Highcharts.getOptions().colors;

      $.ajax({
            type : "get",
            async:false,
            url : "service/indexCdf_lx.php?callback=?&type=2",
            dataType : "jsonp",
            jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
            success : function(data){

      seriesOptions[0] = {
        name: "totalNumber",
        data: data
      };
     
    
     $.each(names, function(i, name) {

      nu=i+3;
    $.getJSON('service/indexCdf_lx.php?callback=?&type='+nu, function(data) {

      seriesOptions[i+1] = {
        name: name,
        data: data
      };

      // As we're loading the data asynchronously, we don't know what order it will arrive. So
      // we keep a counter and create the chart when all the data is loaded.
      seriesCounter_lx++;

      if (seriesCounter_lx == names.length) {
        createChart_lx();
      }
    });
  }); 
 

            }});
//开始查询其他三条曲线，已经由第一个ajax请求完毕



function createChart_lx(){

    $('#cdn1').highcharts('StockChart', {
        chart: {
        },

        rangeSelector: {
        inputEnabled: $('#engagemen').width() > 480,
            selected: 4
        },

        title:{
          text:'engagement',
      },

        yAxis: {
          labels: {
            formatter: function() {
              return this.value ;
            }
          },
          plotLines: [{
            value: 0,
            width: 2,
            color: 'silver'
          }]
        },
        
        
        tooltip: {
          pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> <br/>',
          valueDecimals: 2
        },
        
        series: seriesOptions

    });




}


      });
    
    
    </script>



		<script type="text/javascript">
$(function () {
    $('#device').highcharts({
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
            name: 'device',
            data: [
                
                <?php echo $device; ?>              
                
            ]
        }]
    });
});
    

		</script>
		
			<script type="text/javascript">
$(function () {
    $('#bitRate').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'bitRate'
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
            name: 'bitRate',
            data: [
              ['S3',   <?php echo $s3; ?>],
            ['S2',       <?php echo $s2; ?>],
                {
                    name: 'S1',
                          y: <?php echo $s1; ?>,
                    sliced: true,
                    selected: true
                },
                ['S4',    <?php echo $s4; ?>]
               
            ]
        }]
    });
});
    

		</script>
    <script type="text/javascript">
$(function () {
        $('#typeOfVideo').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'type of video'
            },
            subtitle: {
                text: 'Source: BesTV'
            },
            xAxis: {
                categories: [<?php echo $videoType; ?>],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: ' number',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' '
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: ' types',
                      data: [<?php echo $videoNum; ?>]
            }]
        });
    });


  </script>   




    <script type="text/javascript">
$(function () {
        $('#dashTransTime').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'dash Translation Time'
            },
            subtitle: {
                text: 'Source: BesTV'
            },
            xAxis: {
                categories: [<?php echo $switchTime; ?>],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'change time',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' '
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'horizontal',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'time',
                      data: [<?php echo $switchNum; ?>]
            }]
        });
    });


  </script>   

  <script type="text/javascript">

  $(function () {
    $('#userISP').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'userISP',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: 'userISP',
            innerSize: '50%',
            data: [
           
        <?php echo $userISP; ?>
 ]
        }]
    });
});


  </script>


  <script type="text/javascript">

  $(function () {
    $('#serverISP').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'serverISP',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: 'serverISP',
            innerSize: '50%',
            data: [
          <?php echo $serverISP; ?>           


 ]
        }]
    });
});


  </script>




 <script type="text/javascript">
    // Step:3 conifg ECharts's path, link to echarts.js from current page.
    // Step:3 为模块加载器配置echarts的路径，从当前页面链接到echarts.js，定义所需图表路径
    require.config({
        paths:{ 
            echarts:'./echartjs/echarts',
            'echarts/chart/bar' : './echartjs/echarts-map',
            'echarts/chart/line': './echartjs/echarts-map',
            'echarts/chart/map' : './echartjs/echarts-map',
            'echarts/config':     './echartjs/config'
        }
    });
    
    // Step:4 require echarts and use it in the callback.
    // Step:4 动态加载echarts然后在回调函数中开始使用，注意保持按需加载结构定义图表路径
    require(
        [
            'echarts',
            'echarts/chart/bar',
            'echarts/chart/line',
            'echarts/chart/map'
        ],
        function(ec) {
            
            // --- 地图 ---





            var myChart2 = ec.init(document.getElementById('serverAreas'));
            myChart2.setOption({
          
          title : {
        text: 'serverAreas',
        subtext: 'source:BesTV',
        x:'center'
    },
    tooltip : {
        trigger: 'item'
    },
    legend: {
        orient: 'vertical',
        x:'left',
        data:['accessNumber']
    },
    dataRange: {
        min: <?php echo $smin; ?>,
        max: <?php echo $smax; ?>,
        text:['max','min'],           // 文本，默认为数值文本
        calculable : true,
        textStyle: {
            color: 'orange'
        }
    },
    toolbox: {
        show : true,
        orient : 'vertical',
        x: 'right',
        y: 'center',
        feature : {
            mark : true,
            dataView : {readOnly: false},
            restore : true,
            saveAsImage : true
        }
    },
    series : [
        {
            name: 'accessNumber',
            type: 'map',
            mapType: 'china',
            itemStyle:{
                normal:{label:{show:true}, color:'#ffd700'},// for legend
                emphasis:{label:{show:true}}
            },
            data:[
                  <?php echo $sLocation; ?>         
   ]
        },
    ]


            });

     


            var myChart3 = ec.init(document.getElementById('userAreas'));


            option={
         
          title : {
        text: 'userAreas',
        subtext: 'source:BesTV',
        x:'center'
    },

           tooltip : {
        trigger: 'item1'
    },
    legend: {
        x:'right',
        data:[<?php echo $uName; ?>]
    },
    dataRange: {
        orient: 'horizontal',
        min: <?php echo $umin; ?>,
        max: <?php echo $umax; ?>,
        text:['max','min'],           // 文本，默认为数值文本
        splitNumber:0
    },
    toolbox: {
        show : true,
        orient: 'vertical',
        x:'right',
        y:'center',
        feature : {
            mark : true,
            dataView : {readOnly: false}
        }
    },
    series : [
        {
            name: 'userNumber',
            type: 'map',
            mapType: 'china',
            mapLocation: {
                x: 'left'
            },
            selectedMode : 'multiple',
            itemStyle:{
                normal:{label:{show:true}},
                emphasis:{label:{show:true}}
            },
            data:[
                  <?php echo $uLocation; ?> 
           ]
        },
        {
            name:'各省销量',
            type:'pie',
            tooltip: {
                trigger: 'item1',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            center: [document.getElementById('userAreas').offsetWidth - 250, 225],
            radius: [50, 120],
            data:[
               <?php echo $uSelectedName; ?>
            ]
        }
    ],
    animation: false 








};
myChart3.setOption(option,true);

var ecConfig = require('echarts/config');
myChart3.on(ecConfig.EVENT.MAP_SELECTED, function(param){
    
    var selected = param.selected;
    var mapSeries = option.series[0];
    var data = [];
    var legendData = [];
    var name;
    for (var p = 0, len = mapSeries.data.length; p < len; p++) {
        name = mapSeries.data[p].name;
        mapSeries.data[p].selected = selected[name];
        if (selected[name]) {
            data.push({
                name: name,
                value: mapSeries.data[p].value
            });
            legendData.push(name);
        }
    }
    option.legend.data = legendData;
    option.series[1].data = data;
    myChart3.setOption(option, true);
})
                  






    
        }
    );
    </script>


 
 
		<script type="text/javascript">
			function tab(o, s, cb, ev){ //tab切换类
				var $ = function(o){return document.getElementById(o)};
				var css = o.split((s||'_'));
				if(css.length!=4)return;
				this.event = ev || 'onclick';
				o = $(o);
				if(o){
					this.ITEM = [];
					o.id = css[0];
					var item = o.getElementsByTagName(css[1]);
					var j=1;
					for(var i=0;i<item.length;i++){
						if(item[i].className.indexOf(css[2])>=0 || item[i].className.indexOf(css[3])>=0){
							if(item[i].className == css[2])o['cur'] = item[i];
							item[i].callBack = cb||function(){};
							item[i]['css'] = css;
							item[i]['link'] = o;
							this.ITEM[j] = item[i];
							item[i]['Index'] = j++;
							item[i][this.event] = this.ACTIVE;
						}
					}
					return o;
				}
			}
			tab.prototype = {
				ACTIVE:function(){
					var $ = function(o){return document.getElementById(o)};
					this['link']['cur'].className = this['css'][3];
					this.className = this['css'][2];
					try{
						$(this['link']['id']+'_'+this['link']['cur']['Index']).style.display = 'none';
						$(this['link']['id']+'_'+this['Index']).style.display = 'block';
					}catch(e){}
					this.callBack.call(this);
					this['link']['cur'] = this;
				}
			}
		</script>


		<script src="hsjs/highstock.js"></script>
<script src="hsjs/modules/exporting.js"></script>
<script src="hcjs/highcharts.js"></script>
<script src="hcjs/modules/exporting.js"></script>
</head>

<body >
    
    <!-- *********  Header  ********** -->
    
    <div id="header">
        <div id="header_in">
        
        <h1><a href="main.php"><b>New </b> QoE</a></h1>
        
        <div id="menu">
         <ul>
            <li><a href="main.php" class="active">Home</a></li>
            <li><a href="context.php">Context</a></li>
            <li><a href="load.php">Load</a></li>
            <li><a href="user.php">User</a></li>
             
         </ul>
        </div>
        
        </div>
    </div>
    
    <!-- *********  Main part (slider)  ********** -->
<span id='wrong-message' style="color:red"></span>
	<div style="width:960px;margin:auto;">
        
            <div class="history_blok">
            
            <h3>Summary</h3>
            </br>
                
              
            
        </div>
        
            
       
       <div id="tabStyle" style="height: 600px; min-width: 320px">

         
		<div class="tab2">
			<ul id="test3_li_now_">
				<li class="now">百视通</li>
				<li>蓝讯</li>
				<li>网速</li>
			</ul>
		</div>
		<div>
			<div id="test3_1" class="tablist block">
				<div id="engagement" style="width:915px;height:500px;"></div>
			</div>
			<div id="test3_2" class="tablist">
				<div id="cdn1" style="width:915px;height:500px;"></div>
			</div>
			<div id="test3_3" class="tablist">
				<div id="cdn2" style="width:915px;height:500px;"></div>
			</div>
		</div>
		<script type="text/javascript">
			window.onload = function(){
				new tab('test3_li_now_', '_', function(){
				//	alert('您现在单的是第:'+this['Index']+'个!');
				});
			}
		</script>



</div>

      
	    

      <div id="serverAreas" style="height:500px;min-width:310px"></div>
        
    
        <div id="userAreas" style="height:500px;min-width:310px"></div>
     
   
   <div style="width:450px;float:left">
		<div id="typeOfVideo" style="min-width: 110px; height: 400px; margin: 0 auto"></div>
		</div>
	
		<div style="width:450px;float:left">
		<div id="dashTransTime" style="min-width: 110px; height: 400px; margin: 0 auto"></div>
		</div>
		
<div style="width:450px;float:left">
		<div id="bitRate" style="min-width: 110px; height: 400px; margin: 0 auto"></div>
		</div>
	
		<div style="width:450px;float:left">
		<div id="device" style="min-width: 110px; height: 400px; margin: 0 auto"></div>
		</div>


<div style="width:450px;float:left">
		<div id="userISP" style="min-width: 110px; height: 400px; margin: 0 auto"></div>
		</div>
	
		<div style="width:450px;float:left">
		<div id="serverISP" style="min-width: 110px; height: 400px; margin: 0 auto"></div>
		</div>





  </div>

  
	  
	 
      <div style="width:118px;position:fixed;right:50px;top:220px; ">
        <ul>


          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="windowscrollTo(0,120);return false;">view numbers</a>
          </li>

          <li style="height:32px;">
          <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,620);return false;"    >server areas</a>
          </li>

          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,1220);return false;">user areas</a>
          </li>

          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,1720);return false;">video type</a>
          </li>

          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,1720);return false;">translation</a>
          </li>

          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,2120);return false;">bitRate</a>
          </li>

          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,2120);return false;">device</a>
          </li>

          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,2520);return false;">userISP</a>
          </li>

          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,2520);return false;">serverISP</a>
          </li>

      </ul>
      </ul>

      <div   onclick="window.scrollTo(0,0);return false;"><a href="#"  title="back to top"><img style="width:40px;height:40px"  src ="./img/jiantou2.jpg"></img></a></div>    
  </div>    
		
	  
    
    
    <!-- *********  Footer  ********** -->
    
    <hr class="cleanit">
    
     <div id="footer">
        <div id="footer_in">
            
            <p><a href="www.tsinghua.edu.cn">Tsinghua University</a> Department of Computer Science and Technology</p>
            <span>Author: <a href="http://media.cs.tsinghua.edu.cn/~wangzhi/">Wang Zhi</a> - Zhou Chao </span>

        
        </div>
    </div>
         
    <script>


// script for testimonial' tabs
$(function() {
    $("ul.controls").tabs("div.testimonials > div");
});
window.scrollTo(0,0);


</script>

</body>
</html>
