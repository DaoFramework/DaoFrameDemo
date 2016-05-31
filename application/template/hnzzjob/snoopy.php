<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>My First Framework</title>
		<meta name="description" content="">
		<meta name="keywords" content="">

		<!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

		<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
		<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>

	<body>
		<div class="container-fluid">
			<?php require VIEWS_PATH."/layout/".'top.php';?>
			<?php
/**
 * snoopy
 * @authors Zhang Daomin (Beyondcommunistparty@gmail.com)
 * @date    2016-04-11 12:56:06
 * @version $Id$
 */

?>
<div>
	<div><label>采集地址：</label><input id="snoopyurl" type="text" name="snoopyurl" value="http://www.hnzzjob.com/dwzp.aspx"></input></div>
	<div><label>开始页数：</label><input id="startpage" type="text" name="startpage" value="868"></input></div>
	<input id="snoopySubmit" type="button" value="开始URL采集"></input>
	<div id='addHtml'>

	</div>
</div>

<script type="text/javascript">
function ajaxfunc(snoopyurl,startpage)
{
	var url = snoopyurl+'?page='+startpage;
	$.post("../hnzzjob/ajaxsnoopy",
  {
    snoopyurl:snoopyurl,
    startpage:startpage
  },
  function(data,status){
  	if (status == 'success' && data < 8444) {
  		console.log(data);
  		//sleep(1000);
  		//ajaxfunc(snoopyurl,data);
  		setTimeout('ajaxfunc("'+snoopyurl+'","'+data+'")',500);
  	}

  });

}

$("#snoopySubmit").click(function(){
	var snoopyurl = $("#snoopyurl").val();
	var startpage = $("#startpage").val();

	if (!snoopyurl || !startpage) {
		alert('is empty');
	}else{
		ajaxfunc(snoopyurl,startpage);
	}
});

</script>

			<?php require VIEWS_PATH."/layout/".'footer.php';?>
		</div>
	</body>
</html>
