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
</a> <!-- /sm --> <!-- sm --> <a href="task_student/new">
<div class="side_menu">
<div class="txt">ایجاد تکلیف</div>
<div class="icon ns_nw"></div>
<div class="clear"></div>
</div>
</a> <!-- /sm --> <!-- sm --> <a href="task_student/newtitle">
<div class="side_menu">
<div class="txt">ایجاد عنوان تکلیف جدید</div>
<div class="icon ns_nw"></div>
<div class="clear"></div>
</div>
</a> <!-- /sm --></div>
</div>
</div>
<!-- end box --> <!-- start box -->
<div class="box">
<div class="top">
<div class="title icon_edit">لیست عناوین تکلیف
</div>
</div>
<div class="mid">
<div class="txt">{foreach $lists_task_student_title as $row}
<div><a href="task_student/edittitle/{$row->id}">{$row->pg_title}</a></div>
{/foreach}</div>
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
<div class="title icon_info">لیست تکالیف</div>
</div>
<div class="mid">
<div class="txt">{foreach $lists_task_student as $row}
<div class="list">
<div class="title">
<div class="t_p">عنوان تکلیف : <a
	href="task_student/edittitle/{$row->parent_id}"
>{showtitle id= $row->parent_id chagetoplus=false }</a></div>
<div class="t_m">{show_username id=$row->pg_title }
کـاربر&raquo; <a href="user/edit/{$show_username->id}">{$show_username->username}</a></div>
</div>
<div class="action">توضیحات : {$row->pg_content}</div>
<div class="action"><a href="task_student/edit/{$row->id}"><img
	src="{$loct}/images/icon/edit.png"
	onMouseover="ddrivetip('ویرایش', 50)"
	;
 onMouseout="hideddrivetip()"
/></a></div>
<div class="clear"></div>
</div>
{/foreach} <!-- paging -->
<div class="paging">{section name=num start=1 loop=$paging+1 } {if
$smarty.section.num.index neq $smarty.get.paging} <a
	href="{pagingurl url= $smarty.server.REQUEST_URI paging= {$smarty.section.num.index} }"
><span>{$smarty.section.num.index}</span></a> {else} <span
	class="actpagin"
>{$smarty.section.num.index}</span> {/if} {/section}</div>
<!-- paging --></div>
</div>
</div>
<!-- end box --></div>
<div class="clear"></div>

</div>