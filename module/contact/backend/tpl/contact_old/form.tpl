{if $action eq "new"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}
	
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">{$title} تماس</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if !isset($contact) || $contact->status eq "active"}
					<form action="contact/{$action}{if isset($contact)}/{$contact->id}{/if}" method="post" class="uniForm">
					<fieldset>
                            
                            <div class="ctrlHolder">
                            <label for="name"><em>*</em>نام و نام خانوادگی</label>
                            <input name="name" id="name" type="text" class="textInput required " {if isset($contact)}value="{$contact->name}"{/if}/>
                            <p class="formHint"></p>
                            </div>
					
                            <div class="ctrlHolder">
                            <label for="cell"><em>*</em>شماره تماس</label>
                            <input name="cell" id="cell" type="text" class="textInput latin required validatePhone" {if isset($contact)}value="{$contact->cell}"{/if}/>
                            <p class="formHint">مثال: 09125521340</p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="email">ایمیل</label>
                            <input name="email" id="email" type="text" class="textInput latin validateEmail" {if isset($contact)}value="{$contact->email}"{/if} />
                            <p class="formHint"></p>
                            </div>
                           
	                        <div class="ctrlHolder">
	                        	<label for="id_group">گروه</label>
	                              <select name="id_group" id="id_group" class="selectInput" >
	                                <option value="0" selected="selected">--بدون گروه--</option>
	                                {foreach $group_contacts as $key => $val}
	                                <option value="{$key}" {if isset($contact) && $contact->id_group eq $key }selected="selected"{/if} >{$val}</option>
	                                {/foreach}
	                              </select>
	                              <p class="formHint"></p>
	                        </div>	  
                        
                            </fieldset>
                            <div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">{$title}</button>
                            </div>
                        
                        
                        <div class="clear"></div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
					</form>
                        {else}
				                <script src="{$loct}/js/jquery-ui-1.7.2.custom.min.js"></script>
				                <link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
								<script src="{$loct}/js/jquery.easy-confirm-dialog.js"></script>
		                		{literal}
		                		<script>
		                		$(function() {
		                			$(".confirm_del").easyconfirm({locale: $.easyconfirm.locales.faIR});
		                		});
		                		</script>
		                		{/literal}	
                        <p>این تماس حذف شده است</p>
		                <p style="margin-top:10px;text-align:center;">
		                	<a href="contact/undel/{$contact->id}" title="تماس {$contact->name} بازیابی شود؟"  class="del_btn confirm_del" >بازیابی تماس</a>
		                </p>
		                {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->