<div class="wrapper" >
	<div class="right _255 ">
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">تنظیمات سایت</div>
                    <img src="{$loct}/images/icon/settings.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                        <a href="javascript:chtab(1);"><div class="r_menu">
                            <span>تنظیمات عمومی</span>
                            <img src="{$loct}/images/icon/sg_gn.png" />
                        </div></a>
                        <a href="javascript:chtab(2);"><div class="r_menu">
                            <span>تنظیمات موتورهای جستجو</span>
                            <img src="{$loct}/images/icon/sg_so.png" />
                        </div></a>
                        <a href="javascript:chtab(3);"><div class="r_menu">
                            <span>تنظیمات آمـار سایت</span>
                            <img src="{$loct}/images/icon/sg_st.png" />
                        </div></a>
                        <a href="javascript:chtab(4);"><div class="r_menu">
                            <span>تنظیمات صفحات</span>
                            <img src="{$loct}/images/icon/sg_pg.png" />
                        </div></a>
                        <a href="javascript:chtab(5);"><div class="r_menu">
                            <span>تنظیمات نظرات</span>
                            <img src="{$loct}/images/icon/sg_cm.png" />
                        </div></a>
                        <a href="javascript:chtab(6);"><div class="r_menu">
                            <span>تنظیمات سفارشی</span>
                            <img src="{$loct}/images/icon/sg_gn.png" />
                        </div></a>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">تنظیمات سایت</div>
                    <img src="{$loct}/images/icon/settings.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
				<div class="txt">
				{if $smarty.session.level >= 8}
				
					<link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
					<script src="{$loct}/js/jquery.ui.core.js"></script>
					<script src="{$loct}/js/jquery.ui.widget.js"></script>
					<script src="{$loct}/js/jquery.ui.tabs.js"></script>
					{literal}
					<script>
						$(function() {
							$("#tabs").tabs();
							$("#tabs").tabs({
								selected : "tabs-1"
							});
						});
						function chtab(numb) {
							$(function() {
								$("#tabs").tabs();
								$("#tabs").tabs({
									selected : "tabs-" + numb
								});
							});
						}
					</script>
					{/literal}
					<div class="dash_tab">
						<div id="tabs">
							<ul>
								<li><a href="#tabs-1">
										<img src="{$loct}/images/icon/sg_gn.png" />
									</a></li>
								<li><a href="#tabs-2">
										<img src="{$loct}/images/icon/sg_so.png" />
									</a></li>
								<li><a href="#tabs-3">
										<img src="{$loct}/images/icon/sg_st.png" />
									</a></li>
								<li><a href="#tabs-4">
										<img src="{$loct}/images/icon/sg_pg.png" />
									</a></li>
								<li><a href="#tabs-5">
										<img src="{$loct}/images/icon/sg_cm.png" />
									</a></li>
								<li><a href="#tabs-6">
										<img src="{$loct}/images/icon/sg_gn.png" />
									</a></li>
							</ul>
							<div id="tabs-1">
								<div class="static_key">
			                    <!-- FORM -->
			                    <form action="setting/update/" method="post" class="uniForm">
			                            <fieldset>
			                            <h3>تنظیمات عمومی</h3>
			                            
			                            
			                            
			                            <div class="ctrlHolder">
			                            <label for="general|email"><em>*</em>ایمیل مدیر سایت</label>
			                            <input name="general|email" id="general|email" type="text" class="textInput latin required validateEmail" value="{$GCMS_SETTING['general']['email']}" />
			                            <p class="formHint"></p>
			                            </div>
			                            
			                            
			                            
			                            </fieldset>
			                            
										<input type="hidden" name="tabs" value="tabs-1" />
										<input type="hidden" name="stng" value="general" />
			                            
			                            <div class="buttonHolder">
			                            <button type="submit" class="primaryAction">به‌روزرسانی تنظیمات</button>
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
								<!-- /FORM -->
								</div>
							</div>
							<div id="tabs-2">
								<div class="static_key">
			                    <!-- FORM -->
			                    <form action="setting/update/" method="post" class="uniForm">
			                            <fieldset>
			                            <h3>تنظیمات سئو</h3>
			                            
			                            <div class="ctrlHolder">
			                            <label for="seo|title">عنوان سایت</label>
			                            <input name="seo|title" id="seo|title" type="text" class="textInput" value="{$GCMS_SETTING['seo']['title']}" />
			                            <p class="formHint"></p>
			                            </div>
			                            
			                            <div class="ctrlHolder">
			                            <label for="seo|keyword">کلمات کلیدی سایت</label>
			                            <input name="seo|keyword" id="seo|keyword" type="text" class="textInput" value="{$GCMS_SETTING['seo']['keyword']}" />
			                            <p class="formHint"></p>
			                            </div>
			                            
			                            <div class="ctrlHolder">
			                            <label for="seo|description">شرح سایت</label>
			                            <input name="seo|description" id="seo|description" type="text" class="textInput" value="{$GCMS_SETTING['seo']['description']}" />
			                            <p class="formHint"></p>
			                            </div>
			                            
			                            </fieldset>
			                            
										<input type="hidden" name="tabs" value="tabs-2" />
										<input type="hidden" name="stng" value="seo" />
			                            
			                            
			                            <div class="buttonHolder">
			                            <button type="submit" class="primaryAction">به‌روزرسانی تنظیمات</button>
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
								<!-- /FORM -->
								</div>
							</div>
							<div id="tabs-3">
								<div class="static_key">
			                    <!-- FORM -->
			                    <form action="setting/update/" method="post" class="uniForm">
			                            <fieldset>
			                            <h3>تنظیمات آمـار سایت</h3>
			                            
			                            <div class="ctrlHolder">
			                            <label for="statistic|ga_profile_id">شناسه پروفایل</label>
			                            <input name="statistic|ga_profile_id" id="statistic|ga_profile_id" type="text" class="textInput latin" value="{$GCMS_SETTING['statistic']['ga_profile_id']}" />
			                            <p class="formHint"></p>
			                            </div>
			                            
			                            </fieldset>
			                            
										<input type="hidden" name="tabs" value="tabs-3" />
										<input type="hidden" name="stng" value="statistic" />
			                            
			                            <div class="buttonHolder">
			                            <button type="submit" class="primaryAction">به‌روزرسانی تنظیمات</button>
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
								<!-- /FORM -->
								</div>
							</div>
							<div id="tabs-4">
								<div class="static_key">
			                    <!-- FORM -->
			                    <form action="setting/update/" method="post" class="uniForm">
			                            <fieldset>
			                            <h3>تنظیمات صفحات</h3>
			                            
			                            <div class="ctrlHolder">
			                            <label for="page|tpp">نمایش صفحات فرعی</label>
			                            <input name="page|tpp" id="page|tpp" type="text" class="textInput latin" value="{$GCMS_SETTING['page']['tpp']}" />
			                            <p class="formHint">تعداد لیست نمایش صفحات فرعی در سایت</p>
			                            </div>
			                            
			                            </fieldset>
			                            
										<input type="hidden" name="tabs" value="tabs-4" />
										<input type="hidden" name="stng" value="page" />
			                            
			                            <div class="buttonHolder">
			                            <button type="submit" class="primaryAction">به‌روزرسانی تنظیمات</button>
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
								<!-- /FORM -->
								</div>
							</div>
							<div id="tabs-5">
								<div class="static_key">
			                    <!-- FORM -->
			                    <form action="setting/update/" method="post" class="uniForm">
			                            <fieldset>
			                            <h3>تنظیمات نظرات</h3>
			                            
			                            <div class="ctrlHolder">
			                            <label for="comment|email"><em>*</em>ایمیل</label>
			                            <input name="comment|email" id="comment|email" type="text" class="textInput latin required validateEmail" value="{$GCMS_SETTING['comment']['email']}" />
			                            <p class="formHint">ایمیل مدیریت نظرات</p>
			                            </div>
			                            
			                            </fieldset>
			                            
										<input type="hidden" name="tabs" value="tabs-5" />
										<input type="hidden" name="stng" value="comment" />
			                            
			                            <div class="buttonHolder">
			                            <button type="submit" class="primaryAction">به‌روزرسانی تنظیمات</button>
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
								<!-- /FORM -->
								</div>
							</div>

							<div id="tabs-6">
								<div class="static_key">
			                    <!-- FORM -->
			                    <form action="setting/update/" method="post" class="uniForm">
			                            <fieldset>
			                            <h3>تنظیمات سفارشی</h3>
			                            
			                            <div class="ctrlHolder">
			                            <label for="custom|slidno">تعداد اسلاید</label>
			                            <input name="custom|slidno" id="custom|slidno" type="text" class="textInput latin" value="{$GCMS_SETTING['custom']['slidno']}" />
			                            <p class="formHint">تعداد اسلاید تصاویر</p>
			                            </div>
			                            
			                            </fieldset>
			                            
										<input type="hidden" name="tabs" value="tabs-6" />
										<input type="hidden" name="stng" value="custom" />
			                            
			                            <div class="buttonHolder">
			                            <button type="submit" class="primaryAction">به‌روزرسانی تنظیمات</button>
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
								<!-- /FORM -->
								</div>
							</div>



						</div>
						<div class="clear"></div>
					</div>
					
                {else}
				اپراتور گرامی، شما به این بخش دسترسی ندارید.
                {/if}
				</div>
			</div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	
     </div>
<div class="clear"></div>
</div>