{if $action eq "edit"}
	{$time={$gallery->date_created}}
	{$author=$operator->name}
{else}
	{$time="now"}
	{$author=$smarty.session.name}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">اطلاعات گالری عکس</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
		                <p>نویسنده: {$author} <img src="{$loct}/images/icon/icon_date.png" align="left" /></p>
		                <p>تاریخ ایجاد: {jdate(" l j F Y",strtotime($time))}</p>
		                {if $action eq "edit"}
			                <p>تاریخ آخرین تغییر: {jdate(" l j F Y",strtotime({$gallery->date_modified}))}</p>
			                {if $gallery->pg_status eq "publish"}
	                			<p><a href="/gallery/show/{$gallery->id}/{changetoplus title =$gallery->pg_title}" target="_blank">لینک صفحه در سایت</a></p>
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
		                		{if $gallery->pg_status neq "delete"}
		                			<a href="gallery/del/{$gallery->id}" title="گالری عکس {$gallery->pg_title} حذف شود؟"  class="del_btn confirm_del" >حذف گالری عکس</a>
		                		{else}
		                			<a href="gallery/undel/{$gallery->id}" title="گالری عکس {$gallery->pg_title} بازیابی شود؟"  class="del_btn confirm_del" >بازیابی گالری عکس</a>
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