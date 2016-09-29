{if $action eq "newgroup"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">{$title} گروه خبری</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                        <div class="ctrlHolder">
                              <label for="select">گروه خبری مادر</label>
                              <select name="parent_id" id="parent_id" class="selectInput r_size" >
                                <option value="0">بدون گروه مادر</option>
                    			{selectTagGenerator info= $select_group default= "{if isset($news)}{$news->parent_id}{/if}" }
                              </select>
                        </div>
                        
						<div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">{$title}</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->