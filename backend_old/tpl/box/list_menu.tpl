{if $part eq "box"}
	{$title = "باکس‌های مرتبط"}
{else if $action eq "index"}
	{$title = "لیست باکس‌های عمومی"}
{else}
	{$title = "لیست باکس‌های صفحه"}
{/if}
{if count($boxes) > 0 }
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">{$title}</div>
                    <img src="{$loct}/images/icon/box.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
		                {foreach $boxes as $bx}
                        <a href="box/edit/{$bx->id}"><div class="r_menu">
                            <span>{$bx->box_title|truncate:25:"..":true}</span>
                            <img src="{$loct}/images/icon/pg_bx.png" />
                        </div></a>
		                {/foreach}
		                <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
{/if}           