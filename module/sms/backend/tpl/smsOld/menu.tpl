
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">امکانات پیام کوتاه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                        <a href="sms/?single=true"><div class="r_menu">
                            <span>ارسال پیام تکی</span>
                            <img src="{$loct}/images/icon/ns_nw.png" />
                        </div></a>
                        <a href="sms/interval"><div class="r_menu">
                            <span>ارسال پیام بازه‌ای</span>
                            <img src="{$loct}/images/icon/ns_nw.png" />
                        </div></a>
                        <a href="sms"><div class="r_menu">
                            <span>ارسال پیام گروهی</span>
                            <img src="{$loct}/images/icon/ns_nw.png" />
                        </div></a>
                        {if $GCMS_MODULE['user'] eq "active"}
                        <a href="sms/user"><div class="r_menu">
                            <span>ارسال پیام به اعضا</span>
                            <img src="{$loct}/images/icon/ns_nw.png" />
                        </div></a>
                        {/if}
                        <a href="sms/sendbox"><div class="r_menu">
                            <span>پیام‌های ارسالی</span>
                            <img src="{$loct}/images/icon/page.png" />
                        </div></a>
                        {if $GCMS_SETTING['sms']['inbox'] eq "true"}
                        <a href="sms/inbox"><div class="r_menu">
                            <span>پیام‌های دریافتی</span>
                            <img src="{$loct}/images/icon/page.png" />
                        </div></a>
                        {/if}
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->