{if $action eq "new"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}
	
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">{$title} منو</div>
                    <img src="{$loct}/images/icon/{$action}.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					<form action="menu/{$action}{if isset($menu)}/{$menu->id}{/if}" method="post" class="uniForm">
					<fieldset>
                            
                            <div class="ctrlHolder">
                            <label for="title"><em>*</em>عنوان منو</label>
                            <input name="title" id="title" type="text" class="textInput required "{if isset($menu)}value="{$menu->title}"{/if}/>
                            <p class="formHint"></p>
                            </div>
					
                            <div class="ctrlHolder">
                            <label for="order"><em>*</em>ترتیب منو</label>
                            <input name="order" id="order" type="text" class="textInput latin required validateInteger" {if isset($menu)}   value="{$menu->order}"{/if}/>
                            <p class="formHint">یک عدد صحیح است که ترتیب قرار گرفتن منو در سایت را تعیین می‌کند<br>با ترتیب منوهای دیگر مقایسه و مکان منو در سایت مشخص می‌شود</p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="link"><em>*</em>لینک منو</label>
                            <input name="link" id="link" type="text" class="textInput latin required"{if isset($menu)}value="{$menu->link}"{/if}/>
                            <p class="formHint">آدرس نسبی به صفحه مورد نظر<br>مثال: gallery/</p>
                            </div>
		               
	                        <div class="ctrlHolder">
	                        	<label for="parent">انتخاب منوی مادر</label>
	                              <select name="parent" id="parent" class="selectInput" >
	                                <option value="0" selected="selected">بدون منوی مادر</option>
	                                {foreach $main_menu as $key => $val}
	                                <option value="{$key}" {if isset($menu) && $menu->parent eq $key }selected="selected"{/if} >{$val}</option>
	                                {/foreach}
	                              </select>
	                              <p class="formHint">در صورت تمایل به داشتن منوهای دراپ‌داون از این گزینه استفاده کنید</p>
	                        </div>	  
                        
                            </fieldset>
                            <div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">{$title}</button>
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
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->