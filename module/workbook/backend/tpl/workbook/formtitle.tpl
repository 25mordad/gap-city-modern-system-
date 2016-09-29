{if isset($workbook_title)}
	{$form_action = "workbook/edittitle/{$workbook_title->id}"}
	{$title = "ویرایش"}
{else}
	{$form_action = "workbook/newtitle"}
	{$title = "ایجاد"}
{/if}

              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">{$title} عنوان کارنامه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">		                		
		              {if !isset($workbook_title) || $workbook_title->pg_status eq "publish"}
                		<form method="post" action="{$form_action}" class="uniForm" >
                		<div class="ctrlHolder">
                          <p class="label"><em>*</em>نام</p>
	                      <input name="pg_title" id="pg_title" data-default-value="عنوان کارنامه" size="19"  type="text" class="textInput required auto" {if isset($workbook_title)}value="{$workbook_title->pg_title}"{/if}/>
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
                        <p>این عنوان کارنامه حذف شده است</p>
		                <p style="margin-top:10px;text-align:center;">
		                	<a href="workbook/undeltitle/{$workbook_title->id}" title="عنوان کارنامه {$workbook_title->pg_title} بازیابی شود؟"  class="del_btn confirm_del" >بازیابی عنوان کارنامه</a>
		                </p>
		                {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->