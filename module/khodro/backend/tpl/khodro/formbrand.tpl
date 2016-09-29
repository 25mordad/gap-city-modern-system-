{if isset($smarty.get.edit)}
	{$form_action = "khodro/brand?edit={$brand->id}&form=post"}
	{$title = "ویرایش"}
{else}
	{$form_action = "khodro/brand?new=true"}
	{$title = "ایجاد"}
{/if}
<style type="text/css">		
.highlighted {
	border: 1px solid red;
	border-radius: 10px;

}
</style>

              <!-- _RBOX_ -->
              <div class="r_box {if isset($smarty.get.edit)}highlights{/if}">
                <div class="top">
                    <div class="title right">{$title} برند</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">		                		
                		<form method="post" action="{$form_action}" class="uniForm">
                		<div class="ctrlHolder">
                          <p class="label"><em>*</em>نام برند</p>
	                      <input name="name" id="name" data-default-value="نام برند" size="19"  type="text" class="textInput required auto" {if isset($smarty.get.edit)}value="{$brand->name}"{/if}/>
	                      <p class="formHint"></p>
	                    </div>
	                    
						<div class="buttonHolder">
                            <button type="submit" name="submit" class="primaryAction">{$title}</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                        <div class="clear"></div>
                        </form>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->