<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/adv_wb/formlesson.tpl"}
		{include file="tpl/adv_wb/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right" >لیست درس‌ها</div>
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
				            });
			            </script>
			            {/literal}
	                    <style>
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    .plus { background: url({$loct}/images/icon/plus.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 400px;">نام</span>
                                <span style="width: 150px;">پیش‌نیاز</span>
                                <span style="width: 50px;">ویرایش</span>
                                <span style="width: 50px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $lessons as $lesson}
                            <div class="row_1">
                                <span style="width: 400px;" title="کد درس: {$lesson->code}<br>ضریب: {$lesson->rate}<br>نمره قبولی: {$lesson->accept_score}" class="BYekan">{$lesson->name}</span>
                                <span style="width: 150px;font-size:10px;">{if $lesson->id_parent neq 0}{$select_lesson[$lesson->id_parent]|truncate:20:"..":true}{else}ندارد{/if}</span>
                                <span style="width: 50px;"><a href="adv_wb/lessons/?paging={$smarty.get.paging}&edit={$lesson->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="adv_wb/dellesson/{$lesson->id}/?paging={$smarty.get.paging}" 
                                		title="درس {$lesson->name} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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
		                    <a href="adv_wb/lessons/?paging={$smarty.section.num.index}"><span>{$smarty.section.num.index}</span></a>
		                    {else}
		                    <span class="actpagin">{$smarty.section.num.index}</span>
		                    {/if}
		                {/section}
		                </div>
		                <!-- paging -->  
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	
	</div>
	<div class="clear"></div>    
</div>
