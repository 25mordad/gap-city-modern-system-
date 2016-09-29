{if $part eq "box"}
	{$name = "box_content"}
{else if $part eq "comment"}
	{$name = "cm_content"}
{else}
	{$name = "pg_content"}
{/if}

{if $action eq "page_index"}
	{$title ="محتوای صفحه نخست"}
{else if $action eq "newgroup" || $action eq "editgroup"}
	{$title ="شرح گروه خبری"}
{else}
	{$title ="محتوای @@{$part}@@"}
{/if}

{if $action eq "new"}
	{$content_value =""}
{else}
	{$content_value =${$part}->{$name}}
{/if}
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">{$title}</div>
                    <img src="{$loct}/images/icon/content.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    	<div class="ctrlHolder" >
                            <script	type="text/javascript"	src="{$loct}/js/fckeditor/fckeditor.js"></script>
                            <textarea id="{$name}" name="{$name}">{$content_value}</textarea> 
                    		<script type="text/javascript">
                    			var oFCKeditor = new FCKeditor( '{$name}' );
                    			oFCKeditor.BasePath = "{$loct}/js/fckeditor/";
                    			oFCKeditor.ReplaceTextarea( '{$name}',
                            	{
                            		//skin : 'silver' ,
                                    
                            	});
                    		</script>
                        </div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->