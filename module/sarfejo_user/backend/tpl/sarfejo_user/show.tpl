<div class="wrapper" >
	<div class="right _255 ">
	
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">مدیریت اعضا</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                        <a href="sarfejo_user"><div class="r_menu">
                            <span>لیست اعضا</span>
                            <img src="{$loct}/images/icon/op_ls.png" />
                        </div></a>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">مشاهده مشخصات {$user->name}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                    {$user->name}
	                    <br/>
	                    {$user->email}
	                    <br/>
	                    {$user->cell}
	                    <br/>
	                    وضعیت: {if $user->status eq "active"}فعال{else}غیرفعال{/if}
	                    <br/>
	                    آدرس: {$user->address}
	                    <br/>
	                    تاریخ تولد: {if $user->birthdate neq ""}{jdate(" l j F Y",strtotime($user->birthdate))}{/if}
	                    <br/>
	                    تاریخ عضویت: {jdate(" l j F Y",strtotime($user->created_date))}
	                    <br/>
	                    اعتبار: {$user->credit}
                    

                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	
	</div>
	<div class="clear"></div>    
</div>