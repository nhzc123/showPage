

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
<script language="javascript" type="text/javascript" src = "WdatePicker.js"></script>


<script >
//全局变量
areas ="";
allData=="";
</script>

  

<script>


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

            var myChart3 = ec.init(document.getElementById('cdnAreas'));
            myChart3.setOption({
          title : {
        text: 'cdnAreas',
        subtext: 'source:BesTV',
        x:'center'
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


                tooltip : {
                    trigger: 'item',
                    formatter: '{b}'
                },
                series : [
                    {
                        name: '中国',
                        type: 'map',
                        mapType: 'china',
                        selectedMode : 'single',
                        itemStyle:{
                            normal:{label:{show:true}},
                            emphasis:{label:{show:true}}
                        },
                        data:[
                        <?php echo $sLocation; ?> 
                        ]
                    }
                ]
            });
            
            var ecConfig = require('echarts/config');
            myChart3.on(ecConfig.EVENT.MAP_SELECTED, function(param){
                var selected = param.selected;
                var str = '';
               for (var p in selected) {
                   if (selected[p]) {
                     str += p;

                     }
                   }
                   areas = str;

      $.ajax({
            type : "post",
            async:true,
            dataType:'json',
            data:{
                  areas:str,
                  type:1,


            },   
            url : "service/load/getCdnState.php",
            success : function(data){
              allData=data; 
              ispCount="";
              $("#ispSelected").empty();
              $("#nameSelected").empty();
              flag = 0;
              //alert(data.dataList[0].cdnISP); 
              $.each(data.dataList,function(i,item){

                    if(ispCount.match(item.cdnISP)==null)
                      
                        {
             //             alert(item.cdnISP);
                          ispCount=ispCount+item.cdnISP;
                          $("#ispSelected").append("<option value=\'"+item.cdnISP+"\'>"+item.cdnISP+"</option>");
                          flag = 1;
                      }


                    //      $("#nameSelected").append("<option value=\'"+item.cdnName+"\'>"+item.cdnName+"</option>");

                    });

              if(flag ==1 )
              {
                 $("#ispSelected").append("<option value=\'all\' selected=\"selected\">all</option>");
                 $("#nameSelected").append("<option value=\'all\' selected=\"selected\">all</option>");
              }

            }});
                })

         
        }
    );



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
            <li><a href="context.php" >Context</a></li>
            <li><a href="load.php" class="active">Load</a></li>            
            <li><a href="user.php" >User</a></li>
            <li><a href="switch.php">Switch</a></li>
         </ul>
        </div>
        
        </div>
    </div>
    
    <!-- *********  Main part – headline ********** -->
    
        
        <div id="main_part_inner">
            <div id="main_part_inner_in">
        
            <h2>Load</h2>
            
            
            
            </div>
            
        </div>
        
        
        <!-- *********  Content  ********** -->
        <div style="width:16%;float:left;margin:10px 5px 15px 20px">


  </div>

<div style="width:960px;margin:auto;">
      </br>



      <div id="cdnAreas" style="height:500px;mid-width:310px">
        </div>



<div class="filter block">
      <div class="filter-label">
        filter
      </div>
      <div  class="filter-item" >
        ISP：
        <select id="ispSelected" onchange="selectISP()">
        </select>
      </div>
      <div  class="filter-item">
        serverName：
        <select id="nameSelected">
        </select>
      </div>
      <div class="filter-item">
        time：
        <input class="Wdate" id="today" type="text" onclick="WdatePicker() ">
      </div>

      <div id="timeSelected">

        </div>
      <div class="filter-submit">
        <button onclick="getOK()">
          ok
        </button>
      </div>
      <div class="filter-submit">
        <button onclick="snapshot()">
          snapshot
        </button>
      </div>
    </div>



      
      <div id="main" style="height:700px;mid-width:310px">
        </div>













    
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























    
    <script src="hsjs/highstock.js"></script>
<script src="hsjs/modules/exporting.js"></script>
<script src="hcjs/highcharts.js"></script>
<script src="hcjs/modules/exporting.js"></script>
<script >

function selectISP()
{
  
  var ispValue = $("#ispSelected").val();
  
  $("#nameSelected").empty();
  
  $.each(allData.dataList,function(i,item){

       // if(ispValue ==  "all")
        //  {
        //      $("#nameSelected").append("<option value=\'"+item.cdnName+"\'>"+item.cdnName+"</option>");
        //  }

        if(ispValue == item.cdnISP)
        {

              $("#nameSelected").append("<option value=\'"+item.cdnName+"\'>"+item.cdnName+"</option>");
        }

        })

  $("#nameSelected").append("<option value=\'all\' selected=\"selected\">all</option>");

}
</script>

<script>

function getOK(){

  var time = $("#today").val();
  
  if(time =="")
    {
        alert("you need to select timestamp.");
        return ;

      }

      var ispPost = $("#ispSelected").val();
      var namePost = $("#nameSelected").val();
  if(namePost==null)
  {
        alert("No cdn selected.");
        return ;
  }
      
    seriesOptions = [],
    yAxisOptions = [],
    seriesCounter = 0,
    names = ['0~20%','20~40%','40~60%','60~80%','80~100%','dash','no dash'],
    colors = Highcharts.getOptions().colors;

      $.ajax({
            type : "post",
            async:false,
            data:{
              areas:areas,
              isp:ispPost,
              name:namePost,
              time:time,

            },
            url : "service/load/loadEngagement.php?callback=?&type=2",
            dataType : "jsonp",
            jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
            success : function(data){

      seriesOptions[0] = {
        name: "totalNumber",
        data: data
      };
     
    
     $.each(names, function(i, name) {

      nu=i+3;
    $.getJSON('service/load/loadEngagement.php?callback=?&type='+nu, function(data) {

      if(i==5){
        seriesOptions[6]={

            type: 'column',
            name: 's1Dash',
            data: data.s1DashLoad,
            yAxis: 1,
          };
        seriesOptions[7]={

            type: 'column',
            name: 's2Dash',
            data: data.s2DashLoad,
            yAxis: 1,
          };
        seriesOptions[8]={

            type: 'column',
            name: 's3Dash',
            data: data.s3DashLoad,
            yAxis: 1,
          };
        seriesOptions[9]={

            type: 'column',
            name: 's4Dash',
            data: data.s4DashLoad,
            yAxis: 1,
          };
        seriesOptions[10]={

            type: 'column',
            name: 's5Dash',
            data: data.s5DashLoad,
            yAxis: 1,
          };
        seriesOptions[11]={

            type: 'column',
            name: 's6Dash',
            data: data.s6DashLoad,
            yAxis: 1,
          };
        seriesOptions[12]={

            type: 'column',
            name: 's7Dash',
            data: data.s7DashLoad,
            yAxis: 1,
          };
        seriesOptions[13]={

            type: 'column',
            name: 'otherDash',
            data: data.oDashLoad,
            yAxis: 1,
          };
        }
        else if (i==6){

          seriesOptions[14]={
          
            type: 'column',
            name: 's1NoDash',
            data: data.s1OtherLoad,
            yAxis: 2,
            }
          seriesOptions[15]={
          
            type: 'column',
            name: 's2NoDash',
            data: data.s2OtherLoad,
            yAxis: 2,
            }
          seriesOptions[16]={
          
            type: 'column',
            name: 's3NoDash',
            data: data.s3OtherLoad,
            yAxis: 2,
            }
          seriesOptions[17]={
          
            type: 'column',
            name: 's4NoDash',
            data: data.s4OtherLoad,
            yAxis: 2,
            }
          seriesOptions[18]={
          
            type: 'column',
            name: 's5NoDash',
            data: data.s5OtherLoad,
            yAxis: 2,
            }
          seriesOptions[19]={
          
            type: 'column',
            name: 's6NoDash',
            data: data.s6OtherLoad,
            yAxis: 2,
            }
          seriesOptions[20]={
          
            type: 'column',
            name: 's7NoDash',
            data: data.s7OtherLoad,
            yAxis: 2,
            }
          seriesOptions[21]={
          
            type: 'column',
            name: 'otherNoDash',
            data: data.oOtherLoad,
            yAxis: 2,
            }

        }
      
        else{
      seriesOptions[i+1] = {
        name: name,
        data: data
      };
    }

      // As we're loading the data asynchronously, we don't know what order it will arrive. So
      // we keep a counter and create the chart when all the data is loaded.
      seriesCounter++;

      if (seriesCounter == names.length) {
        createChart();
       // testwin=1;
      }
    });
  }); 
 

            }});
//开始查询其他三条曲线，已经由第一个ajax请求完毕


function createChart(){



    $('#main').highcharts('StockChart', {
        chart: {
        },

        
        rangeSelector: {
        inputEnabled: $('#main').width() > 480,
            selected: 1
        },

        title: {
            text: 'server load'
        },

        yAxis: [{
            title: {
                text: 'engagement'
            },
            height: 160,
            lineWidth: 2
        }, {
            title: {
                text: 'dash'
            },
            top: 248,
            height: 160,
            offset: 0,
            lineWidth: 2
        },{
            title:{
                text:'no dash'
            },
            top:418,
            height:160,
            offset:0,
            lineWidth:2
        
        }],
        plotOptions: {
                column: {
                    stacking: 'normal',
                }
            },  
        series: seriesOptions
    });


}


}

</script>


<script>

  function selectTime(){

  $("#timeSelected").html("HH");    

  }








</script>

<script>

  function snapshot(){
    
        window.open("static/template/loadSnapshot.htm"); 

  }

</script>

</html>
