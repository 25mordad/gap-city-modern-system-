<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/adv_wb/formdiscount.tpl"}
		{include file="tpl/adv_wb/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست تخفیف‌ها</div>
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
				            	$(".confirm_dialog").easyconfirm( { locale: $.easyconfirm.locales.faIR } );
				            });
			            </script>
			            {/literal}
	                    <style>
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                            	<span style="width: 110px;">مقدار تخفیف (ریال)</span>
                                <span style="width: 290px;">کاربر</span>
                                <span style="width: 80px;">نوع کاربر</span>
                                <span style="width: 70px;" >اعتبار (ریال)</span>
                                <span style="width: 50px;">ویرایش</span>
                                <span style="width: 50px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $users as $user}
                            <div class="row_1">
                            	<span style="width: 100px;text-align:left;padding-left:10px;" class="BYekan">{number_format($user->value)}</span>
                                <span style="width: 290px;font-size:10px;" ><a href="user/edit/{$user->id}">{$user->params} ({$user->username})</a></span>
                                <span style="width: 80px;" title="{$GCMS_USER_LEVEL[$user->user_level]}">{$GCMS_USER_LEVEL[$user->user_level]|truncate:12:"..":true}</span>
                                <span style="width: 55px;text-align:left;padding-left:10px;">{number_format($user->credit)}</span>
                                <span style="width: 50px;"><a href="adv_wb/discounts/?paging={$smarty.get.paging}&edit={$user->meta_id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="adv_wb/deldiscount/{$user->meta_id}/?paging={$smarty.get.paging}" 
                                		title="تخفیف برای {$user->username} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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
		                    <a href="adv_wb/discounts/?paging={$smarty.section.num.index}"><span>{$smarty.section.num.index}</span></a>
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