
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">فیلترگذاری</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                
                		<form method="get" action="contact/?" class="uniForm" >
                        <div class="ctrlHolder">
                              <select name="id_group" id="id_group" class="selectInput r_size" >
                                <option value="all">--انتخاب گروه--</option>
                                {foreach $group_contacts as $key => $val}
                                <option value="{$key}" {if $key eq $smarty.get.id_group}selected="selected"{/if} >{$val}</option>
                                {/foreach}
                              </select>
                        </div>	                    
                        
						<div class="buttonHolder">
                            <button type="submit" class="primaryAction">فیلتر گروه</button>
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
                        
                    {if $smarty.get.id_group neq "all"}
                        <a href="contact/?paging=1&search={$smarty.get.search}&id_group=all"><div class="r_menu">
                            <span>حذف فیلتر گروه</span>
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