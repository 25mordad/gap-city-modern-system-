
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">فیلترگذاری</div>
                    <img src="{$loct}/images/icon/filter.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                        <a href="comment/?paging=1&search={$smarty.get.search}&cm_type={$smarty.get.cm_type}&cm_status=publish"><div class="r_menu" {if $smarty.get.cm_status eq "publish"}id="act"{/if}>
                            <span>نظرهای تاییدشده</span>
                            <img src="{$loct}/images/icon/pg_ps.png" />
                        </div></a>                    
                        <a href="comment/?paging=1&search={$smarty.get.search}&cm_type={$smarty.get.cm_type}&cm_status=pending"><div class="r_menu" {if $smarty.get.cm_status eq "pending"}id="act"{/if}>
                            <span>نظرهای در انتظار تایید</span>
                            <img src="{$loct}/images/icon/pg_pn.png" />
                        </div></a>
                    {if $smarty.get.cm_status neq "all"}
                        <a href="comment/?paging=1&search={$smarty.get.search}&cm_type={$smarty.get.cm_type}&cm_status=all"><div class="r_menu">
                            <span>حذف فیلتر وضعیت نظر</span>
                            <img src="{$loct}/images/icon/pg_rm.png" />
                        </div></a>
                    {/if}
                    {if $GCMS_MODULE['news'] eq "active" || $GCMS_MODULE['gallery'] eq "active" || $GCMS_MODULE['sound'] eq "active"}
                        <a href="comment/?paging=1&search={$smarty.get.search}&cm_type=page&cm_status={$smarty.get.cm_status}"><div class="r_menu" {if $smarty.get.cm_type eq "page"}id="act"{/if}>
                            <span>نظرهای بخش صفحات</span>
                            <img src="{$loct}/images/icon/page.png" />
                        </div></a>
                    {/if}
                    {if $GCMS_MODULE['news'] eq "active"}
                        <a href="comment/?paging=1&search={$smarty.get.search}&cm_type=news&cm_status={$smarty.get.cm_status}"><div class="r_menu" {if $smarty.get.cm_type eq "news"}id="act"{/if}>
                            <span>نظرهای بخش اخبار</span>
                            <img src="{$loct}/images/icon/news.png" />
                        </div></a>
                    {/if}
                    {if $GCMS_MODULE['gallery'] eq "active"}
                        <a href="comment/?paging=1&search={$smarty.get.search}&cm_type=gallery&cm_status={$smarty.get.cm_status}"><div class="r_menu" {if $smarty.get.cm_type eq "gallery"}id="act"{/if}>
                            <span>نظرهای بخش گالری عکس</span>
                            <img src="{$loct}/images/icon/gallery.png" />
                        </div></a>
                    {/if}
                    {if $GCMS_MODULE['sound'] eq "active"}
                        <a href="comment/?paging=1&search={$smarty.get.search}&cm_type=sound&cm_status={$smarty.get.cm_status}"><div class="r_menu" {if $smarty.get.cm_type eq "sound"}id="act"{/if}>
                            <span>نظرهای بخش گالری صوتی</span>
                            <img src="{$loct}/images/icon/sound.png" />
                        </div></a>
                    {/if}
                    {if $smarty.get.cm_type neq "all"}
                        <a href="comment/?paging=1&search={$smarty.get.search}&cm_type=all&cm_status={$smarty.get.cm_status}"><div class="r_menu">
                            <span>حذف فیلتر بخش نظر</span>
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