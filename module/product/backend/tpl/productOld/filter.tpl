
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">فیلترگذاری</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                
                		<form method="get" action="product/?" class="uniForm" >
                        <div class="ctrlHolder">
                              <select name="f_parent" id="f_parent" class="selectInput r_size" >
                                <option value="all">انتخاب گروه محصولات</option>
                    			{selectTagGenerator info= $select_parent default= "{if $smarty.get.f_parent neq "all"}{$smarty.get.f_parent}{/if}" }
                              </select>
                        </div>
	                    <input type="hidden" name="f_status" value="{$smarty.get.f_status}" />
	                    <input type="hidden" name="search" value="{$smarty.get.search}" />
	                    
                        
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
                        
                    {if $smarty.get.f_parent neq "all"}
                        <a href="product/?paging=1&search={$smarty.get.search}&f_parent=all&f_status={$smarty.get.f_status}"><div class="r_menu">
                            <span>حذف فیلتر گروه</span>
                            <img src="{$loct}/images/icon/pg_rm.png" />
                        </div></a>
                    {/if}
                        <a href="product/?paging=1&search={$smarty.get.search}&f_parent={$smarty.get.f_parent}&f_status=publish"><div class="r_menu" {if $smarty.get.f_status eq "publish"}id="act"{/if}>
                            <span>محصولات انتشاریافته</span>
                            <img src="{$loct}/images/icon/pg_ps.png" />
                        </div></a>                    
                        <a href="product/?paging=1&search={$smarty.get.search}&f_parent={$smarty.get.f_parent}&f_status=pending"><div class="r_menu" {if $smarty.get.f_status eq "pending"}id="act"{/if}>
                            <span>محصولات در دست بررسی</span>
                            <img src="{$loct}/images/icon/pg_pn.png" />
                        </div></a>
                    {if $smarty.get.f_status neq "all"}
                        <a href="product/?paging=1&search={$smarty.get.search}&f_parent={$smarty.get.f_parent}&f_status=all"><div class="r_menu">
                            <span>حذف فیلتر وضعیت صفحه</span>
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