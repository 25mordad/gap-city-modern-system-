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
<option value="0">انتخاب کنید&hellip;</option>
{selectTagGenerator info= $show_title_user default= 0 }
</select>
<script>                              
$('#choose').change(function(event) {
    $choose_val = $('#choose').val();
    window.location = "task_student/show_table?id="+$choose_val;

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
<div class="title icon_info">جدول دروس</div>
</div>
<div class="mid">
<div class="txt">
{if isset($smarty.get.table)}
{assign table $smarty.get.table}
{include file="tpl/task_student/table/$table.tpl"}
{else}
    {if isset($smarty.get.id)}
    جدول دروس کاربر {showusername_name id=$smarty.get.id}<br />
                            
                                                        
                            لطفا درس خود را از جدول زیر انخاب کنید : <br />
                            
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=adabiat_pish">ادبیات پیش</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=zaban_farsi_3">زبان فارسی 3</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=adabiat_2">ادبیات 2</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=adabiat_3">ادبیات 3</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=arabi_2">عربی 2</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=arabi_3">عربی 3</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=din_2">دین 2</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=din_3">دین 3</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=din_pish">دين و زندگي پيش</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=zaban_pish">زبان پيش</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=zaban_3">زبان 3</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=zamin_pish">زمين شناسي پيش</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=zamin_3">زمين شناسي سوم</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=zist_pish">زيست پيش</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=zist_3">زيست سوم</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=zist_2">زيست دوم</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=difran">ديفرانسيل</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=hen_paye">هندسه پايه</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=hen_tah">هندسه تحليلي</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=gosaste">گسسته</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=fizik">فيزيک</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=shimi">شيمي</a><br/>
                                <a href="/gadmin/task_student/show_table?id={$smarty.get.id}&table=riazi">رياضي</a><br/>
                    
                            <div class="clear"></div>
                            
    {else}
    هنوز کاربری انتخاب نکرده اید.
    {/if}
{/if}
<!--
{if isset($smarty.get.id)}
<b>{show_username id=$smarty.get.id }{show_value_user_param id_user = $smarty.get.id  name =14 }</b> || {$show_username->username} 
    {$table = ""}{$pn = ""}
    {assign var=arr_table value=[
    'adabiat_2'     =>'ادبیات 2',
    'adabiat_pish'  =>'ادبیات پیش',
    'zaban_farsi_3' =>'زبان فارسی 3'
    ]
    }
    {assign var=arr_type value=[
    'motale_1'    =>'مطالعه 1',
    'moror_1'     =>'مرور 1',
    'moror_2'     =>'مرور 2',
    'test_1'      =>'تست 1',
    'test_2'      =>'تست 2',
    'jambandi'    =>'جمع بندی'    
    ]
    }
    {foreach $list_workbook_user as $row}
    
    {if $table neq $row->title_dars}
    <hr style="height: 5px; background: red;" /><strong>{$arr_table[$row->title_dars]}</strong> 
    {/if}
   
    {if $pn neq $row->part_no}
    <hr />{$row->part_no} - {$arr_type[$row->part_type]}
    {else}
    | {$arr_type[$row->part_type]} 
    {/if}
     
     {$table = $row->title_dars}
     {$pn    = $row->part_no}
    {/foreach}
{/if}
-->
</div>
</div>
</div>
<!-- end box --></div>
<div class="clear"></div>

</div>