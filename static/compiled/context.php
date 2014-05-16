

<html>
<head>
    <meta charset="utf-8">
    <title>New QoE</title>
    
<link rel="stylesheet" href="https://ssl.mail.163.com/mimg.127.net/xm/all/qa/css/iframe.css">
    <link rel="stylesheet" href="reset.css" type="text/css">
    <link rel="stylesheet" href="styl.css" type="text/css">
        
	
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="jquery.min.js"></script>

<script src="echartjs/esl.js"></script>


<script type="text/javascript">
//以“@#￥”为分割点，用result变量储存选择的变量
result ="";
selectResult ="<?php echo $reResult; ?>";
userResult ="<?php echo $reUserResult; ?>";
serverResult ="<?php echo $reServerResult; ?>";

//boo 来判断是否第一次选择 0为第一次进入 1为第二次
boo = 1;
//selectVector 传递选择了什么变量
//selectVector =<?php echo $selectVector; ?>;

reResult ="<?php echo $reResult; ?>";
reUserResult ="<?php echo $reUserResult; ?>";
reServerResult ="<?php echo $reServerResult; ?>";


</script>





    <script type="text/javascript">
    
    
      $(document).ready(function(){
       


   seriesOptions = [],
    yAxisOptions = [],
    seriesCounter = 0,
    names = ['0~20%','20~40%','40~60%','60~80%','80~100%'],
    colors = Highcharts.getOptions().colors;

      $.ajax({
            type : "get",
            url : "service/context/userEngagement.php?callback=?&type=2",
            dataType : "jsonp",
            jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
            success : function(data){

      seriesOptions[0] = {
        name: "totalNumber",
        data: data
      };
     
    
     $.each(names, function(i, name) {

      nu=i+3;
    $.getJSON('service/context/userEngagement.php?callback=?&type='+nu, function(data) {

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
            name: 'Users Rate',
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
              ['S7',   <?php echo $s7; ?>],
              ['S6',   <?php echo $s6; ?>],
              ['S5',   <?php echo $s5; ?>],
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
                    text: 'percentage',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' millions'
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
                name: 'percentage of types',
                      data:[<?php echo $videoNum; ?>]
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
                    text: 'percentage',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' millions'
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
                name: 'percentage of types',
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













	

<script>
function show(tag){
 var light=document.getElementById(tag);
 var fade=document.getElementById('fade');
 light.style.display='block';
 fade.style.display='block';


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

      if(tag =="light")
      {
            var myChart3 = ec.init(document.getElementById('userAreas'));
            myChart3.setOption({
                title:{
                    text:'userAreas'

                },


                tooltip : {
                    trigger: 'item',
                    formatter: '{b}'
                },
                series : [
                    {
                        name: '中国',
                        type: 'map',
                        mapType: 'china',
                        selectedMode : 'multiple',
                        itemStyle:{
                            normal:{label:{show:true}},
                            emphasis:{label:{show:true}}
                        },
                        data:[
                            
                        ]
                    }
                ]
            });
            
            var ecConfig = require('echarts/config');
            myChart3.on(ecConfig.EVENT.MAP_SELECTED, function(param){
                var selected = param.selected;
                var str = ' ';
               for (var p in selected) {
                   if (selected[p]) {
                     str += p + ' ';
                     }
                   }
                   userResult = str;
                 document.getElementById('userCount').innerHTML = str;
                })

        }

        else if(tag == "light2")
      {
            var myChart2 = ec.init(document.getElementById('serverAreas'));
            myChart2.setOption({

                title:{
                    text:'serverAreas'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: '{b}'
                },
                series : [
                    {
                        name: '中国',
                        type: 'map',
                        mapType: 'china',
                        selectedMode : 'multiple',
                        itemStyle:{
                            normal:{label:{show:true}},
                            emphasis:{label:{show:true}}
                        },
                        data:[
                          
                        ]
                    }
                ]
            });

            
            var ecConfig = require('echarts/config');
            myChart2.on(ecConfig.EVENT.MAP_SELECTED, function(param){
                var selected = param.selected;
                var str = ' ';
               for (var p in selected) {
                   if (selected[p]) {
                     str += p + ' ';
                     }
                   }
                   serverResult = str;
                 document.getElementById('serverCount').innerHTML = str;
                })
        }

         
        }
    );



 }
function hide(tag){
 var light=document.getElementById(tag);
 var fade=document.getElementById('fade');


if(tag =="light2")
{
  if(document.getElementById('serverCount').innerHTML ==null)
        document.getElementById('serverCount').innerHTML = "";

       serverResult =   document.getElementById('serverCount').innerHTML ;
        document.getElementById('serverPlaces').innerHTML = document.getElementById('serverCount').innerHTML;

        
        document.getElementById('serverCount').innerHTML = "";
}
if( tag =="light")
{

  if(document.getElementById('userCount').innerHTML ==null)
  document.getElementById('userCount').innerHTML = "";

  
       userResult= document.getElementById('userCount').innerHTML;
document.getElementById('userPlaces').innerHTML = document.getElementById('userCount').innerHTML ;

document.getElementById('userCount').innerHTML = "";
}
 light.style.display='none';
 fade.style.display='none';
}
</script>	

</head>

<body >
    
    <!-- *********  Header  ********** -->
    
     <div id="header">
        <div id="header_in">
        
           <h1><a href="main.php"><b>New </b> QoE</a></h1>
        
         <div id="menu">
         <ul>
            <li><a href="main.php" >Home</a></li>
            <li><a href="context.php" class="active">Context</a></li>
            <li><a href="load.php">Load</a></li>            
            <li><a href="user.php">User</a></li>            
            <li><a href="switch.php">Switch</a></li>
         </ul>
        </div>
        
        </div>
    </div>
    
    <!-- *********  Main part – headline ********** -->
    
        
        <div id="main_part_inner">
            <div id="main_part_inner_in">
        
            <h2>Context</h2>
            
            
            
            </div>
            
        </div>
        
        
        <!-- *********  Content  ********** -->
        <div style="width:16%;float:left;margin:10px 5px 15px 20px">


	</div>

<div style="width:960px;margin:auto;">
<div id="filter" class="filter">
        <dl>
            <dt>device:</dt>
            <dd><div><a>all</a></div></dd>
            <dd><div><a>iPad</a></div></dd>
            <dd><div><a>iPhone</a></div></dd>
            <dd><div><a>PC</a></div></dd>
            <dd><div><a>TV</a></div></dd>
            <dd><div><a>other</a></div></dd>
        </dl>
       
        <dl>
            <dt>video types:</dt>
            <dd><div><a>all</a></div></dd>
            <dd><div><a>movie</a></div></dd>
            <dd><div><a>children</a></div></dd>
            <dd><div><a>documentary</a></div></dd>
            <dd><div><a>fun</a></div></dd>
            <dd><div><a>music</a></div></dd>
            <dd><div><a>news</a></div></dd>
            <dd><div><a>series</a></div></dd>
            <dd style="margin-left:150px"><div><a>sports</a></div></dd>
            <dd><div><a>others</a></div></dd>
          </dl>
       
        <dl>
            <dt>bitRate:</dt>
            <dd><div><a>all</a></div></dd>
            <dd><div><a>s1</a></div></dd>
            <dd><div><a>s2</a></div></dd>
            <dd><div><a>s3</a></div></dd>
            <dd><div><a>s4</a></div></dd>
            <dd><div><a>s5</a></div></dd>
            <dd><div><a>s6</a></div></dd>
            <dd><div><a>s7</a></div></dd>
        </dl>
        <dl>
            <dt>translation time:</dt>
            <dd><div><a>all</a></div></dd>
            <dd><div><a>0</a></div></dd>
            <dd><div><a>1</a></div></dd>
            <dd><div><a>2</a></div></dd>
            <dd><div><a>3</a></div></dd>
            <dd><div><a>4</a></div></dd>
            <dd><div><a>5</a></div></dd>
            <dd><div><a>6</a></div></dd>
          </dl>
        <dl>
            <dt>userISP:</dt>
            <dd><div><a>all</a></div></dd>
            <dd><div><a>电信</a></div></dd>
            <dd><div><a>联通</a></div></dd>
            <dd><div><a>移动</a></div></dd>
            <dd><div><a>铁通</a></div></dd>
            <dd><div><a>其他</a></div></dd>
          </dl>
        <dl>
            <dt>serverISP:</dt>
            <dd><div><a>all</a></div></dd>
            <dd><div><a>电信</a></div></dd>
            <dd><div><a>联通</a></div></dd>
            <dd><div><a>移动</a></div></dd>
            <dd><div><a>其他</a></div></dd>
          </dl>
      </div>
      </br>
      </br>

      <div style="width:620px;height:auto;margin-left:auto;margin-right:auto;font-size:18px;">
      
<a style="font-weight:bold;color:#333333;float:left;width:150px" href="javascript:void(0)" onclick="show('light')">user areas:</a>
<div id="userPlaces" style="float:left;width:470px;"> </div>
</div>
</br>
</br>
	
      <div style="width:620px;height:auto;margin-left:auto;margin-right:auto;font-size:18px;">
      
<a style="font-weight:bold;color:#333333;width:150px;float:left;" href="javascript:void(0)" onclick="show('light2')">server areas:</a>
<div id="serverPlaces" style="float:left;width:470px;"></div>
</div>


<div id="light" class="white_content">
      <div class="close"><a href="javascript:void(0)" onclick="hide('light')"> 关闭</a></div>
      <div class="con"> 
      <div id="userCount"></div>   
       <div id="userAreas" style="height:500px;min-width:310px"></div>
        
    

   </div>
</div>
<div id="light2" class="white_content">
      <div class="close"><a href="javascript:void(0)" onclick="hide('light2')"> 关闭</a></div>
      <div class="con"> 

        <div id="serverCount"></div>
        <div id="serverAreas" style="height:500px;min-width:310px"></div> 
      </div>
</div>
<div id="fade" class="black_overlay"></div>

</br>
</br>
</br>

<div style=" text-align:center;">
  <form action="context.php" method="post" class="formit" onsubmit="return check()">
    <input id ="selectResult" name="selectResult"  style="display:none"></input>
    <input id ="userResult" name="userResult"  style="display:none"></input>
    <input id = "serverResult" name="serverResult"  style = "display:none"></input>


    <input type="submit" class="button_submit" value ="submit"/>
    </form>
    </br>
    <div>
      <input type="submit" class="button_snapshot" onclick="snapshot()" value="snapshot"></input>
      </div>
    <div>此页面加载时间较长，请耐心等待...
      </div>
</div>

	
		
		
       <div id="engagement" style="height: 500px; min-width: 310px"></div>

      
   
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


    











</div>



      <div style="width:118px;position:fixed;right:50px;top:280px; ">
        <ul>

          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,520);return false;">view numbers</a>
          </li>


          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,1020);return false;">video type</a>
          </li>

          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,1020);return false;">translation</a>
          </li>

          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,1520);return false;">bitRate</a>
          </li>

          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,1520);return false;">device</a>
          </li>


          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,2020);return false;">userISP</a>
          </li>

          <li style="height:32px;">
            <a style="text-decoration:none;font-size:16px; color:#C4C6C9" href="#" onclick="window.scrollTo(0,2020);return false;">serverISP</a>
          </li>


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



         

</body>





























<script type="text/javascript">
    $(function () {
        //选中filter下的所有a标签，为其添加hover方法，该方法有两个参数，分别是鼠标移上和移开所执行的函数。
        $("#filter a").hover(
            function () {
                $(this).addClass("seling");
            },
            function () {
                $(this).removeClass("seling");
            }
        );


        //选中filter下所有的dt标签，并且为dt标签后面的第一个dd标签下的a标签添加样式seled。(感叹jquery的强大)
        $("#filter dt+dd a").attr("class", "seled"); /*注意：这儿应该是设置(attr)样式，而不是添加样式(addClass)，
                                                    不然后面通过$("#filter a[class='seled']")访问不到class样式为seled的a标签。*/       
        //为filter下的所有a标签添加单击事件
        $("#filter a").click(function () {
            $(this).parents("dl").children("dd").each(function () {
        //下面三种方式效果相同（第三种写法的内部就是调用了find()函数，所以，第二、三种方法是等价的。）
                //$(this).children("div").children("a").removeClass("seled");
        //$(this).find("a").removeClass("seled");
        $('a',this).removeClass("seled");
            });

            $(this).attr("class", "seled");

            RetSelecteds(); //返回选中结果   弹出
        });
      //  alert(RetSelecteds()); //返回选中结果   弹出
    });

    function RetSelecteds() {

      selectResult = "";
      result =""; 
        $("#filter a[class='seled']").each(function () {
            result += $(this).html()+" ";
        });
        selectResult = result;
    }
</script>

		
		<script src="hsjs/highstock.js"></script>
<script src="hsjs/modules/exporting.js"></script>
<script src="hcjs/highcharts.js"></script>
<script src="hcjs/modules/exporting.js"></script>


<script type="text/javascript">

  $(document).ready(function(){
  var words = reResult.split(" ");

if( words.length > 1)
{

var count = 0;
        //为filter下的所有a标签修改已经选择的状态
        $("#filter dl").each(function () {


          $(this).find("a").each(function(){
              if(words[count] == $(this).html())
              {
                    $(this).parents("dl").children("dd").each(function () {
                      $('a',this).removeClass("seled");
                     });

                     $(this).attr("class", "seled");
               }


            });

            count=count+1; 
        });
}
});

  $("#userPlaces").html(reUserResult);
  $("#serverPlaces").html(reServerResult);

  function check()
{
  $("#selectResult").val(selectResult);
    $("#userResult").val(userResult);
   $("#serverResult").val(serverResult);

   //alert($("#selectResult").val()); 

    return true;


}


</script>
<script>
  function snapshot(){

    window.open("contextSnapshot.php");
  }

</script>
</html>
