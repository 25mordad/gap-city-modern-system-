<link href="{$loct}/css/old_style.css" rel="stylesheet" type="text/css" />
<div class="wrapper" >
	<div class="right _255 ">
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right"></div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
						
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
	<!-- start box -->
{include file="tpl/web_sample/menu.tpl"}
<!-- end box -->
</div>
    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right"></div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    	
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	
	<!-- start box -->
<div class="box">
    <div class="top">
    <div class="title icon_info">نمونه کار جدید</div>
    </div>
<div class="mid">
<div class="txt">
<div	id="stylized"	class="form_add_user">
<form	action="web_sample/new"	method="post">
<h1>نمونه کار جدید</h1>
<p>نمونه کار جدید</p>

<label for="name">نام<span class="small"></span> </label> 
<input	type="text"	name="name"	id="name"/>

<label for="url">آدرس url<span class="small"></span> </label> 
<input	type="text"	name="url"	id="url"/>

{$status = [
                        ['name'=>"در حال فعالیت" ,'value'=>"active"],
                        ['name'=>"تعطیل شده"     ,'value'=>"closed"]
                        ]} 
<label for="site_status">وضعیت سایت<span class="small"></span> </label> 
<select	name="site_status"	id="site_status"	class="select_parent center">
	<option value="0">انتخاب کنید&hellip;</option>
	{selectTagGenerator info=$status default= "0" }
</select> 

<label for="activity">زمینه فعالیت<span class="small"></span> </label> 
<textarea name="activity" id="activity" style="width: 250px;font-size: 11px;"></textarea>

<label for="active_date">تاریخ راه اندازی سایت<span class="small"></span> </label> 
<input	type="text"	name="active_date"	id="active_date" value="{date("Y-m-d",strtotime( "now" ))}"/>

{$status_m = [
                        ['name'=>"در حال نمایش" ,'value'=>"publish"],
                        ['name'=>"حذف"          ,'value'=>"delete"]
                        ]} 
<label for="status">وضعیت<span class="small"></span> </label> 
<select	name="status"	id="status"	class="select_parent center">
	{selectTagGenerator info=$status_m default= "publish" }
</select> 



<input	type="submit"	value="ذخیره و ادامه &hellip;"	name="new"/>
<div class="clear"></div>
</form>
</div>
</div>
</div>
</div>
<!-- end box -->
</div>
<div class="clear"></div>

</div>