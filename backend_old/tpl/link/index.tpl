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
            <div class="title icon_info">
            امکانات
            </div>
        </div>
        <div class="mid">
            <div class="txt">
                <!-- sm -->
                <a href="link">
                <div class="side_menu">
                <div class="txt">لیست پیوند ها</div>
                <div class="icon ns_nw"></div>
                <div class="clear"></div>
                </div>
                </a>
                <!-- /sm -->                         
                <!-- sm -->
                <a href="link/new">
                <div class="side_menu">
                <div class="txt">ایجاد پیوند</div>
                <div class="icon ns_nw"></div>
                <div class="clear"></div>
                </div>
                </a>
                <!-- /sm -->                         
                <!-- sm -->
                <a href="link/newtitle">
                <div class="side_menu">
                <div class="txt">تعریف گروه پیوند</div>
                <div class="icon ns_nw"></div>
                <div class="clear"></div>
                </div>
                </a>
                <!-- /sm -->                         
            </div>
        </div>
    </div>
    <!-- end box -->
     <!-- start box -->
    <div class="box">
        <div class="top">
            <div class="title icon_edit">
            لیست  گروه پیوندها
            </div>
        </div>
        <div class="mid">
            <div class="txt">
                {foreach $lists_link_title as $row}
                <div><a href="link/edittitle/{$row->id}">{$row->pg_title}</a></div>
                {/foreach}       
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
            <div class="title icon_info">
            لیست پیوند ها
            </div>
        </div>
        <div class="mid">
            <div class="txt">
            {foreach $lists_link as $row}
                <div class="list">
                   
                    <div class="title">
                        <div class="t_p">گروه پیوند : <a href="link/edittitle/{$row->parent_id}">{showtitle id= $row->parent_id chagetoplus="false" }</a></div>
                        <div class="t_m">
                        {$row->pg_title}
                        </div>
                    </div>
                    <div class="action">
                        {$row->pg_excerpt}
                    </div>
                    
                    <div class="action">
                        <a href="link/edit/{$row->id}"><img src="{$loct}/images/icon/edit.png" onMouseover="ddrivetip('ویرایش', 50)";
 onMouseout="hideddrivetip()" /></a> 
                       
                    </div>
                    <div class="clear"></div>
                </div>
                {/foreach}
                <!-- paging -->
                <div class="paging">
                {section name=num start=1 loop=$paging+1 }
                    {if $smarty.section.num.index neq $smarty.get.paging}
                    <a href="{pagingurl url= $smarty.server.REQUEST_URI paging= {$smarty.section.num.index} }"><span>{$smarty.section.num.index}</span></a>
                    {else}
                    <span class="actpagin">{$smarty.section.num.index}</span>
                    {/if}
                {/section}
                </div>
                <!-- paging -->
                  
            </div>
        </div>
    </div>
    <!-- end box -->
   
    
</div>
<div class="clear"></div>
</div>