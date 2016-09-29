{if isset($thisstuff) }
	{$form_action = "sarfejo_dailyfee/stuffs/?edit={$thisstuff->id}"}
	{$title = "ویرایش"}
{else}
	{$form_action = "sarfejo_dailyfee/newstuff"}
	{$title = "ایجاد"}
{/if}

              <!-- _RBOX_ -->
              <div class="r_box {if isset($thisstuff)}highlights{/if}" >
                <div class="top">
                    <div class="title right">{$title} کالا</div>
                    <img src="/core/module/sarfejo_dailyfee/backend/images/stuff.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                          {if isset($thisstuff)}
		                  <a href="sarfejo_dailyfee/stuffs">&laquo; بازگشت</a>
                          {/if}
                		<form method="post" action="{$form_action}" class="uniForm" >
                		<div class="ctrlHolder">

                          <p class="label"><em>*</em>نام کالا</p>
	                      <input name="name" id="name" data-default-value="نام کالا" size="19"  type="text" class="textInput required auto" {if isset($thisstuff)}value="{$thisstuff->name}"{/if}/>
                          <div class="clear" style="padding:10px 0 0 0"></div>

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