{if $action eq "tips"}
{$title = "تیپ"}
{/if}
{if $action eq "index"}
{$title = "مدل"}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">جستجو {$title}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                
                		<form method="get" action="{$part}/{$action}?" class="uniForm" >
                		<input type="hidden" name="paging" value="1" />
	                    <div class="ctrlHolder">
	                      <input name="search" id="search" data-default-value="متن جستجو" size="19"  type="text" class="textInput required auto" {if $smarty.get.search neq "NULL"}value="{$smarty.get.search}"{/if}/>
	                    </div>
	                   
						<div class="buttonHolder">
                            <button type="submit" class="primaryAction">پیدا کن !</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                        <div class="clear"></div>
                        {if $action eq "tips" }
		                    <input type="hidden" name="brand" value="{$smarty.get.brand}" />
		                    <input type="hidden" name="model" value="{$smarty.get.model}" />
                         {/if}   
                        {if $action eq "index" }
		                    <input type="hidden" name="brand" value="{$smarty.get.brand}" />
                         {/if}   
                            
                        </form>
                        {if $smarty.get.search neq "NULL"}
                        <p style="margin-top:10px;text-align:center;">
                        	<a href="{$part}/{$action}?search=NULL" class="del_btn">حذف جستجو</a>
                        </p>
                        {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->