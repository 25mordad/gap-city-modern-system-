              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">فیلتر گذاری</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                      
                	   <form method="get" action="khodro/{$action}?" class="uniForm" >
                        <div class="ctrlHolder">
                              <select name="brand" id="brand" class="selectInput r_size" >
                                <option value="all">همه برند ها</option>
                                {foreach $brands as $row}
                                <option value="{$row->id}" {if $smarty.get.brand eq $row->id}selected="selected"{/if} >{$row->name}</option>
                                {/foreach}
                              </select>
                        </div>
	                    <input type="hidden" name="model" value="{$smarty.get.model}" />
	                    <input type="hidden" name="search" value="{$smarty.get.search}" />
	                    
                        
						<div class="buttonHolder">
                            <button type="submit" class="primaryAction">محدودسازی برند</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                        <div class="clear"></div>
                        </form > 
                        
                        {if $smarty.get.brand neq "all"}
                        <p style="margin-top:10px;text-align:center;">
                        	<a href="{$part}/{$action}?paging=1&search={$smarty.get.search}&brand=all{if $action eq "tips"}&model={$smarty.get.model}{/if}" class="del_btn">حذف فیلتر برند</a>
                        </p>
                        {/if}
                         {if $action eq "tips"}
                        
                        
                         <form method="get" action="khodro/tips?" class="uniForm" >
                        <div class="ctrlHolder">
                              <select name="model" id="model" class="selectInput r_size" >
                                <option value="all">همه مدل ها</option>
                                {foreach $models as $row}
                                <option value="{$row->id}" {if $smarty.get.model eq $row->id}selected="selected"{/if} >{$row->model_name}</option>
                                {/foreach}
                              </select>
                        </div>
	                    <input type="hidden" name="brand" value="{$smarty.get.brand}" />
	                    <input type="hidden" name="search" value="{$smarty.get.search}" />
	                    
                        
						<div class="buttonHolder">
                            <button type="submit" class="primaryAction">محدودسازی مدل ها</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                        <div class="clear"></div>
                        </form > 
                        
                        {if $smarty.get.model neq "all"}
                        <p style="margin-top:10px;text-align:center;">
                        	<a href="{$part}/{$action}?paging=1&search={$smarty.get.search}&brand={$smarty.get.brand}&model=all" class="del_btn">حذف فیلتر برند</a>
                        </p>
                        {/if}
                        
                        
                        {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->