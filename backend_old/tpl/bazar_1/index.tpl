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
            ایجاد حراج جدید
            </div>
        </div>
        <div class="mid">
            <div class="txt">
                <!-- sm -->
                <a href="bazar_1/new/">
                <div class="side_menu">
                <div class="txt">ایجاد حراج جدید</div>
                <div class="icon nw_pg"></div>
                <div class="clear"></div>
                </div>
                </a>
                <!-- /sm -->
                <!-- sm -->
                <a href="bazar_1/sponsor/">
                <div class="side_menu">
                <div class="txt">ایجاد اسپانسر جدید</div>
                <div class="icon nw_pg"></div>
                <div class="clear"></div>
                </div>
                </a>
                <!-- /sm -->
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
            لیست حراج ها
            </div>
        </div>
        <div class="mid">
            <div class="txt">
                {foreach $lists_bazar_1 as $row}
                <div class="list">
                    <div class="pic_thumb">{showlastindeximage_haraj id=$row->id  thumb="thumb/" size="" }</div>
                    <div class="title">
                    <div class="t_m">&raquo; <a href="bazar_1/edit/{$row->id}">{$row->name}</a></div>
                     </div>
                   
                    
                    <div class="title">
                     {jdate(" l j F Y H:i",strtotime( $row->time_start ))}
                     <br/>
                     {jdate(" l j F Y H:i",strtotime( $row->time_end ))}
                    </div>
                    
                    <div class="action">
                     {$row->status }
                    </div>
                    
                    <div class="action">
                        <a href="bazar_1/edit/{$row->id}"><img src="{$loct}/images/icon/edit.png" onMouseover="ddrivetip('ویرایش ', 100)"; onMouseout="hideddrivetip()" /></a> 

                    </div>
                    <div class="clear"></div>
                    </div>                    
                {/foreach}
                <div class="clear"></div>
               
            </div>
        </div>
    </div>
    <!-- end box -->
</div>
<div class="clear"></div>
</div>