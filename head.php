<style>

.head {
    margin: 0;
    padding: 0;
    word-break: break-all;
    font-family: Microsoft YaHei,tahoma,arial,Hiragino Sans GB,\\5b8b\4f53,sans-serif;
}
.div {
    display: block;
}
body {
    color: #5c5c5c;
    text-decoration: none;
    font-size: 12px;
    word-break: normal;
    width: 100%;
    min-width: 1200px;
    max-width: 1920px;
    margin: 0 auto;
    font-family: Microsoft YaHei,tahoma,arial,Hiragino Sans GB,\\5b8b\4f53,sans-serif;
}
.fixed { 
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 8;
}       
.wrap, .shopdw {
    width: 1200px;
    margin: 0 auto;
}
.main_left {
    float: left;
    margin-top: 13px;
    vertical-align: middle;
}
a {
    text-decoration: none;
    color: #5C5C5C;
}
a:-webkit-any-link {
    color: -webkit-link;
    cursor: pointer;
    text-decoration: underline;
}
img {
    border: 0;
}
img, input, select {
    vertical-align: middle;
}
.main_right {
    float: right;
    height: 80px;
    line-height: 80px;
}
li {
    display: list-item;
    text-align: -webkit-match-parent;
}
li, ul {
    list-style: none outside;
}
ul, menu, dir {
    display: block;
    list-style-type: disc;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 40px;
}
.main_right li {
    float: left;
    font-size: 18px;
    width: 120px;
    text-align: center;
    position: relative;
}
.main_right li a {
    color: #fff;
    display: inline-block;
    line-height: normal;
}
.main_right li a.main_li {
    color: #fff;
    width: 100%;
    height: 80px;
    line-height: 80px;
    position: relative;
    z-index: 10;
}
.main_right .xiala {
    background: url(images/li_3j.png) no-repeat;
    width: 14px;
    height: 6px;
    float: left;
    position: absolute;
    top: 39px;
    right: 5px;
}
#pro_show {
    width: 940px;
    margin-left: -300px;
    position: absolute;
    display: block;
    overflow: visible;
    background-color: rgba(40,44,51,.96)!important;
    display: none;
    padding: 0 5px;
    margin-top: 0;
    top: 80px;
    z-index: 6;
    background: #333;
}
.head-drap-module {
}

.clearfix {
    zoom: 1;
}
dl {
    display: block;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
}
.nav {
    width: 100%;
    height: 80px;
    background-color: rgba(0,0,0,.4);
    position: fixed;
    left: 0;
    top: 0;
    z-index: 8;
    filter: progid:DXImageTransform.Microsoft.gradient(startcolorstr=#20000000, endcolorstr=#20000000);
    min-width: 1200px;
}
.nav.active {
    background: rgb(54, 76, 101);
}
	
.span{
	float:left;
	display:block;
	font-size: 20px;
	color:#FBFBFB
}

a:hover span{
	color: #33FF44;
}

</style>


<div id="nav" class="head div nav active"> </div>
<div class="head div fixed">
    <div class="wrap">
        <div class="main_left">
            <a href="index.php">
                <img class="logo" src="images/logo.png">
            </a>
        </div>
        <div class="main_right">
            <ul>
                <li><a href="index.php"><span class="span">首页</span></a></li>
                <li><a href="info.php?tb=1"><span class="span">员工</span></a></li>
                <li><a href="info.php?tb=2"><span class="span">客户</span></a></li>
                <li><a href="info.php?tb=3"><span class="span">供应商</span></a></li>
                <li ><a href="info.php?tb=4"><span class="span">产品</span></a></li>
                <li ><a href="info.php?tb=5"><span class="span">销售</span></a></li>
                <li> <a href="info.php?tb=6"><span  class="span">日志</span></a></li>
            </ul>
        </div>
     </div>
</div>
<hr>

<?php
    if(is_array($_GET)&&count($_GET)>0)
    {
        if(isset($_GET["tb"]))
        {
            $tb=$_GET["tb"];
            switch ($tb) {
                case 1:
                    $head = '员工信息管理';
                    $table = 'employees';
                    $id_field = 'eid';
                    break;
                
                case 2:
                    $head = '客户信息管理';
                    $table = "customers";
                    $id_field = 'cid';
                    break;

                case 3:
                    $head = '供应商信息管理';
                    $table = "suppliers";
                    $id_field = 'sid';
                    break;

                case 4:
                    $head = '产品信息管理';
                    $table = "products";
                    $id_field = 'pid';
                    break;

                case 5:
                    $head = '销售信息管理';
                    $table = "purchases";
                    $id_field = 'purid';
                    break;

                case 6:
                    $head = '日志管理';
                    $table = "logs";
                    $id_field = 'logid';
                    break;

                default:
                    # code...
                    break;
            }
        }
    }
    
?>
