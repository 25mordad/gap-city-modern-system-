<div class="wrapper" >
	<div class="right _255 ">
    	{include file="tpl/sms/info.tpl"}
    	{include file="tpl/sms/menu.tpl"}
	</div>
	<div class="right _765 ">  	
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">انتخاب شماره همراه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    	
		                {if $GCMS_MODULE['user'] eq "active"}
				            <form method="post" action="sms/?user=true" class="uniForm" >
				            <fieldset>
                            <div class="ctrlHolder">
                              <p class="label">
                                <em>*</em>نوع عضو
                              </p>
                              <ul>
                              {foreach $GCMS_USER_LEVEL as $key => $val}
                                <li><label for="level"><input id="" name="level"  type="radio"  value="{$key}" />{$val}</label></li>
                              {/foreach}
                              </ul>
                              <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <p class="label">
                                <em>*</em>پارامتر مربوط به شماره همراه
                              </p>
                              <ul>
                              {foreach $GCMS_USER_PARAM as $key => $val}
                                <li><label for="cell"><input id="" name="cell"  type="radio"  value="{$key}" />{$val}</label></li>
                              {/foreach}
                              </ul>
                              <p class="formHint"></p>
                            </div>
                     		</fieldset>
                     		
                            <div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">ادامه ...</button>
                            </div>
	                        <div class="clear"></div>
	                        <script>
	                          $(function(){
	                            $('form.uniForm').uniform({
	                              prevent_submit : true
	                            });
	                          });
	                        </script>
		                {else}
		                		برای استفاده از این قسمت، ابتدا باید افزونه اعضا را نصب کنید
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
