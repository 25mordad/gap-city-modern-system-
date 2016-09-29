<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/club/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">اطلاعات گروه {$group->name}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    
									<style>
                                    .row_t {
                                         background: #cccccc; margin: 2px; border-radius: 5px; padding: 10px;
                                    }
                                    .row_t:hover {
                                        background: #333333; color: white; 
                                    }
                                    </style>
                                    
                                    
								    <div class="row_t" style="background: #2321C0; color: white;" >
                                        <div class="right" >
                                        <strong>تابلوی اعلانات گروه</strong>
                                        </div>
								        <div class="clear"></div>
							    {if $group->status eq "suspend"}
							    	<div style="background: red; color: white; text-align: center;">گروه معلق است</div>
							    {/if}
								    </div>
								    <div class="clear"></div>
								    {if count($boards) eq 0}
								    <div class="row_t" >
                                        <div class="right" >
                                        هیچ پیامی در تابلو ثبت نشده است!
                                        </div>
								        <div class="clear"></div>
								    </div>		    
								    <div class="clear"></div>
									{else}
								    {foreach $boards as $board}
								    <div class="row_t" {if $board->id_user eq "0" }style="background: #0D8E2F; color: white;"{/if}>
                                        <div class="right" >
	                                        <strong>{$board->name}: </strong>{$board->txt}
                                        </div>
	                                    <div class="left">{jdate("l j F Y H:i:s",strtotime($board->date))}</div>
								        <div class="clear"></div>
								    </div>		    
								    <div class="clear"></div>
								    {/foreach}
					                <!-- paging -->
					                <div class="paging">
					                {section name=num start=1 loop=$paging+1 }
					                    {if $smarty.section.num.index eq $smarty.get.paging or (!isset($smarty.get.paging) and $smarty.section.num.index eq 1)}
					                    <span class="actpagin">{$smarty.section.num.index}</span>
					                    {else}
					                    <a href="club/group/{$group->id}?paging= {$smarty.section.num.index}"><span>{$smarty.section.num.index}</span></a>
					                    {/if}
					                {/section}
					                </div>
					                <!-- paging -->
					                <div class="clear"></div>
								    {/if}
								<div class="clear"><br></div>
								    <div class="row_t" style="background: black; color: white;" >
                                        <div class="right" >
                                        <strong>امتیازات گروه</strong>
                                        </div>
								        <div class="clear"></div>
								    </div>
								    <div class="clear"></div>
								    {if count($scores) eq 0 and count($userscores) eq 0}
								    <div class="row_t" >
                                        <div class="right" >
                                        هنوز امتیازی کسب نکرده‌اید!
                                        </div>
								        <div class="clear"></div>
								    </div>		    
								    <div class="clear"></div>
									{else}
									{$scores_sum=0}
								    {foreach $scores as $score}
								    <div class="row_t" >
                                        <div class="right" style="width:150px;" >{$score->title}</div>
                                        <div class="left" >{jdate(" l j F Y",strtotime($score->reg_date))}</div>
                                        <div class="right" style="width:150px;direction:ltr;color:red;" >{$score->score}</div>
                                        {$scores_sum=$scores_sum+$score->score}
								        <div class="clear"></div>
								    </div>		    
								    <div class="clear"></div>
								    {/foreach}
								    {foreach $userscores as $userscore}
								    <div class="row_t" >
                                        <div class="right" style="width:150px;" >{$userscore->title}</div>
                                        <div class="left" >{jdate(" l j F Y",strtotime($userscore->date))}</div>
                                        <div class="right" style="width:150px;direction:ltr;color:red;" >{$userscore->score}</div>
                                        {$scores_sum=$scores_sum+$userscore->score}
								        <div class="clear"></div>
								    </div>		    
								    <div class="clear"></div>
								    {/foreach}
								    <div class="row_t" style="background: blue; color: white;" >
                                        <div class="right"  style="width:150px;" >
                                        <strong>جمع کل: </strong>
                                        </div>
                                        <div class="right" style="width:150px;direction:ltr;color:white;" ><strong>{$scores_sum}</strong></div>
								        <div class="clear"></div>
								    </div>
								    <div class="clear"></div>
								    {/if}
								<div class="clear"><br></div>
								    <div class="row_t" style="background: black; color: white;" >
                                        <div class="right" >
                                        <strong>اعضای گروه</strong>
                                        </div>
								        <div class="clear"></div>
								    </div>
								    <div class="clear"></div>
								    {foreach $members as $member}
								    <div class="row_t" >
                                        <div class="right" >
                                        <strong><a href="club/edituser/{$member->id_user}">{$member->name}</a></strong>{if $member->id_user eq $group->id_manager} (مدیر گروه){/if}
                                        </div>
								        <div class="clear"></div>
								    </div>		    
								    <div class="clear"></div>
								    {/foreach}
								<div class="clear"></div>
								<br>
							    	{if isset($group->avatar)}
							    	<div>&raquo; نمایه: <img src="{$temp_root}/images/avatar/g_{$group->avatar}.png" /></div>
							    	{/if}
							    <div class="clear"></div>
								<div>&raquo; تاریخ ایجاد گروه: {jdate(" l j F Y",strtotime($group->date))}</div>
							    
							    <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	
	</div>
	<div class="clear"></div>    
</div>
