{if isset($lesson)}
	{$form_action = "adv_wb/editlesson/{$lesson->id}/?paging={$smarty.get.paging}"}
	{$title = "ویرایش"}
{else}
	{$form_action = "adv_wb/newlesson"}
	{$title = "ایجاد"}
{/if}
<style type="text/css">		
.highlighted {
	border: 2px solid red;
	border-radius: 10px;

}
</style>

              <!-- _RBOX_ -->
              <div class="r_box {if isset($lesson)}highlighted{/if}">
                <div class="top">
                    <div class="title right">{$title} درس</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">		                		
                		<form method="post" action="{$form_action}" class="uniForm">
                		<div class="ctrlHolder">
                          <label for="name"><em>*</em>نام</label>
	                      <input name="name" id="name" data-default-value="نام درس" size="19"  type="text" class="textInput required auto" {if isset($lesson)}value="{$lesson->name}"{/if}/>
	                      <p class="formHint"></p>
	                    </div>
                        <div class="ctrlHolder">
                              <label for="id_parent">پیش‌نیاز</label>
                              <select name="id_parent" id="id_parent" class="selectInput r_size" >
                              	<option value="0" selected="selected">-- بدون پیش‌نیاز --</option>
	                                {foreach $select_lesson as $key => $val}
	                                <option value="{$key}" {if isset($lesson) && $lesson->id_parent eq $key }selected="selected"{/if} >{$val}</option>
	                                {/foreach}
                              </select>
                              <p class="formHint"></p>
                        </div>
                		<div class="ctrlHolder">
                          <label for="rate">ضریب</label>
	                      <input name="rate" id="rate" size="19"  type="text" class="textInput latin auto validateNumber" {if isset($lesson)}value="{$lesson->rate}"{/if}/>
	                      <p class="formHint"></p>
	                    </div>
                		<div class="ctrlHolder">
                          <label for="code">کد درس</label>
	                      <input name="code" id="code" size="19"  type="text" class="textInput latin auto" {if isset($lesson)}value="{$lesson->code}"{/if}/>
	                      <p class="formHint"></p>
	                    </div>
                		<div class="ctrlHolder">
                          <label for="accept_score">نمره قبولی</label>
	                      <input name="accept_score" id="accept_score" size="19"  type="text" class="textInput latin auto validateNumber" {if isset($lesson)}value="{$lesson->accept_score}"{/if}/>
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