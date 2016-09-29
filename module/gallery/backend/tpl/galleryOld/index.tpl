<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/gallery/menu.tpl"}             
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست گالری‌های عکس</div>
                    <img src="/core/module/gallery/backend/images/gallery.png" />
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
                                <span style="width: 450px;">عنوان گالری عکس</span>
                                <span style="width: 50px;">وضعیت</span>
                                <span style="width: 50px;">نظرات</span>
                                <span style="width: 50px;">ویرایش</span>
                                <span style="width: 50px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $galleries as $gallery}
                            <div class="row_1">
                                <span style="width: 450px;" class="BYekan" title="{jdate(" l j F Y",strtotime($gallery->date_created))}">
								{get_last_image id=$gallery->id  type="gallery" thumb="thumb/" class="indx" }{$gallery->pg_title|truncate:50:"..":true}</span>
                                <span style="width: 50px;"><div class="icon {$gallery->pg_status}" title="{$arr_status[$gallery->pg_status]}" ></div></span>
                                <span style="width: 50px;"><div class="icon {$gallery->comment_status}"title="{$arr_status[$gallery->comment_status]}"  ></div></span>
                                <span style="width: 50px;"><a href="gallery/edit/{$gallery->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="gallery/del/{$gallery->id}" title="گالری عکس {$gallery->pg_title} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
                                </span>
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