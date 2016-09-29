
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">فیلترگذاری</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                
                		<form method="get" action="workbook/list/?" class="uniForm" >
                        <div class="ctrlHolder">
                              <select name="title" id="title" class="selectInput r_size" >
                              	<option value="all">--عنوان کارنامه--</option>
                    			{selectTagGenerator info= $select_title default= "{$smarty.get.title}" }
                              </select>
                              <p class="formHint"></p>
                        </div>
                        <div class="ctrlHolder">
                              <select name="user" id="user" class="selectInput r_size" >
                              	<option value="all">--کاربر--</option>
	                                {foreach $users as $key => $val}
	                                <option value="{$key}" {if $key eq $smarty.get.user }selected="selected"{/if} >{$val}</option>
	                                {/foreach}
                              </select>
                              <p class="formHint"></p>
                        </div>
						<div class="buttonHolder">
                            <button type="submit" class="primaryAction">فیلترگذاری</button>
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
                        
                    {if $smarty.get.title neq "all"}
                        <a href="workbook/list/?paging=1&title=all&user={$smarty.get.user}"><div class="r_menu">
                            <span>حذف فیلتر عنوان کارنامه</span>
                            <img src="{$loct}/images/icon/pg_rm.png" />
                        </div></a>
                    {/if}
                    {if $smarty.get.user neq "all"}
                        <a href="workbook/list/?paging=1&title={$smarty.get.title}&user=all"><div class="r_menu">
                            <span>حذف فیلتر کاربر</span>
                            <img src="{$loct}/images/icon/pg_rm.png" />
                        </div></a>
                    {/if}
                    	<div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->