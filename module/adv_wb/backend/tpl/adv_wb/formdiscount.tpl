{if isset($discount)}
	{$form_action = "adv_wb/editdiscount/{$discount->id}/?paging={$smarty.get.paging}"}
	{$title = "ویرایش"}
{else}
	{$form_action = "adv_wb/newdiscount"}
	{$title = "ایجاد"}
{/if}
<style type="text/css">		
.highlighted {
	border: 2px solid red;
	border-radius: 10px;

}
</style>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
				            function get_users(level)
				            {
							    $.post("http://{$smarty.server.HTTP_HOST}/gadmin/adv_wb/discounts/0/AjaxController?controller=get_users", { level: level }, function(data,status){
							    	$( "#id_user" ).html(data);					      
							    }); 
				            }
                        </script>

              <!-- _RBOX_ -->
              <div class="r_box {if isset($discount)}highlighted{/if}">
                <div class="top">
                    <div class="title right">{$title} تخفیف</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">		                		
                		<form method="post" action="{$form_action}" class="uniForm">
	                		<div class="ctrlHolder">
	                          <label for="rate"><em>*</em>مقدار تخفیف شهریه</label>
		                      <input name="tuition_discount" id="tuition_discount" size="19"  type="text" class="textInput latin auto required validateInteger" {if isset($discount)}value="{$discount->value}"{/if}/>
		                      <p class="formHint">به ریال</p>
		                    </div>
		                    {if isset($discount)}
	                		<div class="ctrlHolder">
	                          <label for="username">نام کاربری</label>
		                      <input name="username" id="username"  size="19"  type="text" class="textInput auto disabled" value="{$discount->username}" disabled="disabled"/>
		                      <p class="formHint"></p>
		                    </div>
		                    {else}
                        	<div class="ctrlHolder">
	                          <label for="level"><em>*</em>نوع کاربر</label>
                              <ul>
                              {foreach $GCMS_USER_LEVEL as $key => $val}
                                <li><label for="level"><input id="" name="level"  type="radio" class="required" onclick="get_users(this.value);" value="{$key}" />{$val}</label></li>
                              {/foreach}
                              </ul>
                              <p class="formHint"></p>
                            </div>
	                        <div class="ctrlHolder">
	                              <label for="id_user"><em>*</em>کاربر</label>
	                              <select name="id_user" id="id_user" class="selectInput r_size required" >
	                              	<option value="">@@Choose@@</option>
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
	                        {/if}
							<div class="buttonHolder">
	                            <button type="submit" name="submit" class="primaryAction">{$title}</button>
	                        </div>
	                        <div class="clear"></div>
                        </form>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->