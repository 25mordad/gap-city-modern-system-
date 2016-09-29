{if isset($group_product) }
	{$form_action = "product/grouping/?edit={$group_product->id}"}
	{$title = "ویرایش"}
{else}
	{$form_action = "product/newgroup"}
	{$title = "ایجاد"}
{/if}

              <!-- _RBOX_ -->
              <div class="r_box {if isset($group_product)}highlights{/if}" >
                <div class="top">
                    <div class="title right">{$title} گروه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                          {if isset($group_product)}		                		
		                  <a href="product/grouping/">&laquo; بازگشت</a>
                          {/if}
                		<form method="post" action="{$form_action}" class="uniForm" >
                		<div class="ctrlHolder">
                          <p class="label"><em>*</em>انتخاب گروه مادر</p>
							<select name="parent_id" id="parent_id" class="selectInput r_size" >
                                <option value="0" > -- @@no_parent@@ --</option>
                    			{foreach $groups as $group}
                    			<option value="{$group->id}" {if isset($group_product) and $group->id eq $group_product->parent_id }selected="selected"{/if}>{$group->pg_title}</option>
                    			{/foreach}
                              </select>
                          <div class="clear" style="padding:10px 0 0 0"></div>
                          <p class="label"><em>*</em>نام گروه</p>
	                      <input name="pg_title" id="pg_title" data-default-value="نام گروه" size="19"  type="text" class="textInput required auto" {if isset($group_product)}value="{$group_product->pg_title}"{/if}/>
                          <div class="clear" style="padding:10px 0 0 0"></div>
                          <p class="label">توضیحات گروه</p>
                          <input name="pg_content" id="pg_content" data-default-value="توضیحات" size="19"  type="text" class="textInput auto" {if isset($group_product)}value="{$group_product->pg_content}"{/if}/> 
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