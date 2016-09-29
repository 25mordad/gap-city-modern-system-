
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">امکانات دفترچه تلفن</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                        <a href="contact/new"><div class="r_menu">
                            <span>ایجاد تماس جدید</span>
                            <img src="{$loct}/images/icon/ns_nw.png" />
                        </div></a>
                        <a href="contact/index"><div class="r_menu">
                            <span>لیست تماس‌ها</span>
                            <img src="{$loct}/images/icon/page.png" />
                        </div></a>
                        <a href="contact/grouping"><div class="r_menu">
                            <span>گروه‌بندی</span>
                            <img src="{$loct}/images/icon/ns_ng.png" />
                        </div></a>
                        {if isset($GCMS_SETTING['contact']['newsletter']) and $GCMS_SETTING['contact']['newsletter'] eq "true" }
                        <a href="contact/sendnewsletter"><div class="r_menu">
                            <span>ارسال خبرنامه</span>
                            <img src="{$loct}/images/icon/ns_nw.png" />
                        </div></a>
                        {/if}
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->