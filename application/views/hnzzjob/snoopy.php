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
	<div><label>开始页数：</label><input id="startpage" type="text" name="startpage" value="880"></input></div>
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
