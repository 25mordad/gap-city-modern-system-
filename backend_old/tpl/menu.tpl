
  		<div class="wrapper" >
  		    <div id="menu_sc" >
                    
            <div id="ca-container" class="ca-container">
                <div class="ca-wrapper">
                    {foreach $gcms_top_menus as $gcms_top_menu}
                    <!-- MENU_ITEM -->
                    <div class="ca-item " >
                        <div class="mym {if $part eq "{$gcms_top_menu['part']}"}mymactive{/if}" >
                            <a href="{$gcms_top_menu['part']}">
                                <span class="title">
                                   <p >{$gcms_top_menu['title']}</p>
                                   <img src="{$gcms_top_menu['img']}" />
                                </span>
                            </a>
                            <div class="clear"></div>
                            <div class="link right ">
                            	{if isset($gcms_top_menu['r1'])}
                                <a href="{$gcms_top_menu['r1']['a']}"><span>{$gcms_top_menu['r1']['t']}</span></a><br />
                                {/if}
                            	{if isset($gcms_top_menu['r2'])}
                                <a href="{$gcms_top_menu['r2']['a']}"><span>{$gcms_top_menu['r2']['t']}</span></a><br />
                                {/if}
                            	{if isset($gcms_top_menu['r3'])}
                                <a href="{$gcms_top_menu['r3']['a']}"><span>{$gcms_top_menu['r3']['t']}</span></a><br />
                                {/if}
                            </div>
                            {if isset($gcms_top_menu['l1']) || isset($gcms_top_menu['l2']) || isset($gcms_top_menu['l3'])}
                            <div class="link_sp right"></div>
                            {/if}
                            <div class="link right ">
                            	{if isset($gcms_top_menu['l1'])}
                                <a href="{$gcms_top_menu['l1']['a']}"><span>{$gcms_top_menu['l1']['t']}</span></a><br />
                                {/if}
                            	{if isset($gcms_top_menu['l2'])}
                                <a href="{$gcms_top_menu['l2']['a']}"><span>{$gcms_top_menu['l2']['t']}</span></a><br />
                                {/if}
                            	{if isset($gcms_top_menu['l3'])}
                                <a href="{$gcms_top_menu['l3']['a']}"><span>{$gcms_top_menu['l3']['t']}</span></a><br />
                                {/if}
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- MENU_ITEM -->
                    {/foreach}
                </div>
            </div> 
              
            <script type="text/javascript" src="{$loct}/js/jquery.mousewheel.js"></script>
            <script type="text/javascript" src="{$loct}/js/jquery.contentcarousel.js"></script>
            <script type="text/javascript">
            $('#ca-container').contentcarousel();
            </script>
                 
            </div>
  		</div>