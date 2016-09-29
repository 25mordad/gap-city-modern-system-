
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">فیلترگذاری</div>
                    <img src="{$loct}/images/icon/filter.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                        <a href="sarfejo_user/?paging=1&search={$smarty.get.search}&f_gender={$smarty.get.f_gender}&f_level=ozv"><div class="r_menu" {if $smarty.get.f_level eq "ozv"}id="act"{/if}>
                            <span>عضو</span>
                            <img src="{$loct}/images/icon/pg_ps.png" />
                        </div></a>                    
                        <a href="sarfejo_user/?paging=1&search={$smarty.get.search}&f_gender={$smarty.get.f_gender}&f_level=senf"><div class="r_menu" {if $smarty.get.f_level eq "senf"}id="act"{/if}>
                            <span>صنف</span>
                            <img src="{$loct}/images/icon/pg_ps.png" />
                        </div></a>                 
                        <a href="sarfejo_user/?paging=1&search={$smarty.get.search}&f_gender={$smarty.get.f_gender}&f_level=sanatgar"><div class="r_menu" {if $smarty.get.f_level eq "sanatgar"}id="act"{/if}>
                            <span>صنعتگر</span>
                            <img src="{$loct}/images/icon/pg_ps.png" />
                        </div></a>
                    {if $smarty.get.f_level neq "all"}
                        <a href="sarfejo_user/?paging=1&search={$smarty.get.search}&f_gender={$smarty.get.f_gender}&f_level=all"><div class="r_menu">
                            <span>حذف فیلتر سطح دسترسی</span>
                            <img src="{$loct}/images/icon/pg_rm.png" />
                        </div></a>
                    {/if}
                        <a href="sarfejo_user/?paging=1&search={$smarty.get.search}&f_gender=female&f_level={$smarty.get.f_level}"><div class="r_menu" {if $smarty.get.f_gender eq "female"}id="act"{/if}>
                            <span>زن</span>
                            <img src="{$loct}/images/icon/pg_ps.png" />
                        </div></a>                    
                        <a href="sarfejo_user/?paging=1&search={$smarty.get.search}&f_gender=male&f_level={$smarty.get.f_level}"><div class="r_menu" {if $smarty.get.f_gender eq "male"}id="act"{/if}>
                            <span>مرد</span>
                            <img src="{$loct}/images/icon/pg_ps.png" />
                        </div></a>
                    {if $smarty.get.f_gender neq "all"}
                        <a href="sarfejo_user/?paging=1&search={$smarty.get.search}&f_gender=all&f_level={$smarty.get.f_level}"><div class="r_menu">
                            <span>حذف فیلتر جنسیت</span>
                            <img src="{$loct}/images/icon/pg_rm.png" />
                        </div></a>
                    {/if}
                    	<div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->