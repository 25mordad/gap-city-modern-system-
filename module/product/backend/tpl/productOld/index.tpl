<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/product/menu.tpl"}
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/search.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
		{include file="tpl/product/filter.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست محصولات</div>
                    <img src="/core/module/product/backend/images/product.png" />
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
	                    .product { background: url({$loct}/images/icon/product.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 350px;">عنوان صفحه</span>
                                <span style="width: 60px;">گروه</span>
                                <span style="width: 60px;">وضعیت</span>
                                <span style="width: 60px;">نظرات</span>
                                <span style="width: 60px;">ویرایش</span>
                                <span style="width: 60px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $products as $product}
                            <div class="row_1">
                                <span style="width: 350px;" class="BYekan" title="{$product ->pg_title}<br><br>{jdate(" l j F Y",strtotime($product->date_created))}">
								{get_last_image id=$product->id  type="product" thumb="thumb/" class="indx" }{$product ->pg_title|truncate:32:"..":true}</span>
                                <span style="width: 60px;">
									{if $product->parent_id}<a href="product/grouping/?edit={$product->parent_id}"><div class="icon parent" title="{showtitle id=$product->parent_id chagetoplus="false" }" ></div></a>
									{else}<div class="icon product"title="ندارد"  ></div>{/if}</span>
                                <span style="width: 60px;"><div class="icon {$product->pg_status}" title="{$arr_status[$product->pg_status]}" ></div></span>
                                <span style="width: 60px;"><div class="icon {$product->comment_status}"title="{$arr_status[$product->comment_status]}"  ></div></span>
                                <span style="width: 60px;"><a href="product/edit/{$product->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 60px;" class="last">
                                	<a href="product/del/{$product->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}&f_parent={$smarty.get.f_parent}&f_status={$smarty.get.f_status}" 
                                		title="صفحه {$product->pg_title} حذف شود؟"  class="confirm_del" ><div class="icon del" ></div></a>
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