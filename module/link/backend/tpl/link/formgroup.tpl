{if isset($group_link)}
	{$form_action = "link/editgroup/{$group_link->id}"}
	{$title = "ویرایش"}
{else}
	{$form_action = "link/newgroup"}
	{$title = "ایجاد"}
{/if}

              <!-- _RBOX_ -->
              <div class="r_box {if isset($group_link)}highlights{/if}" >
                <div class="top">
                    <div class="title right">{$title} گروه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">		  
                		<form method="post" action="{$form_action}" class="uniForm" >
                		<div class="ctrlHolder">
                          <p class="label"><em>*</em>نام گروه</p>
	                      <input name="pg_title" id="pg_title" data-default-value="نام گروه" size="19"  type="text" class="textInput required auto" {if isset($group_link)}value="{$group_link->pg_title}"{/if}/>
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