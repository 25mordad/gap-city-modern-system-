<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/poll/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست نظرسنجی‌ها</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                	{$arr_status = [
	                   'close'=>"در دست بررسی"  ,
	                   'archive' => "آرشیو" ,
	                   'open' => "فعال"  
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
	                    .sg_st { background: url({$loct}/images/icon/sg_st.png)  }
	                    .close { background: url({$loct}/images/icon/pending.png)  }
	                    .open { background: url({$loct}/images/icon/publish.png)  }
	                    .archive { background: url({$loct}/images/icon/parent.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                            	<span style="width: 30px;">شماره</span>
                                <span style="width: 460px;">سوال نظرسنجی</span>
                                <span style="width: 40px;">وضعیت</span>
                                <span title="مشاهده آمار نتایج نظرسنجی" style="width: 40px;" >نتایج</span>                                
                                <span style="width: 40px;">ویرایش</span>
                                <span style="width: 40px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $polls as $poll}
                            <div class="row_1">
                            	<span style="width: 30px;">{$poll->id}</span>
                                <span style="width: 460px;" class="BYekan" title="{$poll->question}">{$poll->question|truncate:60:"..":true}</span>
                                <span style="width: 40px;"><div class="icon {$poll->status}" title="{$arr_status[$poll->status]}" ></div></span>
                                <span style="width: 40px;"><a href="poll/show/{$poll->id}"><div class="icon sg_st" ></div></a></span>
                                <span style="width: 40px;"><a href="poll/edit/{$poll->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 40px;" class="last">
                                	<a href="poll/del/{$poll->id}" 
                                		title="نظرسنجی {$poll->question|truncate:30} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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