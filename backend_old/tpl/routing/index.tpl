<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/routing/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست مسیرها</div>
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
                                <span style="width: 100px;">ماژول</span>
                                <span style="width: 100px;">اکشن</span>
                                <span style="width: 100px;">آی‌دی اکشن</span>
                                <span style="width: 150px;">آدرس</span>
                                <span style="width: 50px;">ویرایش</span>
                                <span style="width: 50px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $routs as $rout}
                            <div class="row_1">
                                <span style="width: 100px;" >{$rout->module}</span>
                                <span style="width: 100px;" >{$rout->action}</span>
                                <span style="width: 100px;" >{$rout->action_id}</span>
                                <span style="width: 150px;direction:ltr;text-align:right;" >{$rout->url}</span>
                                <span style="width: 50px;"><a href="routing/edit/{$rout->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="routing/del/{$rout->id}" 
                                		title="مسیر {$rout->url} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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