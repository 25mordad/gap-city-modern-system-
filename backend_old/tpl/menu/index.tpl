<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/menu/menu.tpl"}
		{include file="tpl/menu/filter.tpl"}             
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست منوها</div>
                    <img src="{$loct}/images/icon/list.png" />
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
	                    .info { background: url({$loct}/images/icon/info.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                            	<span title="ترتیب قرار گرفتن منو در سایت را نشان می‌دهد" style="width: 30px;">ترتیب</span>
                                <span style="width: 300px;">عنوان منو</span>
                                <span style="width: 150px;">منوی مادر</span>
                                <span style="width: 50px;">لینک</span>
                                <span style="width: 50px;">ویرایش</span>
                                <span style="width: 50px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $menus as $menu}
                            <div class="row_1">
                            	<span style="width: 30px;color:green;">{$menu->order}</span>
                                <span style="width: 300px;" class="BYekan">{$menu->title}</span>
                                <span style="width: 150px;font-size:10px;">{if $menu->parent}<a href="menu/edit/{$menu->parent}">{$main_menu[$menu->parent]}</a>{else}ندارد{/if}</span>
                                <span style="width: 50px;"><a href="{$menu->link}"><div class="icon info" title="{$menu->link}" ></div></a></span>
                                <span style="width: 50px;"><a href="menu/edit/{$menu->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="menu/del/{$menu->id}/?parent={$smarty.get.parent}" 
                                		title="منوی {$menu->title} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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