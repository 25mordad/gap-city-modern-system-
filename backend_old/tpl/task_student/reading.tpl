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
<div class="txt">
<!-- user --> 
<select name="list_user" id="choose" class="select_parent center">
<option value="0">انتخاب کاربر&hellip;</option>
{selectTagGenerator info= $show_title_user default= 0 }
</select>
<script>                              
$('#choose').change(function(event) {
    $choose_val = $('#choose').val();
    window.location = "task_student/reading?year=91&id="+$choose_val;

}); 
</script> 
<!-- /user -->
</div>
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
<div class="title icon_info">میانگین ساعت مطالعه</div>
</div>
<div class="mid">
<div class="txt">
    {if isset($smarty.get.year)}
    <b>{show_username id=$smarty.get.id }{show_value_user_param id_user = $smarty.get.id  name =14 }</b> || {$show_username->username} 
    <form method="post" action="task_student/reading?year={$smarty.get.year}&id={$smarty.get.id}">
    <input type="submit" value="ارسال" name="send" /><br />
    <input type="hidden" name="update_id" value="{$f_row->id}" />
    <div class="right" style="width:200px">هفته</div>
    <div class="right" style="width:150px">ساعت مطالعه پیش بینی شده</div>
    <div class="right" style="width:100px">ساعت مطالعه واقعی</div>
    <div class="clear"></div>
    <hr style="height: 5px; background: black;" />
    {if isset($f_row->id)}
    {$reding = explode(",", $f_row->read)}
    {$ave = explode(",", $f_row->ave)}
    {/if}
   {section name=dars start=1 loop=53 step=1}
    <div class="right" style="width:200px">هفته {$smarty.section.dars.index}</div>
    <input type="text" name="read[]" value="{$reding[$smarty.section.dars.index-1]}" /> | 
    <input type="text" name="ave[]" value="{$ave[$smarty.section.dars.index-1]}" />
    <div class="clear"></div><hr/>
    {/section}
    </form>
    {/if}
</div>
</div>
</div>
<!-- end box --></div>
<div class="clear"></div>

</div>