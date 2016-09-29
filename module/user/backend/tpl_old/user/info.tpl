
		      <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">اطلاعات عضو</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    	{foreach $user_params as $user_param}
		                <p>{$user_param['label']}: {$user_param['value']}</p>
		                {/foreach}
		                
				                <script src="{$loct}/js/jquery-ui-1.7.2.custom.min.js"></script>
				                <link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
								<script src="{$loct}/js/jquery.easy-confirm-dialog.js"></script>
		                		{literal}
		                		<script>
		                		$(function() {
		                			$(".confirm_del").easyconfirm({locale: $.easyconfirm.locales.faIR});
		                		});
		                		</script>
		                		{/literal}	
		                		<p style="margin-top:10px;text-align:center;">
		                		{if $user->status neq "delete"}
		                			<a href="user/del/{$user->id}" title="عضو {$user->username} حذف شود؟"  class="del_btn confirm_del" >حذف عضو</a>
		                		{else}
		                			<a href="user/undel/{$user->id}" title="عضو {$user->username} بازیابی شود؟"  class="del_btn confirm_del" >بازیابی عضو</a>
		                		{/if}
		                		</p>
		                		
		                <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->