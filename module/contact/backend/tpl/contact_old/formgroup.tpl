{if isset($group_contact)}
	{$form_action = "contact/editgroup/{$group_contact->id}"}
	{$title = "ویرایش"}
{else}
	{$form_action = "contact/newgroup"}
	{$title = "ایجاد"}
{/if}

              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">{$title} گروه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">		                		
		              {if !isset($group_contact) || $group_contact->status eq "active"}
                		<form method="post" action="{$form_action}" class="uniForm" >
                		<div class="ctrlHolder">
                          <p class="label"><em>*</em>نام گروه</p>
	                      <input name="name" id="name" data-default-value="نام گروه" size="19"  type="text" class="textInput required auto" {if isset($group_contact)}value="{$group_contact->name}"{/if}/>
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
                        <p>این گروه حذف شده است</p>
		                <p style="margin-top:10px;text-align:center;">
		                	<a href="contact/undelgroup/{$group_contact->id}" title="گروه {$group_contact->name} بازیابی شود؟"  class="del_btn confirm_del" >بازیابی گروه</a>
		                </p>
		                {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->