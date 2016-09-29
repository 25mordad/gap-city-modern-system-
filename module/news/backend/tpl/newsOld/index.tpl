<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/news/menu.tpl"}
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/search.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
		{include file="tpl/news/filter.tpl"}              
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست اخبار</div>
                    <img src="{$loct}/images/icon/news.png" />
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
	                    .close { background: url({$loct}/images/icon/close.png)  }
	                    .open { background: url({$loct}/images/icon/open.png)  }
	                    .pending { background: url({$loct}/images/icon/pending.png)  }
	                    .publish { background: url({$loct}/images/icon/publish.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 300px;">عنوان خبر</span>
                                <span style="width: 170px;">گروه خبری</span>
                                <span style="width: 45px;">وضعیت</span>
                                <span style="width: 45px;">نظرات</span>
                                <span style="width: 45px;">ویرایش</span>
                                <span style="width: 45px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $news_list as $news}
                            <div class="row_1">
                                <span style="width: 300px;" class="BYekan" title="{$news ->pg_title}<br><br>{jdate(" l j F Y",strtotime($news->date_created))}">
								{get_last_image id=$news->id  type="news" thumb="thumb/" class="indx" }{$news ->pg_title|truncate:28:"..":true}</span>
                                <span style="width: 170px;font-size:10px;"><a href="news/editgroup/{$news->parent_id}">{{showtitle id=$news->parent_id chagetoplus="false"}|truncate:33:"..":true}</a></span>
                                <span style="width: 45px;"><div class="icon {$news->pg_status}" title="{$arr_status[$news->pg_status]}" ></div></span>
                                <span style="width: 45px;"><div class="icon {$news->comment_status}"title="{$arr_status[$news->comment_status]}"  ></div></span>
                                <span style="width: 45px;"><a href="news/edit/{$news->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 45px;" class="last">
                                	<a href="news/del/{$news->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}&f_parent={$smarty.get.f_parent}&f_status={$smarty.get.f_status}" 
                                		title="خبر {$news->pg_title} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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