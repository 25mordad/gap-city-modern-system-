<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/user/menu.tpl"}
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/search.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست اعضا</div>
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
				            	
				                $( "#dialog-form" ).dialog({
				                    autoOpen: false,
				                    height: 200,
				                    width: 220,
				                    modal: true
				                });
				            });
				            function edit_credit(id_user, credit)
				            {
				            	$( "#id_user" ).val(id_user);
				            	$( "#credit" ).val(credit);
				            	$( "#dialog-form" ).dialog( "open" );
				            }
			            </script>
			            {/literal}
	                    <style>
	                    .pass { background: url({$loct}/images/icon/pass.png)  }
	                    .user { background: url({$loct}/images/icon/user.png)  }
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 150px;">نام کاربری</span>
                                <span style="width: 150px;">ایمیل</span>
                                <span style="width: 80px;">نوع کاربر</span>
                                <span style="width: 70px;" >اعتبار (ریال)</span>
                                <span style="width: 50px;">وضعیت</span>
                                <span style="width: 100px;">ویرایش</span>
                                <span style="width: 50px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $users as $user}
                            <div class="row_1">
                                <span style="width: 150px;font-size:10px;" {if $user->params neq NULL}title="{$user->params}"{/if} >{$user->username|truncate:26:"..":true}</span>
                                <span style="width: 150px;font-size:10px;"  {if $user->email}title="{$user->email}"{/if} >{if $user->email}{$user->email|truncate:26:"..":true}{else}-{/if}</span>
                                <span style="width: 80px;" title="{$GCMS_USER_LEVEL[$user->user_level]}">{$GCMS_USER_LEVEL[$user->user_level]|truncate:12:"..":true}</span>
                                <span style="width: 55px;text-align:left;padding-left:10px;" title="برای ویرایش اعتبار کاربر کلیک کنید" ><a href="javascript:edit_credit({$user->id}, {$user->credit})">{number_format($user->credit)}</a></span> 
                                <span style="width: 50px;">{if $user->status eq "active"}فعال{else}غیرفعال{/if}</span>
                                <span style="width: 45px;"><a href="user/edit/{$user->id}"><div class="icon user" ></div></a></span>
                                <span style="width: 45px;" title="تغییر کلمه عبور"><a href="user/chngpass/{$user->id}"><div class="icon pass" ></div></a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="user/del/{$user->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}" 
                                		title="عضو {$user->username} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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
		                <div class="clear"></div>
		                 
						<div id="dialog-form" title="ویرایش اعتبار کاربر">
						    <form method="post" action="user/edit_credit" class="uniForm">                            
						    <fieldset>
						    	<input type="hidden" name="id_user" id="id_user" />
						    <div class="ctrlHolder">
						        <label for="credit">اعتبار</label>
						        <input type="text" name="credit" id="credit" size="15"  class="textInput latin auto validateInteger required" />
						        <p class="formHint">به ریال</p>
						    </div>
						    </fieldset>
                        
						<div class="buttonHolder" style="text-align:center;">
                            <button type="submit"  name="submit" class="primaryAction">ویرایش</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                        <div class="clear"></div>
                        
						    </form>
						</div>

                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	
	</div>
	<div class="clear"></div>    
</div>