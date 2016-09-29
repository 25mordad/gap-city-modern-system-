<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/module/menu.tpl"}          
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست افزونه ها</div>
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
	                    .active { background: url({$loct}/images/icon/active.png)  }
	                    .pending { background: url({$loct}/images/icon/pending.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 350px;">نام افزونه</span>
                                <span style="width: 200px;">وضعیت</span>
                                <span style="width: 100px;" class="last">تغییر وضعیت</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $modules as $row}
                            <div class="row_1">
                                <span style="width: 350px;" class="BYekan">{$row->module_name}</span>
                                <span style="width: 200px;font-size:10px;">{$row->status}</span>
                                <span style="width: 100px;" class="last"><a href="module/change_status/{$row->id}?status={$row->status}"><div class="icon {$row->status}" ></div></a></span>
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