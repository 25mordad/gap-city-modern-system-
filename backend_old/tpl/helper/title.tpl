{if $part eq "box"}
	{$name = "box_title"}
{else if $part eq "poll"}
	{$name = "question"}
{else}
	{$name = "pg_title"}
{/if}

{if $action eq "page_index"}
	{$title ="عنوان صفحه نخست"}
{else if $action eq "newgroup" || $action eq "editgroup"}
	{$title ="عنوان گروه خبری"}
{else}
	{$title ="عنوان @@{$part}@@"}
{/if}

{if $action eq "new"}
	{$title_value =""}
{else}
	{$title_value =${$part}->{$name}}
{/if}

              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">{$title}</div>
                    <img src="{$loct}/images/icon/title.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                        <div class="ctrlHolder">
                            <input name="{$name}" id="{$name}" data-default-value="{$title}"  type="text"  class="textInput large required"  value="{$title_value}" />
                            <p class="formHint" ></p>
                    	</div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->