              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">ارسال خبرنامه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                   
					<form action="contact/sendnewsletter?send=true" method="post" class="uniForm">
					این خبرنامه به {$contactcount} نفر ارسال می شود.
					<fieldset>
                            
                            <div class="ctrlHolder">
                            <label for="title"><em>*</em>عنوان خبرنامه</label>
                            <input name="title" id="title" type="text" class="textInput required "  />
                            <p class="formHint"></p>
                            </div>
					
                           
	                        <div class="ctrlHolder">
	                        	<label for="text">متن خبرنامه</label>
	                              <textarea name="text" id="text" class="large required" style="width: 600px"></textarea>
	                              <p class="formHint"></p>
	                        </div>	  
                        
                            </fieldset>
                            <div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">ارسال</button>
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