<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/adv_wb/formgrade.tpl"}
		{include file="tpl/adv_wb/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right" >لیست پایه‌ها (سال تحصیلی {$default_year->name})</div>
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
                                <span style="width: 150px;">اضافه کردن کلاس جدید</span>
                                <span style="width: 50px;">ویرایش</span>
                                <span style="width: 50px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $grades as $grade}
                            <div class="row_1">
                                <span style="width: 400px;" title="برای دیدن لیست کلاس‌های {$grade->name} کلیک کنید"><a class="BYekan" href="adv_wb/?paging=1&search=NULL&branch=all&grade={$grade->id}">{$grade->name}</a></span>
                                <span style="width: 150px;"><a href="adv_wb/newclass/?grade={$grade->id}"><div class="icon plus" ></div></a></span>
                                <span style="width: 50px;"><a href="adv_wb/grades/?paging={$smarty.get.paging}&edit={$grade->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="adv_wb/delgrade/{$grade->id}/?paging={$smarty.get.paging}" 
                                		title="پایه {$grade->name} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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
		                    <a href="adv_wb/grades/?paging={$smarty.section.num.index}"><span>{$smarty.section.num.index}</span></a>
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
