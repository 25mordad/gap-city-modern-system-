<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/discount/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست کاربران خریدار تخفیف {$discount->title}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 60px;">نام کاربری</span>
                                <span style="width: 160px;">ایمیل</span>
                                <span style="width: 100px;">روز خرید</span>
                                <span style="width: 100px;">ساعت خرید</span>
                                <span style="width: 70px;">شماره کوپن</span>
                                <span style="width: 120px;">رمز کوپن</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $users as $user}
                            <div class="row_1">
                                <span style="width: 60px;font-size:10px;" title="{$user->name}">{$user->username|truncate:20:"..":true}</span>
                                <span style="width: 160px;font-size:10px;font-weight: bold" title="{$user->cell}">{$user->email|truncate:30:"..":true}</span>
                                <span style="width: 100px;font-size:11px;">{miladi_to_shamsi($user->date_sell)}</span>
                                <span style="width: 100px;font-size:11px;">{($user->date_sell)|date_format:'%H:%M:%S'}</span>
                                <span style="width: 60px;font-size:10px;" title="{$user->coupon_no}">{$user->coupon_no|truncate:20:"..":true}</span>
                                <span style="width: 120px;font-size:11px;font-weight: bold" title="{$user->coupon_pass}" class="last">{$user->coupon_pass}</span>
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