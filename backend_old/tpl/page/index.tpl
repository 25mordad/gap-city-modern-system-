<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/page/menu.tpl"}
		{include file="tpl/box/list_menu.tpl"}
		{include file="tpl/helper/search.tpl"}
		{include file="tpl/page/filter.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست صفحات</div>
                    <img src="{$loct}/images/icon/list.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    
	                	{$arr_status = [
	                   'pending'=>"در دست بررسی"  ,
	                   'publish' => "انتشاریافته" ,
	                   'open' => "فعال" ,
	                   'close' => "غیر فعال" 
	                   ]} 
					    <script src="{$loct}/js/jquery-ui-1.7.2.custom.min.js"></script>
					    <link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
						<script src="{$loct}/js/jquery.easy-confirm-dialog.js"></script>
			            {literal}
			            <script>
				            $(function() {
				            $(".confirm_del").easyconfirm({locale: $.easyconfirm.locales.faIR});
				            });
			            </script>
			            {/literal}
	                    <style>
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    .close { background: url({$loct}/images/icon/close.png)  }
	                    .open { background: url({$loct}/images/icon/open.png)  }
	                    .pending { background: url({$loct}/images/icon/pending.png)  }
	                    .publish { background: url({$loct}/images/icon/publish.png)  }
	                    .parent { background: url({$loct}/images/icon/parent.png)  }
	                    .page { background: url({$loct}/images/icon/page.png)  }
	                    .none { background: url({$loct}/images/icon/none.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 410px;">عنوان صفحه</span>
                                
                                <span style="width: 60px;">وضعیت</span>
                                <span style="width: 60px;">نظرات</span>
                                <span style="width: 60px;">ویرایش</span>
                                <span style="width: 60px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $pages as $page}
                            <div class="row_1">
                                <span style="width: 410px;" class="BYekan" title="{$page ->pg_title}<br><br>{jdate(" l j F Y",strtotime($page->date_created))}">
								{get_last_image id=$page->id  type="page" thumb="thumb/" class="indx" }
								{if $page->parent_id}
								<a href="page/edit/{$page->parent_id}" >  <span style="margin-top: -14px;border: 0px;font-size: 12px;margin-left: 2px;color: #c10000">{showtitle|truncate:25:"..":true id=$page->parent_id chagetoplus="false"  } </span><img  src="{$loct}/images/icon/parnt.png" ></a>
								{/if}
									
								{$page ->pg_title|truncate:32:"..":true}</span>
                                
                                <span style="width: 60px;"><div class="icon {$page->pg_status}" title="{$arr_status[$page->pg_status]}" ></div></span>
                                <span style="width: 60px;"><div class="icon {$page->comment_status}"title="{$arr_status[$page->comment_status]}"  ></div></span>
                                <span style="width: 60px;"><a href="page/edit/{$page->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 60px;" class="last">
                                	<a href="page/del/{$page->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}&f_parent={$smarty.get.f_parent}&f_status={$smarty.get.f_status}" 
                                		title="صفحه {$page->pg_title} حذف شود؟"  class="confirm_del" ><div class="icon del" ></div></a>
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