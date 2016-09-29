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
    <div class="title icon_info">لیست نمونه کارها</div>
    </div>
<div class="mid">
<div class="txt">
    {foreach $lists_sample as $row}
    <div class="list">
       <div class="pic_thumb">{showlastindeximage_type id=$row->id  thumb="thumb/" size="115" type="web_sample" }</div>
        <div class="title" >
         <div class="t_m">&raquo; <a href="web_sample/edit/{$row->id}">{$row->name}</a></div>
        </div>
        
        <div class="title">
         {$row->url}
        </div>
        
        <div class="action">
            <a href="web_sample/edit/{$row->id}"><img src="{$loct}/images/icon/edit.png" onMouseover="ddrivetip('ویرایش ', 100)";
    onMouseout="hideddrivetip()" /></a> 
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