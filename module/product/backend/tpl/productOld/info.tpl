{if $action eq "edit"}
	{$time={$product->date_created}}
	{$author=$operator->name}
{else}
	{$time="now"}
	{$author=$smarty.session.name}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">اطلاعات محصول</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
		                <p>نویسنده: {$author} <img src="{$loct}/images/icon/icon_date.png" align="left" /></p>
		                <p>تاریخ ایجاد: {jdate(" l j F Y",strtotime($time))}</p>
		                {if $action eq "edit"}
			                <p>تاریخ آخرین تغییر: {jdate(" l j F Y",strtotime({$product->date_modified}))}</p>
			                {if $product->pg_status eq "publish"}
	                			<p><a href="/product/show/{$product->id}/{changetoplus title =$product->pg_title}" target="_blank">لینک محصول در سایت</a></p>
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
                                <!--
		                		<p style="margin-top:10px;text-align:center;">
		                		{if $product->pg_status neq "delete"}
		                			<a href="page/del/{$product->id}" title="محصول {$product->pg_title} حذف شود؟"  class="del_btn confirm_del" >حذف محصول</a>
		                		{else}
		                			<a href="page/undel/{$product->id}" title="محصول {$product->pg_title} بازیابی شود؟"  class="del_btn confirm_del" >بازیابی محصول</a>
		                		{/if}
		                		</p>
		                      	-->
                		{/if}
                        
		                <div class="clear"></div>
						
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->