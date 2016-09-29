<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/workbook/menu.tpl"}
		{include file="tpl/workbook/filter.tpl"}
	</div>
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست کارنامه‌ها</div>
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
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 200px;">عنوان کارنامه</span>
                                <span style="width: 250px;">کاربر</span>
                                <span style="width: 100px;">معدل</span>
                                <span style="width: 50px;">ویرایش</span>
                                <span style="width: 50px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $workbooks as $workbook}
                            <div class="row_1">
                                <span style="width: 200px;"><a class="BYekan" href="workbook/?edit={$workbook->parent_id}">{showtitle id= $workbook->parent_id chagetoplus=false }</a></span>
                                <span style="width: 250px;"><a href="user/edit/{$workbook->pg_title}">{$users[$workbook->pg_title]}</a></span>
                                <span style="width: 100px;">{$workbook->pg_content}</span>
                                <span style="width: 50px;"><a href="workbook/edit/{$workbook->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="workbook/del/{$workbook->id}/?paging={$smarty.get.paging}&title={$smarty.get.title}&user={$smarty.get.user}" 
                                		title="کارنامه {$users[$workbook->pg_title]} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->    	
	</div>
	<div class="clear"></div>    
</div>