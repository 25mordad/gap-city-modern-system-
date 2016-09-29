<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/operator/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست کاربران</div>
                    <img src="{$loct}/images/icon/list.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    <style>
                    .pass { background: url({$loct}/images/icon/pass.png)  }
                    .user { background: url({$loct}/images/icon/user.png)  }
                    </style>
                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 130px;">نام</span>
                                <span style="width: 90px;">نام کاربری</span>
                                <span style="width: 140px;">ایمیل</span>
                                <span style="width: 80px;">سطح دسترسی</span>
                                <span style="width: 60px;">وضعیت</span>
                                <span style="width: 60px;">ویرایش</span>
                                <span style="width: 90px;">تغییر کلمه عبور</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $operators as $opt}
                            {if $smarty.session.level >= $opt->op_level}
                            <div class="row_1">
                                <span style="width: 130px;" class="BYekan">{$opt ->name}</span>
                                <span style="width: 90px;">{$opt ->username}</span>
                                <span style="width: 140px;">{$opt ->email}</span>
                                <span style="width: 80px;">{if $opt ->op_level eq 6}اپراتور{else}مدیر{/if}</span>
                                <span style="width: 60px;">{if $opt ->status eq "true"}فعال{else}غیرفعال{/if}</span>
                                <span style="width: 60px;"><a href="operator/edit/{$opt->id}"><div class="icon user" ></div></a></span>
                                <span style="width: 80px;" class="last"><a href="operator/pass/{$opt->id}"><div class="icon pass" ></div></a></span>
                                <div class="clear"></div>
                            </div>
                            {/if}
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
