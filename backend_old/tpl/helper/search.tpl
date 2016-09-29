{if $part eq "page" || $part eq "news" || $part eq "up"}
	{$url="&f_parent={$smarty.get.f_parent}&f_status={$smarty.get.f_status}"}
{else if $part eq "comment"}
	{$url="&cm_type={$smarty.get.cm_type}&cm_status={$smarty.get.cm_status}"}
{else if $part eq "adv_wb"}
	{$url="&branch={$smarty.get.branch}&grade={$smarty.get.grade}"}
{else if $part eq "contact"}
	{$url="&id_group={$smarty.get.id_group}"}
{else}
	{$url=""}
{/if}

{if $action eq "index"}
	{$action_url=""}
{else}
	{$action_url=$action|cat:'/'}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">جستجو{if $part eq "pay_mellat"}ی نام کاربری{/if}</div>
                    <img src="{$loct}/images/icon/search.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                
                		<form method="get" action="{$part}/{$action_url}?" class="uniForm" >
                		<input type="hidden" name="paging" value="1" />
	                    <div class="ctrlHolder">
	                      <input name="search" id="search" data-default-value="متن جستجو" size="19"  type="text" class="textInput required auto" {if $smarty.get.search neq "NULL"}value="{$smarty.get.search}"{/if}/>
	                    </div>
	                    {if $part eq "page" || $part eq "news" || $part eq "up"}
		                    <input type="hidden" name="f_status" value="{$smarty.get.f_status}" />
		                    <input type="hidden" name="f_parent" value="{$smarty.get.f_parent}" />
	                    {else if $part eq "comment"}
		                    <input type="hidden" name="cm_type" value="{$smarty.get.cm_type}" />
		                    <input type="hidden" name="cm_status" value="{$smarty.get.cm_status}" />
	                    {else if $part eq "adv_wb"}
		                    <input type="hidden" name="branch" value="{$smarty.get.branch}" />
		                    <input type="hidden" name="grade" value="{$smarty.get.grade}" />
	                    {else if $part eq "contact"}
		                    <input type="hidden" name="id_group" value="{$smarty.get.id_group}" />
	                    {/if}
                        
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
                        </form>
                        {if $smarty.get.search neq "NULL"}
                        <p style="margin-top:10px;text-align:center;">
                        	<a href="{$part}/{$action_url}?paging=1&search=NULL{$url}" class="del_btn">حذف جستجو</a>
                        </p>
                        {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->