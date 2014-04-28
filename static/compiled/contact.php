<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>New QoE</title>
    
    <script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
    
    <link rel="stylesheet" href="reset.css" type="text/css">
    <link rel="stylesheet" href="styl.css" type="text/css">
        
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

</head>

<body>
    
    <!-- *********  Header  ********** -->
    
     <div id="header">
        <div id="header_in">
        
            <h1><a href="index.php"><b>New </b> QoE</a></h1>
        
         <div id="menu">
         <ul>
            <li><a href="index.php" >Home</a></li>
            <li><a href="user.php">User</a></li>
            <li><a href="content.php">content</a></li>
           
            <li><a href="contact.php" class="active">Contact</a></li>            
         </ul>
        </div>
        
        </div>
    </div>
    
    <!-- *********  Main part – headline ********** -->
    
        
        <div id="main_part_inner">
            <div id="main_part_inner_in">
        
            <h2>Contact</h2>
            
            <div class="button_main">
               
            </div>
            
            </div>
            
        </div>
        
        
        <!-- *********  Content  ********** -->
        
        <div id="content_inner">
            
            <!-- *** contact form *** -->
            
           <h3>Leave a message</h3>
           
           <form action="#" method="post" class="formit">
                <input type="text" name="name" placeholder="YOUR NAME"/>
                <input type="text" name="email" placeholder="EMAIL"/>
                <input type="text" name="url" placeholder="WEBSITE (OPTIONAL)"/>
                <textarea name="message" placeholder="Leave your message here..."></textarea>
                <input type="submit" class="button_submit" value="SEND A MESSAGE">
            </form>

            <div class="cara"></div>
            
            <h3>Contact information</h3>
            
            <div class="contactinfo">
                <span class="ico_mapmark"><b> Tsinghua University Beijing 100084, China</b></span>    
            </div>
            
            <div class="contactinfo">
                <span class="ico_message"><b>wangzhi04@mails.tsinghua.edu.cn</b></span>    
            </div>
            
            <div class="contactinfo">
                <span class="ico_iphone"><b>+86-10-62772099 </b></span>    
            </div>
            
            <hr class="cleanit">
            
            
            
            
            
            
            
            
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
</script>

</body>
</html>
