{if isset($discount_group)}
	{$form_action = "discount/editgroup/{$discount_group->id}"}
	{$title = "ویرایش"}
{else}
	{$form_action = "discount/newgroup"}
	{$title = "ایجاد"}
{/if}

              <!-- _RBOX_ -->
              <div class="r_box {if isset($discount_group)}highlights{/if}" >
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
	                      <input name="name" id="name" data-default-value="نام گروه" size="19"  type="text" class="textInput required auto" {if isset($discount_group)}value="{$discount_group->name}"{/if}/>
	                      <p class="formHint"></p>
	                    </div>
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em>وضعیت گروه
                              </p>
			                    {$status_radio = [['name'=>"غیرفعال" , 'value' => "pending"],['name' => "فعال" , 'value' => "active"]]}
			                    {radioTagGenerator info = $status_radio radioName = "status" ul="true" class="required" default="{if isset($discount_group)}{$discount_group->status}{/if}"}
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