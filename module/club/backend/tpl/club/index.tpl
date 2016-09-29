<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/club/menu.tpl"}
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
                    <div class="title right">لیست اعضای باشگاه مشتریان</div>
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
				            	$(".confirm_dialog").easyconfirm( { locale: $.easyconfirm.locales.faIR } );
				            });
			            </script>
			            {/literal}
	                    <style>
	                    .pass { background: url({$loct}/images/icon/pass.png)  }
	                    .user { background: url({$loct}/images/icon/user.png)  }
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 200px;">نام و نام خانوادگی</span>
                                <span style="width: 150px;">نام کاربری</span>
                                <span style="width: 100px;">ویرایش</span>
                                <span style="width: 50px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $users as $user}
                            <div class="row_1">
                            	<span style="width: 200px;" class="BYekan" >{$user->name|truncate:26:"..":true}</span>
                                <span style="width: 150px;font-size:10px;" >{$user->username|truncate:26:"..":true}</span>
                                <span style="width: 45px;"><a href="club/edituser/{$user->id}"><div class="icon user" ></div></a></span>
                                <span style="width: 45px;" title="تغییر کلمه عبور"><a href="club/chngpass/{$user->id}"><div class="icon pass" ></div></a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="club/deluser/{$user->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}" 
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
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	
	</div>
	<div class="clear"></div>    
</div>