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
<div class="box">
<div class="top">
<div class="title icon_info">امکانات</div>
</div>
<div class="mid">
<div class="txt"><!-- sm --> <a href="link">
<div class="side_menu">
<div class="txt">لیست پیوند ها</div>
<div class="icon ns_nw"></div>
<div class="clear"></div>
</div>
</a> <!-- /sm --></div>
</div>
</div>
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
<div class="title icon_info">پیوند جدید</div>
</div>
<div class="mid">
<div class="txt">
<div
	id="stylized"
	class="form_add_user"
>
<form
	action="link/new"
	method="post"
>
<h1>پیوند جدید</h1>
<p>پیوند جدید</p>
<label for="parent_id">گروه پیوند <span class="small"></span>
</label> <select
	name="parent_id"
	id="parent_id"
	class="select_parent center"
>
	<option value="0">انتخاب کنید&hellip;</option>
	{selectTagGenerator info=$show_title_link default= "0" }
</select> <label for="pg_title">عنوان پیوند <span class="small"></span>
</label> <input
	type="text"
	name="pg_title"
	id="pg_title"
/> <label for="pg_content">شرح پیوند <span
	class="small"
></span> </label> <input
	type="text"
	name="pg_content"
	id="pg_content"
/> <label for="pg_excerpt">آدرس URL پیوند <span
	class="small"
></span> </label> <input
	type="text"
	name="pg_excerpt"
	id="pg_excerpt"
/> <label for="pg_status">وضعیت نمایش پیوند <span
	class="small"
></span> </label> {$radios = [['name'=>"در دست بررسی" , 'value' =>
"pending"],['name' => "status_button_publish" , 'value' =>
"publish"],['name'=>"status_button_delete" , 'value' => "delete"]]}
{radioTagGenerator info = $radios default= "publish" radioName=
"pg_status"} <input
	type="submit"
	value="ذخیره و ادامه &hellip;"
	name="new"
/>
<div class="clear"></div>
</form>
</div>
</div>
</div>
</div>
<!-- end box --></div>
<div class="clear"></div>
</div>