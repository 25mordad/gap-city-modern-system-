<form method="post" action="sms/send" class="uniForm" >
<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/sms/form.tpl"}
    	{include file="tpl/sms/info.tpl"}
    	{include file="tpl/sms/menu.tpl"}
	</div>
	<div class="right _765 ">  	
    	{include file="tpl/sms/text.tpl"}
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">انتخاب شماره همراه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
		                {if isset($smarty.get.single) and $smarty.get.single eq "true" }
                            <div class="ctrlHolder">
	                            <label for="cell"><em>*</em>شماره تماس</label>
	                            	<input name="cell" id="cell" type="text" class="textInput latin required validatePhone" {if isset($smarty.get.cell)}value="{$smarty.get.cell}"{/if}/>
	                            <p class="formHint">مثال: 09125521340</p>
                            </div>
                        {else}    
		               	{literal}
		                    <script type="text/javascript">
						      my_submit_callback = function(form) {
						        
						        // Are at least two selectd?
						        if ($('input.cell_selection:checked').length < 1) {
						          // show the error
						          $('#cell_select').addClass('error');
						          return false;
						        }
						        $('#cell_select').removeClass('error');
						        return true;
						      }
						
						      $(function(){
						        $('form.uniForm').uniform({
						            submit_callback : my_submit_callback
						        });
						      });
						      
						    </script>
						{/literal}
			                {if isset($smarty.get.interval) and $smarty.get.interval eq "true" }
				                <div class="ctrlHolder" id="cell_select">
				                <h3>انتخاب در بازه {$smarty.post.base}{$smarty.post.from_no} تا {$smarty.post.base}{$smarty.post.to_no}</h3>
		                              <p class="formHint">حداقل باید یک تماس را انتخاب کنید</p>
		                        </div>  
			                        <div class="ctrlHolder">
			                        	<p class="label">شماره‌های محاسبه‌شده</p>
			                              <ul>
			                              {foreach $cells as $cell}
								            {if $cell neq ""}
								            <li><label for="{$cell}"><input type="checkbox" value="{$cell}" name="cell[]"  class="cell_selection" checked="checked" />{$cell}</label></li>
								            {/if}
								          {/foreach}
			                              </ul>
			                        	<p class="formHint"></p>
			                        </div>
			                {elseif isset($smarty.get.user) and $smarty.get.user eq "true" }
				                <div class="ctrlHolder" id="cell_select">
				                <h3>انتخاب {$GCMS_USER_PARAM[$smarty.post.cell]} {$GCMS_USER_LEVEL[$smarty.post.level]}</h3>
		                              <p class="formHint">حداقل باید یک تماس را انتخاب کنید</p>
		                        </div>  
			                        <div class="ctrlHolder">
			                        	<p class="label">شماره‌های اعضا</p>
			                              <ul>
			                              {foreach $users as $user}
								            {if $user->value neq ""}
								            <li><label for="{$user->value}"><input type="checkbox" value="{$user->value}" name="cell[]"  class="cell_selection" checked="checked" />{$user->username} | {$user->value}</label></li>
								            {/if}
								          {/foreach}
			                              </ul>
			                        	<p class="formHint"></p>
			                        </div>
			                {else}
			               		{literal}
			                    <script type="text/javascript">
			                    function insert_param(key, value) {
			                        key = escape(key); value = escape(value);
			
			                        var kvp = document.location.search.substr(1).split('&');
			                        if (kvp == '') {
			                            document.location.search = '?' + key + '=' + value;
			                        }
			                        else {
			
			                            var i = kvp.length; var x; while (i--) {
			                                x = kvp[i].split('=');
			
			                                if (x[0] == key) {
			                                    x[1] = value;
			                                    kvp[i] = x.join('=');
			                                    break;
			                                }
			                            }
			
			                            if (i < 0) { kvp[kvp.length] = [key, value].join('='); }
			
			                            //this will reload the page, it's likely better to store this until finished
			                            document.location.search = kvp.join('&');
			                        }
			                    }
							    </script>
							    {/literal} 
				                <div class="ctrlHolder" id="cell_select">
				                <h3>انتخاب بر اساس گروه‌های دفترچه تلفن</h3>
		                              <p class="formHint">حداقل باید یک تماس را انتخاب کنید</p>
		                        </div>             
				                {foreach $groups as $group}
				                	{if isset($smarty.get.{"group_"|cat:$group->id}) && $smarty.get.{"group_"|cat:$group->id} eq "true"}
				                		{$checked = true}
				                	{else}
				                		{$checked = false}
				                	{/if}
		                            <div class="ctrlHolder">
		                              <p class="label">نام گروه: <b><a href="contact/grouping/?edit={$group->id}">{$group->name}</a></b></p>
		                              <ul>
		                              {foreach $contacts[$group->id] as $contact}
		                              <li><label for="contact_{$contact->id}"><input type="checkbox" name="cell[]" id="contact_{$contact->id}" class="cell_selection" value="{$contact->cell}"  {if $checked}checked="checked"{/if} />{$contact->name}</label></li>
		                              {/foreach}
		                              </ul>
		                              <p class="formHint"><a href="javascript:insert_param('group_{$group->id}','true')" >انتخاب همه تماس‌های گروه</a></p>
		                            </div>
				                
				                {/foreach}
			            	{/if}
		            	{/if}
		            	<div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	    
</div>
<div class="clear"></div>
</div>
</form>