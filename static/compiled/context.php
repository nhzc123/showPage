

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
selectResult ="";
userResult ="";
serverResult ="";
myChart1="";
myChart2="";
myChart3="";
myChart5="";
myChart4="";
myChart6="";


$(document).ready(function(){ 
   

        require.config({
            paths:{ 
                'echarts' : './echartjs/echarts',
                'echarts/chart/bar' : './echartjs/echarts-map'
            }
        });
        
        // 使用
        require(
            [
                'echarts',
                'echarts/chart/bar' // 使用柱状图就加载bar模块，按需加载
            ],
            function(ec) {
                // 基于准备好的dom，初始化echarts图表
                 myChart1 = ec.init(document.getElementById('typeOfVideo')); 

                myChart2 = ec.init(document.getElementById('dashTransTime')); 

                 myChart3 = ec.init(document.getElementById('bitRate')); 

                 myChart4 = ec.init(document.getElementById('device')); 


                 myChart5 = ec.init(document.getElementById('userISP')); 

                 myChart6 = ec.init(document.getElementById('serverISP')); 
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
            var myChartt = ec.init(document.getElementById('userAreas'));

                    myChartt.clear(); 
            myChartt.setOption({
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
            myChartt.on(ecConfig.EVENT.MAP_SELECTED, function(param){
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
            var myChartl = ec.init(document.getElementById('serverAreas'));

                    myChartl.clear(); 
            myChartl.setOption({

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
            myChartl.on(ecConfig.EVENT.MAP_SELECTED, function(param){
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
            <li><a href="bitRateType.php">BitRate</a></li>
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
            <dd><div><a>Android Pad 7</a></div></dd>
            <dd><div><a>Android Phone</a></div></dd>
            <dd><div><a>iPhone</a></div></dd>
            <dd><div><a>Ctv</a></div></dd>
            <dd><div><a>Ott Stb</a></div></dd>
            <dd style="margin-left:150px"><div><a>PC</a></div></dd>
            <dd><div><a>Tbd</a></div></dd>
            <dd><div><a>TV Cloud</a></div></dd>
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
    <input id ="selectResult" name="selectResult"  style="display:none"></input>
    <input id ="userResult" name="userResult"  style="display:none"></input>
    <input id = "serverResult" name="serverResult"  style = "display:none"></input>


    <input type="submit" class="button_snapshot" onclick="getOK()" value ="submit"/>
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
            result += $(this).html()+",";
        });
        selectResult = result;
    }
</script>

		
		<script src="hsjs/highstock.js"></script>
<script src="hsjs/modules/exporting.js"></script>
<script src="hcjs/highcharts.js"></script>
<script src="hcjs/modules/exporting.js"></script>


<script type="text/javascript">



</script>
<script>
  function snapshot(){

    window.open("static/template/contextSnapshot.htm");
  }

</script>

<script>

  function getOK(){

    if(selectResult=="")
        selectResult="all,all,all,all,all,all";

    if(userResult=="")
        userResult="all";

    if(serverResult=="")
        serverResult="all";


                    myChart1.clear(); 
                    myChart2.clear(); 
                    myChart3.clear(); 
                    myChart4.clear(); 
                    myChart5.clear(); 
                    myChart6.clear(); 
                    myChart1.showLoading();
                    myChart2.showLoading();
                    myChart3.showLoading();
                    myChart4.showLoading();
                    myChart5.showLoading();
                    myChart6.showLoading();
    var chart = new Highcharts.Chart({chart: {

              renderTo: 'engagement',
                      defaultSeriesType: 'column'
                      },});
    chart.showLoading();


//typeOfVideo------------
typeOfVideoData="";

      $.ajax({
            type : "post",
            url : "service/context/typeOfVideo.php?callback=?",
            data:{

              selectResult:selectResult,
              userResult:userResult,
              serverResult:serverResult,
            },
            dataType : "jsonp",
            jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
            success : function(data){

              typeOfVideoData=data;
          
option = {
    title : {
        text: 'typeOfVideo',
        subtext: 'BesTV'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['typeOfVideo']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType: {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'value',
            boundaryGap : [0, 0.01]
        }
    ],
    yAxis : [
        {
            type : 'category',
            data :data.videoType
        }
    ],
    series : [
        {
            name:'typeOfVideo',
            type:'bar',
            data:data.videoNum
        },
       
    ]
};
                    







                myChart1.hideLoading();
                // 为echarts对象加载数据 
                myChart1.setOption(option); 








            }
          });
//----------------------

//dashTransTime------------
dashTransTimeData="";

      $.ajax({
            type : "post",
            url : "service/context/dashTransTime.php?callback=?",
            data:{

              selectResult:selectResult,
              userResult:userResult,
              serverResult:serverResult,
            },
            dataType : "jsonp",
            jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
            success : function(data){

              dashTransTimeData=data;
          
option = {
    title : {
        text: 'dashTransTime',
        subtext: 'BesTV'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['dashTransTime']
    },
    color:[ '#87cefa'],
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType: {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'value',
            boundaryGap : [0, 0.01]
        }
    ],
    yAxis : [
        {
            type : 'category',
            data :data.switchTime
        }
    ],
    series : [
        {
            name:'dashTransTime',
            type:'bar',
            data:data.switchNum
        },
       
    ]
};
                    






                myChart2.hideLoading();
                // 为echarts对象加载数据 
                myChart2.setOption(option); 








            }
          });
//----------------------


//bitRate------------
bitRateData="";

      $.ajax({
            type : "post",
            url : "service/context/bitRate.php?callback=?",
            data:{

              selectResult:selectResult,
              userResult:userResult,
              serverResult:serverResult,
            },
            dataType : "jsonp",
            jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
            success : function(data){

              bitRateData=data;
                     
          
option = {
    title : {
        text: 'bitRate',
        subtext: 'BesTV',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient : 'vertical',
        x : 'left',
        data:['s1','s2','s3','s4','s5','s6','s7']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
            name:'访问来源',
            type:'pie',
            radius : '55%',
            center: ['50%', 225],
                data:bitRateData.bitRateArray
        }
    ]
};
                     






                myChart3.hideLoading();
                // 为echarts对象加载数据 
                myChart3.setOption(option); 







            }
          });
//----------------------


//device------------
deviceData="";

      $.ajax({
            type : "post",
            url : "service/context/device.php?callback=?",
            data:{

              selectResult:selectResult,
              userResult:userResult,
              serverResult:serverResult,
            },
            dataType : "jsonp",
            jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
            success : function(data){

              deviceData=data;
          
option = {
    title : {
        text: 'device',
        subtext: 'BesTV',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient : 'vertical',
        x : 'left',
        data:deviceData.name
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
            name:'访问来源',
            type:'pie',
            radius : '55%',
            center: ['50%', 225],
            data:deviceData.deviceValue
        }
    ]
};
                     






                myChart4.hideLoading();
                // 为echarts对象加载数据 
                myChart4.setOption(option); 








            }
          });
//----------------------



//userISP------------
userISPData="";

      $.ajax({
            type : "post",
            url : "service/context/userISP.php?callback=?",
            data:{

              selectResult:selectResult,
              userResult:userResult,
              serverResult:serverResult,
            },
            dataType : "jsonp",
            jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
            success : function(data){

              userISPData=data;
                     
          
option = {

    title : {
        text: 'userISP',
        subtext: 'BesTV',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient : 'vertical',
        x : 'left',
        data:userISPData.name
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
            name:'访问来源',
            type:'pie',
            radius : ['50%', '70%'],
            itemStyle : {
                normal : {
                    label : {
                        show : false
                    },
                    labelLine : {
                        show : false
                    }
                },
                emphasis : {
                    label : {
                        show : true,
                        position : 'center',
                        textStyle : {
                            fontSize : '30',
                            fontWeight : 'bold'
                        }
                    }
                }
            },
            data:userISPData.value
        }
    ]
};
                    




                myChart5.hideLoading();
                // 为echarts对象加载数据 
                myChart5.setOption(option); 








            }
          });
//----------------------




//serverISP------------
serverISPData="";

      $.ajax({
            type : "post",
            url : "service/context/serverISP.php?callback=?",
            data:{

              selectResult:selectResult,
              userResult:userResult,
              serverResult:serverResult,
            },
            dataType : "jsonp",
            jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
            success : function(data){

              serverISPData=data;
                     
          
option = {

    title : {
        text: 'serverISP',
        subtext: 'BesTV',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient : 'vertical',
        x : 'left',
        data:serverISPData.name
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
            name:'访问来源',
            type:'pie',
            radius : ['50%', '70%'],
            itemStyle : {
                normal : {
                    label : {
                        show : false
                    },
                    labelLine : {
                        show : false
                    }
                },
                emphasis : {
                    label : {
                        show : true,
                        position : 'center',
                        textStyle : {
                            fontSize : '30',
                            fontWeight : 'bold'
                        }
                    }
                }
            },
            data:serverISPData.value
        }
    ]
};
                    




                myChart6.hideLoading();
                // 为echarts对象加载数据 
                myChart6.setOption(option); 








            }
          });
//----------------------






//engagement----------
   seriesOptions = [],
    yAxisOptions = [],
    seriesCounter = 0,
    names = ['0~20%','20~40%','40~60%','60~80%','80~100%'],
    colors = Highcharts.getOptions().colors;





//engagement----------
   seriesOptions = [],
    yAxisOptions = [],
    seriesCounter = 0,
    names = ['0~20%','20~40%','40~60%','60~80%','80~100%'],
    colors = Highcharts.getOptions().colors;


      $.ajax({
            type : "post",
            url : "service/context/userEngagement.php?callback=?&type=2",
            data:{

              selectResult:selectResult,
              userResult:userResult,
              serverResult:serverResult,
            },
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
//-----------------------


  }

</script>
</html>
