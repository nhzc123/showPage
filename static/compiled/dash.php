

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
        
           <h1><a href="main.php"><b>New </b> QoE</a></h1>
        
         <div id="menu">
         <ul>
            <li><a href="main.php" >Home</a></li>
            <li><a href="user.php" >Context</a></li>
            <li><a href="dash.php" class="active">Dash</a></li>                
         </ul>
        </div>
        
        </div>
    </div>
    
    <!-- *********  Main part – headline ********** -->
    
        
        <div id="main_part_inner">
            <div id="main_part_inner_in">
        
            <h2>User Behaviour</h2>
            
            
            
            </div>
            
        </div>
        
        
        <!-- *********  Content  ********** -->
        <div style="width:16%;float:left;margin:10px 5px 15px 20px">


	</div>

<div id="filter">
        <dl>
            <dt>品牌：</dt>
            <dd><div><a>全部</a></div></dd>
            <dd><div><a>惠普(hp)</a></div></dd>
            <dd><div><a>联想(Lenovo)</a></div></dd>
            <dd><div><a>联想(ThinkPad)</a></div></dd>
            <dd><div><a>宏基(acer)</a></div></dd>
            <dd><div><a>华硕</a></div></dd>
            <dd><div><a>戴尔</a></div></dd>
            <dd><div><a>三星</a></div></dd>
            <dd><div><a>索尼</a></div></dd>
            <dd><div><a>东芝</a></div></dd>
            <dd><div><a>Gateway</a></div></dd>
            <dd><div><a>微星</a></div></dd>
            <dd><div><a>海尔</a></div></dd>
            <dd><div><a>清华同方</a></div></dd>
            <dd><div><a>富士通</a></div></dd>
            <dd><div><a>苹果(Apple)</a></div></dd>
            <dd><div><a>神舟</a></div></dd>
            <dd><div><a>方正</a></div></dd>
            <dd><div><a>优雅</a></div></dd>
        </dl>
        <dl>
            <dt>价格：</dt>
            <dd><div><a>全部</a></div></dd>
            <dd><div><a>1000-2999</a></div></dd>
            <dd><div><a>3000-3499</a></div></dd>
            <dd><div><a>3500-3999</a></div></dd>
            <dd><div><a>4000-4499</a></div></dd>
            <dd><div><a>4500-4999</a></div></dd>
            <dd><div><a>5000-5999</a></div></dd>
            <dd><div><a>6000-6999</a></div></dd>
            <dd><div><a>7000-9999</a></div></dd>
            <dd><div><a>10000以上</a></div></dd>
        </dl>
        <dl>
            <dt>尺寸：</dt>
            <dd><div><a>全部</a></div></dd>
            <dd><div><a>8.9英寸及以下</a></div></dd>
            <dd><div><a>11英寸</a></div></dd>
            <dd><div><a>12英寸</a></div></dd>
            <dd><div><a>13英寸</a></div></dd>
            <dd><div><a>14英寸</a></div></dd>
            <dd><div><a>15英寸</a></div></dd>
            <dd><div><a>16英寸-17英寸</a></div></dd>
        </dl>
        <dl>
            <dt>平台：</dt>
            <dd><div><a>全部</a></div></dd>
            <dd><div><a>AMD Brazos APU平台</a></div></dd>
            <dd><div><a>Intel Sandy Bridge平台</a></div></dd>
            <dd><div><a>Intel平台</a></div></dd>
            <dd><div><a>AMD平台</a></div></dd>
        </dl>
        <dl>
            <dt>显卡：</dt>
            <dd><div><a>全部</a></div></dd>
            <dd><div><a>独立显卡</a></div></dd>
            <dd><div><a>集成显卡</a></div></dd>
            <dd><div><a>核芯显卡</a></div></dd>            
        </dl>
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

            alert(RetSelecteds()); //返回选中结果   弹出
        });
      //  alert(RetSelecteds()); //返回选中结果   弹出
    });

    function RetSelecteds() {
        var result = "";
        $("#filter a[class='seled']").each(function () {
            result += $(this).html()+"\n";
        });
        return result;
    }
</script>

		
		<script src="hsjs/highstock.js"></script>
<script src="hsjs/modules/exporting.js"></script>
<script src="hcjs/highcharts.js"></script>
<script src="hcjs/modules/exporting.js"></script>


</html>
