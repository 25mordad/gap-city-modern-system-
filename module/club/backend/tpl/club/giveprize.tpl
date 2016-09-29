<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/club/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">اعطای جایزه به کاربران و گروه‌ها</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    <script>
                    function get_selection(type)
                    {
                        if(type=='user')
                        {
                        	$('#user_ctrl').show();
                        	$('#group_ctrl').hide();
                        	$('#id_user').addClass('required');
                        	$('#id_group').removeClass('required');
                        }
                        if(type=='group')
                        {
                        	$('#user_ctrl').hide();
                        	$('#group_ctrl').show();
                        	$('#id_user').removeClass('required');
                        	$('#id_group').addClass('required');
                        }
                            
                    }    
                    </script>
					<form action="club/giveprize" method="post" class="uniForm">
	                        <fieldset>
                            
                            <div class="ctrlHolder">
	                          <label for="type"><em>*</em>اعطای جایزه به</label>
                              <ul>
                                <li><label for="type"><input id="" name="type"  type="radio" onclick="get_selection(this.value);"  value="user" class="required" />کاربر</label></li>
                                <li><label for="type"><input id="" name="type"  type="radio" onclick="get_selection(this.value);"  value="group" class="required"/>گروه</label></li>
                              </ul>
                              <p class="formHint"></p>
                            </div>
                            
	                        <div class="ctrlHolder" id="user_ctrl" style="display:none;">
	                              <label for="id_user">کاربر</label>
	                              <select name="id_user" id="id_user" class="selectInput" >
	                              	<option value="">@@Choose@@</option>
	                                {foreach $users as $key => $val}
	                                <option value="{$key}" >{$val}</option>
	                                {/foreach}
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
	                        
	                        <div class="ctrlHolder" id="group_ctrl" style="display:none;">
	                              <label for="id_group">گروه</label>
	                              <select name="id_group" id="id_group" class="selectInput required" >
	                              	<option value="">@@Choose@@</option>
	                                {foreach $groups as $key => $val}
	                                <option value="{$key}" >{$val}</option>
	                                {/foreach}
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
	                        
                            <div class="ctrlHolder">
                              <label for="id_point"><em>*</em>انتخاب جایزه</label>
                              <select name="id_point" id="id_point" class="selectInput required">
				                <option value="" selected="selected">-- @@Choose@@ --</option>
	                                {foreach $prizes as $key => $val}
	                                <option value="{$key}" >{$val}</option>
	                                {/foreach}
                              </select>
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
	</div>
	<div class="clear"></div>    
</div>