              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">اطلاعات نظر</div>
                    <img src="{$loct}/images/icon/info.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
		                <p>نویسنده: {$comment->cm_author}<img src="{$loct}/images/icon/icon_date.png" align="left" /></p>
		                {if $comment->cm_email neq NULL}
		                <p>ایمیل: {$comment->cm_email}</p>
		                <!-- <p><a href="#">ارسال ایمیل به {$comment->cm_author}</a></p> -->
		                {/if}
		                {if $comment->cm_url neq NULL}
		                <p>آدرس سایت: <a href="http://{$comment->cm_url}" target="_blank">{$comment->cm_url}</a></p>
		                {/if}
		                {if $comment->cm_ip neq NULL}
			              <p>کشور: {$countryCode['countryName']} | <img src="http://ipinfodb.com/img/flags/{strtolower($countryCode['countryCode'])}.gif" /></p>
			              <p>شهر: {$countryCode['regionName']} | {$countryCode['cityName']}</p>
			              <p>شناسه: {$comment->cm_ip }</p>
		                {/if}
			              
			            <p>**********************************</p>
                    	<p>تاریخ ارسال: {jdate(" l j F Y",strtotime($comment->cm_date))}</p>        
	                	{$arr_types = [
		                   'page'=>"صفحات",
		                   'news' => "اخبار",
		                   'gallery' => "گالری عکس",
		                   'sound' => "گالری صوتی"  
		                   ]}
                    	<p>مکان: {$arr_types[$comment->cm_type]} &raquo; <a href="{$comment->cm_type}/edit/{$comment->id_other}">{showtitle id=$comment->id_other chagetoplus="false" }</a></p>
                    	<p><a href="/{$comment->cm_type}/show/{$comment->id_other}/{showtitle id=$comment->id_other chagetoplus="true" }" target="_blank">لینک صفحه مربوط به نظر در سایت</a></p>
		           
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
		                {if $comment->cm_status neq "delete"}
		                	<a href="comment/del/{$comment->id}" title="نظر {$comment->cm_author} حذف شود؟"  class="del_btn confirm_del" >حذف نظر</a>
		                {else}
		                	<a href="comment/undel/{$comment->id}" title="نظر {$comment->cm_author} بازیابی شود؟"  class="del_btn confirm_del" >بازیابی نظر</a>
		                {/if}
		                </p>
		                	
                		
		                <div class="clear"></div>
						
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->