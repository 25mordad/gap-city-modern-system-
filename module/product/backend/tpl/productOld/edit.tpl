<form method="post" action="product/edit/{$product->id}" class="uniForm" >
<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/product/form.tpl"}
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/keyword.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
		{include file="tpl/product/info.tpl"}
        {include file="tpl/product/menu.tpl"}
	</div>    
	<div class="right _765 ">
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/title.tpl"}
		{include file="tpl/helper/content.tpl"}
		{include file="tpl/helper/excerpt.tpl"}
		{include file="tpl/helper/browse.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
</form>
<form method="post" action="product/edit/{$product->id}" class="uniForm2" >
               <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست پارامترهای محصول</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
							<fieldset>
                            {foreach $params as $row}
	                            <div class="ctrlHolder">
	                            <label for="title"><a href="/gadmin/product/add_param/{$product->parent_id}?edit={$row->id}">{$row->param_name}</a> ({$row->param_tag})</label>
	                            <input name="value_{$param_vals[$row->id]["rel_id"]}" id="title" type="text" class="textInput " value="{$param_vals[$row->id]["value"]}"/>
	                            <p class="formHint"></p>
	                            </div>
							{/foreach}
                            {foreach $dadparams as $row}
                                <div class="ctrlHolder">
                                    <label for="title"><a href="/gadmin/product/add_param/{$product->parent_id}?edit={$row->id}">{$row->param_name}</a> ({$row->param_tag})</label>
                                    <input name="value_{$param_vals[$row->id]["rel_id"]}" id="title" type="text" class="textInput " value="{$param_vals[$row->id]["value"]}"/>
                                    <p class="formHint"></p>
                                </div>
                            {/foreach}
                            </fieldset>
                            <div class="buttonHolder">
                            <button type="submit"  name="update_params" class="primaryAction">به‌روزرسانی پارامترها</button>
                            </div>
                        
                        
                        <div class="clear"></div>
                        <script>
                          $(function(){
                            $('form.uniForm2').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->			
	</div>
	<div class="clear"></div>    
</div>
</form>