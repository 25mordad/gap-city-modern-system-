{if $action eq "edit"}
	{$time={$up->date_created}}
	{$author=$operator->name}
{else}
	{$time="now"}
	{$author=$smarty.session.name}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">اطلاعات صفحه کاربران</div>
                    <img src="{$loct}/images/icon/info.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
		                <p>نویسنده: {$author} <img src="{$loct}/images/icon/icon_date.png" align="left" /></p>
		                <p>تاریخ ایجاد: {jdate(" l j F Y",strtotime($time))}</p>
		                {if $action eq "edit"}
			                <p>تاریخ آخرین تغییر: {jdate(" l j F Y",strtotime({$up->date_modified}))}</p>
			                {if $up->pg_status eq "publish"}
	                			<p><a href="/up/show/{$up->id}/{changetoplus title =$up->pg_title}" target="_blank">لینک صفحه در سایت</a></p>
	                		{/if}
	                	
	                		
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
		                		{if $page->pg_status neq "delete"}
		                			<a href="up/del/{$up->id}" title="صفحه {$up->pg_title} حذف شود؟"  class="del_btn confirm_del" >حذف صفحه</a>
		                		{else}
		                			<a href="up/undel/{$up->id}" title="صفحه {$up->pg_title} بازیابی شود؟"  class="del_btn confirm_del" >بازیابی صفحه</a>
		                		{/if}
		                		</p>
		                	
                		{/if}
		                <div class="clear"></div>
						
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->