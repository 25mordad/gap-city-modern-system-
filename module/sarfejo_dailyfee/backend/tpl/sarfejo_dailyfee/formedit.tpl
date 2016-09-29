{if $smarty.get.edit}
              <!-- _RBOX_ -->
              <div class="r_box highlights" >
                <div class="top">
                    <div class="title right">
                        ویرایش قیمت {$stufe->name}
                    </div>
                    <img src="/core/module/sarfejo_dailyfee/backend/images/stuff.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
		                  <a href="sarfejo_dailyfee?paging={$smarty.get.paging}">&laquo; بازگشت</a>
                		<form method="post" action="{$form_action}" class="uniForm" >
                		<div class="ctrlHolder">

                            <p class="label"><em>*</em>تاریخ </p>
                            <input name="date" id="date"  size="19"  type="text" class="textInput required auto" value="{$stufe->date}"/>
                            <div class="clear" style="padding:10px 0 0 0"></div>

                            <p class="label"><em>*</em>قیمت </p>
                            <input name="fee" id="fee"  size="19"  type="text" class="textInput required auto" value="{$stufe->fee}"/>
                            <div class="clear" style="padding:10px 0 0 0"></div>

                        </div>
	                    
						<div class="buttonHolder">
                            <button type="submit" name="submit" class="primaryAction">ویرایش</button>
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
{/if}