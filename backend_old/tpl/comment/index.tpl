<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/helper/search.tpl"}
		{include file="tpl/comment/filter.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست نظرات</div>
                    <img src="{$loct}/images/icon/list.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">               
	                	{$arr_status = [
		                   'pending'=>"در انتظار تایید"  ,
		                   'publish' => "تاییدشده" 
		                   ]}              
	                	{$arr_types = [
		                   'page'=>"صفحات",
		                   'news' => "اخبار",
		                   'gallery' => "گالری عکس",
		                   'sound' => "گالری صوتی"  
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
	                            	<span style="width: 80px;">تاریخ</span>
	                                <span style="width: 150px;">نویسنده</span>
	                                <span style="width: 220px;">مکان (بخش &raquo; صفحه)</span>
	                                <span style="width: 60px;">وضعیت</span>
	                                <span style="width: 60px;">ویرایش</span>
	                                <span style="width: 60px;">حذف</span>
	                                <div class="clear"></div>
	                            </div>
	                            {foreach $comments as $comment}
	                            <div class="row_1">
	                            	<span style="width: 80px;color: red;font-size:11px;">{jdate(" d / m / Y ",strtotime($comment->cm_date))}</span>
	                                <span style="width: 150px;" class="BYekan"  title="{$comment->cm_content|truncate:130:"..":true}">{$comment->cm_author|truncate:16:"..":true}</span>
	                                <span style="width: 220px;">{$arr_types[$comment->cm_type]} &raquo; <a href="{$comment->cm_type}/edit/{$comment->id_other}">{{showtitle id=$comment->id_other chagetoplus="false" }|truncate:30:"..":true}</a></span>
	                                <span style="width: 60px;">
	                                	<a href="comment/{if $comment->cm_status eq "pending"}confirm{else}unconfirm{/if}/{$comment->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}&cm_status={$smarty.get.cm_status}&cm_type={$smarty.get.cm_type}" 
	                                		title="نظر {$comment->cm_author} {if $comment->cm_status eq "pending"}تایید{else}از حالت تایید خارج{/if} شود؟"  class="confirm_dialog" >
	                                			<div class="icon {$comment->cm_status}" title="{$arr_status[$comment->cm_status]}<br><br>برای تغییر وضعیت کلیک کنید" ></div>
	                                	</a>
	                                </span>
	                                <span style="width: 60px;"><a href="comment/edit/{$comment->id}"><div class="icon edit" title="برای دیدن اطلاعات کامل نظر اینجا کلیک کنید" ></div></a></span>
	                                <span style="width: 60px;" class="last">
	                                	<a href="comment/del/{$comment->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}&cm_status={$smarty.get.cm_status}&cm_type={$smarty.get.cm_type}" 
	                                		title="نظر {$comment->cm_author} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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