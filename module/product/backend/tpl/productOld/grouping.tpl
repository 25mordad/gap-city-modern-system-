<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/product/formgroup.tpl"}
		{include file="tpl/product/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست گروه‌های محصولات</div>
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
	                    .pending { background: url({$loct}/images/icon/pending.png)  }
	                    .publish { background: url({$loct}/images/icon/publish.png)  }
                        .parent { background: url({$loct}/images/icon/parent.png)  }
                        .plus { background: url({$loct}/images/icon/plus.png)  }
	                    </style>
                        {$arr_status = [
	                   'pending'=>"در دست بررسی"  ,
	                   'publish' => "انتشاریافته" ,
	                   'open' => "فعال" ,
	                   'close' => "غیر فعال" 
	                   ]} 
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 280px;">عنوان</span>
                                <span style="width: 80px;">افزودن پارامتر</span>
                                <span style="width: 90px;">افزودن محصول</span>
                                <span style="width: 90px;">لیست محصولات</span>
                                <span style="width: 50px;">وضعیت</span>
                                <span style="width: 50px;">ویرایش</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $groups as $group}
                            <div class="row_1">
                                <span style="width: 280px;" class="BYekan" title="{$group->pg_content}">
                                {if $group->parent_id}
								<a href="product/grouping/?edit={$group->parent_id}" >  <span style="margin-top: -14px;border: 0px;font-size: 12px;margin-left: 2px;color: #c10000">{showtitle|truncate:25:"..":true id=$group->parent_id chagetoplus="false"  } </span><img  src="{$loct}/images/icon/parnt.png" ></a>
								{/if}
                                {$group->pg_title}</span>
                                <span style="width: 80px;"><a href="product/add_param/{$group->id}"><div class="icon plus" ></div></a></span>
                                <span style="width: 90px;"><a href="product/new/?parent={$group->id}"><div class="icon plus" ></div></a></span>
                                <span style="width: 90px;"><a href="product/?paging=1&search=NULL&f_parent={$group->id}&f_status=all"><div class="icon parent" ></div></a></span>
                                <span style="width: 50px;"><a href="product/grouping/?status={$group->pg_status}&id={$group->id}"><div class="icon {$group->pg_status}" title="{$arr_status[$group->pg_status]}" ></div></a></span>
                                <span style="width: 50px;"><a href="product/grouping/?edit={$group->id}"><div class="icon edit" ></div></a></span>
                                                                
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                        </div>
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
