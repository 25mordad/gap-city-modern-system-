<div class="wrapper" >
	<div class="right _255 ">
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/search.tpl"}
        <!-- _RBOX_ -->
        <div class="r_box" >
            <div class="top">
                <div class="title right">مدیریت پرداخت</div>
                <img src="{$loct}/images/icon/page.png" />
                <div class="clear"></div>
            </div>
            <div class="mid">
                <div class="txt">
                    <a href="shiraz_user/pay"><div class="r_menu">
                            <span>لیست پرداختی اعضا</span>
                            <img src="{$loct}/images/icon/op_ls.png" />
                        </div></a>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="dwn"></div>
        </div>
        <div class="clear"></div>
        <!-- _RBOX_ -->
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
		{include file="tpl/shiraz_user/filter.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست اعضا</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					    <script src="{$loct}/js/jquery-ui-1.7.2.custom.min.js"></script>
					    <link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
						<script src="{$loct}/js/jquery.easy-confirm-dialog.js"></script>
			            {literal}
			            <script>
				            $(function() {
				            	$(".confirm_dialog").easyconfirm({locale: $.easyconfirm.locales.faIR});
				            	
				                $( "#dialog-form" ).dialog({
				                    autoOpen: false,
				                    height: 200,
				                    width: 220,
				                    modal: true
				                });
				            });
			            </script>
			            {/literal}
	                    <style>
	                    .pass { background: url({$loct}/images/icon/pass.png)  }
	                    .user { background: url({$loct}/images/icon/user.png)  }
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 150px;">نام کاربری</span>
                                <span style="width: 150px;">ایمیل</span>
                                <span style="width: 70px;" >مجموع پلاس</span>
                                <span style="width: 80px;" >سطح دسترسی</span>
                                <span style="width: 50px;">وضعیت</span>
                                <span style="width: 150px;">مشاهده اطلاعات</span>
                                <div class="clear"></div>
                            </div>
                            
	                	{$arr_level = [
	                   'member'=>"عضو"  ,
	                   'seller' => "فروشنده" 
	                   ]} 
                            {foreach $users as $user}
                            <div class="row_1">
                                <span style="width: 150px;font-size:10px;" title="{$user->name}" >{$user->username|truncate:26:"..":true}</span>
                                <span style="width: 150px;font-size:10px;"  {if $user->email}title="{$user->email}"{/if} >{if $user->email}{$user->email|truncate:26:"..":true}{else}-{/if}</span>
                                <span style="width: 70px;" >{$user->plus_count}</span>
                                <span style="width: 80px;" >{$arr_level[$user->level]}</span> 
                                <span style="width: 50px;">{if $user->status eq "active"}فعال{else}غیرفعال{/if}</span>
                                <span style="width: 60px;"><a href="shiraz_user/show/{$user->id}"><div class="icon user" ></div></a></span>
                                <span style="width: 80px;" class="last">
                                	<a href="shiraz_user/changelevel/{$user->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}&f_gender={$smarty.get.f_gender}&f_level={$smarty.get.f_level}" 
                                		title="دسترسی {$user->username} از {$arr_level[$user->level]} تغییر کند؟"  class="confirm_dialog" >تغییر دسترسی</a>
                                </span>
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                        </div>
                        <div class="clear"></div>
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