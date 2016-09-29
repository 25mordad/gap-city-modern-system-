<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/link/menu.tpl"}         
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست پیوندها</div>
                    <img src="/core/module/link/backend/images/link.png" />
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
				            $(".confirm_dialog").easyconfirm({locale: $.easyconfirm.locales.faIR});
				            });
			            </script>
			            {/literal}
	                    <style>
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    .pending { background: url({$loct}/images/icon/pending.png)  }
	                    .publish { background: url({$loct}/images/icon/publish.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 200px;">عنوان پیوند</span>
                                <span style="width: 170px;">گروه‌پیوند</span>
                                <span style="width: 145px;">آدرس</span>
                                <span style="width: 45px;">وضعیت</span>
                                <span style="width: 45px;">ویرایش</span>
                                <span style="width: 45px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $link_list as $link}
                            <div class="row_1">
                                <span style="width: 200px;" title="{$link ->pg_content}<br><br>{jdate(" l j F Y",strtotime($link->date_created))}">
								{$link ->pg_title|truncate:28:"..":true}</span>
                                <span style="width: 170px;font-size:10px;"><a href="link/listgroup/?edit={$link->parent_id}">{{showtitle id=$link->parent_id chagetoplus="false"}|truncate:33:"..":true}</a></span>
                                <span style="width: 145px;font-size:10px;text-align:left;padding-left:5px;" title="{$link ->pg_excerpt}">{$link ->pg_excerpt|truncate:30:"":true}</span>
                                <span style="width: 45px;"><div class="icon {$link->pg_status}" title="{$arr_status[$link->pg_status]}" ></div></span>
                                <span style="width: 45px;"><a href="link/edit/{$link->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 45px;" class="last">
                                	<a href="link/del/{$link->id}" 
                                		title="پیوند {$link->pg_title} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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