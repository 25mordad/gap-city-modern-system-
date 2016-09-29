
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">فیلترگذاری</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                
                		<form method="get" action="adv_wb/?" class="uniForm" >
                        <div class="ctrlHolder">
                              <select name="branch" id="branch" class="selectInput r_size" >
                              	<option value="all">--شعبه--</option>
	                                {foreach $branches as $key => $val}
	                                <option value="{$key}" {if $smarty.get.branch eq $key }selected="selected"{/if} >{$val}</option>
	                                {/foreach}
                              </select>
                              <p class="formHint"></p>
                        </div>
                        <div class="ctrlHolder">
                              <select name="grade" id="grade" class="selectInput r_size" >
                              	<option value="all">--پایه--</option>
	                                {foreach $grades as $key => $val}
	                                <option value="{$key}" {if $smarty.get.grade eq $key }selected="selected"{/if} >{$val}</option>
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
                        
                    {if $smarty.get.branch neq "all"}
                        <a href="adv_wb/?paging=1&search={$smarty.get.search}&branch=all&grade={$smarty.get.grade}"><div class="r_menu">
                            <span>حذف فیلتر شعبه</span>
                            <img src="{$loct}/images/icon/pg_rm.png" />
                        </div></a>
                    {/if}
                    {if $smarty.get.grade neq "all"}
                        <a href="adv_wb/?paging=1&search={$smarty.get.search}&branch={$smarty.get.branch}&grade=all"><div class="r_menu">
                            <span>حذف فیلتر پایه</span>
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