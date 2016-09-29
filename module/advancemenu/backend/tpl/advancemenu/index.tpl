<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/advancemenu/menu.tpl"}
		{include file="tpl/advancemenu/filter.tpl"}             
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست منوها</div>
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
	                    .info { background: url({$loct}/images/icon/info.png)  }
	                    </style>
	                	{$arr_group = [
	                   'maingroup'=>"منوی اصلی"  ,
	                   'fgroup1' => "منوی فرعی ۱" ,
	                   'fgroup2' => "منوی فرعی ۲" ,
	                   'fgroup3' => "منوی فرعی ۳" 
	                   ]} 
	                    <div class="list" id="tooltip">
                            <div class="top">
                            	<span title="ترتیب قرار گرفتن منو در سایت را نشان می‌دهد" style="width: 30px;">ترتیب</span>
                                <span style="width: 250px;">عنوان منو</span>
                                <span style="width: 100px;">گروه</span>
                                <span style="width: 100px;">منوی مادر</span>
                                <span style="width: 50px;">لینک</span>
                                <span style="width: 50px;">ویرایش</span>
                                <span style="width: 50px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $menus as $menu}
                            <div class="row_1">
                            	<span style="width: 30px;color:green;">{$menu->order}</span>
                                <span style="width: 250px;" class="BYekan">{$menu->title}</span>
                                <span style="width: 100px;font-size:10px;">{$arr_group[$menu->group]}</span>
                                <span style="width: 100px;font-size:10px;">{if $menu->parent}<a href="advancemenu/edit/{$menu->parent}">{$main_menu[$menu->parent]}</a>{else}ندارد{/if}</span>
                                <span style="width: 50px;"><a href="{$menu->link}"><div class="icon info" title="{$menu->link}" ></div></a></span>
                                <span style="width: 50px;"><a href="advancemenu/edit/{$menu->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="advancemenu/del/{$menu->id}/?parent={$smarty.get.parent}" 
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