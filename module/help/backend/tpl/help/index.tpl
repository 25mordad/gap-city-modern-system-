<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/help/helpmenu.tpl"}            
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
              {if $GCMS_MODULE[$smarty.get.part] eq "active"}
              {showhelp module=$smarty.get.part}
              {else}
              {include file="tpl/help/{$smarty.get.part}.tpl"}
              {/if} 
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->    	
	</div>
	<div class="clear"></div>    
</div>