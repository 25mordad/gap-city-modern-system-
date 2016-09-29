  		<div class="wrapper" >
  		    <div class="f_menu">
                {foreach $gcms_bott_menus as $gcms_bott_menu}
                	<a href="{$gcms_bott_menu['part']}"><span {if $part eq "{$gcms_bott_menu['part']}"}id="act"{/if}>{$gcms_bott_menu['title']}</span></a>
                {/foreach}
            </div>
            <div class="clear"></div>
            <div class="right copyright">
                <a href="http://gatriya.com" target="_blank">گاتریا</a>
                 ؛  سـیـسـتـمـ مـدیـریـتـ مـحـتـوا تحت وبـــ ::
                  تمامی حقوق نـرمـ افـزار متعلق به 
                  <a href="http://rses.ir/" target="_blank">آرســـس</a>
                  مـی باشد.
            </div>
            <div class="left cp_img"></div>
            <div class="clear"></div>
  		</div>