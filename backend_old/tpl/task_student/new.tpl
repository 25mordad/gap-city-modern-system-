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
<div class="txt"><!-- sm --> <a href="task_student">
<div class="side_menu">
<div class="txt">لیست تکالیف</div>
<div class="icon ns_nw"></div>
<div class="clear"></div>
</div>
</a> <!-- /sm --></div>
</div>
</div>
<!-- end box --></div>
    
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
<div class="title icon_info">تکلیف جدید</div>
</div>
<div class="mid">
<div class="txt">
<div
	id="stylized"
	class="form_add_user"
>
<form
	action="task_student/new"
	method="post"
>
<h1>تکلیف جدید</h1>
<p>تکلیف جدید</p>
<label for="parent_id">عنوان تکلیف <span
	class="small"
></span> </label> <select
	name="parent_id"
	id="parent_id"
	class="select_parent center"
>
	<option value="0">انتخاب کنید&hellip;</option>
	{selectTagGenerator info=$show_title_task_student default= "0" }
</select> 


<label for="pg_content">توضیحات <span class="small"></span> </label> <input
	type="text"
	name="pg_content"
	id="pg_content"
/> 
<label for="pg_title">مربوط به کاربر <span
	class="small"
></span> </label> <select
	name="pg_title"
	id="pg_title"
	class="select_parent center"
>
	<option value="0">انتخاب کنید&hellip;</option>
	{selectTagGenerator info= $show_title_user default= "0" }
</select>

<input
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