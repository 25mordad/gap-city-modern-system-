<form method="post" action="page/page_index/{$page->id}" class="uniForm" >
<div class="wrapper" >
	<div class="right _255 ">
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">ویرایش صفحه نخست</div>
                    <img src="{$loct}/images/icon/edit.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
						<div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">به‌روزرسانی</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
        {include file="tpl/box/new_menu.tpl"}
        {include file="tpl/box/list_menu.tpl"}
	</div>    
	<div class="right _765 ">
		{include file="tpl/helper/title.tpl"}
		{include file="tpl/helper/content.tpl"}
		{include file="tpl/helper/browse.tpl"}
	</div>
	<div class="clear"></div>    
</div>
</form>