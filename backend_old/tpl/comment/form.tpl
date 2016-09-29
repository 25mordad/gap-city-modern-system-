              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">ویرایش نظر</div>
                    <img src="{$loct}/images/icon/edit.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $comment->cm_status neq "delete"}
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em>وضعیت نظر
                              </p>
			                    {$cm_status_radio = [['name'=>"در انتظار تایید" , 'value' => "pending"],['name' => "تاییدشده" , 'value' => "publish"]]}
			                    {radioTagGenerator info = $cm_status_radio radioName = "cm_status" ul="true" class="required" default="{$comment->cm_status}"}
                              <p class="formHint"></p>
                    	</div>
                        
						<div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">ویرایش</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                        <div class="clear"></div>
                    {else}
                    	این نظر حذف شده است
                    {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->