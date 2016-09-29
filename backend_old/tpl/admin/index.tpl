<div class="wrapper" >
	<div class="right _255 ">
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">دسترسی سریع</div>
                    <img src="{$loct}/images/icon/star.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                        <a href="page/page_index"><div class="r_menu">
                            <span>مدیریت صفحه نخست</span>
                            <img src="{$loct}/images/icon/nw_hm.png" />
                        </div></a>
                        <a href="operator/new/"><div class="r_menu">
                            <span>ایجاد کاربر جدید</span>
                            <img src="{$loct}/images/icon/new_op.png" />
                        </div></a>
                        <a href="operator/pass/{$smarty.session.userid}"><div class="r_menu">
                            <span>تغییر کلمه عبور</span>
                            <img src="{$loct}/images/icon/ch_pas.png" />
                        </div></a>
                        <a href="page/new/"><div class="r_menu">
                            <span>ایجاد صفحه جدید</span>
                            <img src="{$loct}/images/icon/nw_pg.png" />
                        </div></a>
                        <a href="comment/"><div class="r_menu">
                            <span>لیست نظرات</span>
                            <img src="{$loct}/images/icon/cmn_lst.png" />
                        </div></a>
                        <a href="file/"><div class="r_menu">
                            <span>مدیریت فایل ها</span>
                            <img src="{$loct}/images/icon/fl_mn.png" />
                        </div></a>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
               <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">ورود به پشتیبانی آنلاین</div>
                    <img src="{$loct}/images/icon/login.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
		               <div  style="width: 225px; height: 210px;" >
		               
						<style>
						form.login ul {
						float: right;
						list-style-type: none;
						margin: 0;
						padding: 0;
						border:0px solid red;
						width: 225px;
						}
						form.login ul li {
						    float: right;
						    position: relative;
						}
						form.login input {
						    border: 1px solid #4C4C4C;
						    border-radius: 5px 5px 5px 5px;
						}
						form.login label {
						    color: #AAAAAA;
						    font-family: BKoodakBold;
						    font-size: 16px;
						    margin-right: 20px;
						    position: absolute;
						    right: 25px;
						    text-align: right;
						    top: 15px;
						}
						form.login input[type="text"], form.login input[type="password"] {
						    background: none repeat scroll 0 0 white;
						    border: 1px solid #D1D1D1;
						    color: #D1D1D1;
						    direction: rtl;
						    font-size: 14px;
						    height: 30px;
						    margin: 5px 20px;
						    padding: 5px;
						    text-align: right;
						    width: 170px;
						}
						form.login input[type="password"] {
						    float: right;
						    margin-right: 20px;
						    width: 170px;
						}
						form.login input[type="submit"] {
						    background: #CE0000;
						    border: 0 none;
						    color:  white;
						    cursor: pointer;
						    font-family: BKoodakBold;
						    font-size: 22px;
						    height: 43px;
						    margin: 7px 110px 0 20px;
						    padding: 0;
						    text-align: center;
						    width: 93px;
						}
						form.login input[type="submit"]:hover {
						    background: #A1C430;
						    color: black;
						}
						form.login input:focus {
						    border: 1px solid #A1C430;
						    color: #A1C430;
						}
						</style>
						<a href="http://www.gatriya.com/page/show/96/" target="_blank"><img src="{$loct}/images/icon/sg_cm.png"  />راهنمای استفاده از پشتیبانی آنلاین</a><br />
						<form action="http://www.gatriya.com/user" method="post" name="login" class="login" target="_blank" style=" width: 210px;height: 180px;" >  				
						 <script>
						   $(document).ready(function(){
						    	$("form.login input")
						    		.each(function(){
						    			if (this.value) {
						    				$(this).prev().hide();
						    			}
						    		})
						    		.focus(function(){
						    			$(this).prev().hide();
						    		})
						    		.blur(function(){
						    			if (!this.value) {
						    				$(this).prev().show();
						    			}
						    		});
						    });
						   </script>
						   <ul>
						    <li>
						    <label for="username">ایمیل</label><input type="text" name="username" id="username" />
						    </li>
						    <li>
						    <label for="password">کلمه عبور</label><input type="password" name="password" id="password" />
						    </li>
						    <li>
						    <input type="submit" value="ورود" name="login" />
						    </li>
						   </ul>        
						   <div class="clear"></div>
		                   <a href="http://www.gatriya.com/user/forgot" target="_blank"  >کلمه عبور خود را فراموش کرده ام !</a>
						   <input type="hidden" id="capcha" name="cpcha" />
		                   				   </form>
		                   
		                </div> 
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">سیستم مدیریت محتوای گـاتـریـا</div>
                    <img src="{$loct}/images/icon/gatriya.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
			           <script type="text/javascript" src="{$loct}/js/jquery.cycle.all.latest.js"></script>
			           <script type="text/javascript">
			            $(document).ready(function() {
			                $('.slideshow').cycle({
			            		fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
			            	});
			            });
			            </script>
			            <div class="slideshow">
			        		<a href="http://www.gatriya.com" target="_blank"><img src="http://www.gatriya.com/uploads/admin_img/1.jpg" width="746" height="242" /></a>
			                <a href="http://www.gatriya.com" target="_blank"><img src="http://www.gatriya.com/uploads/admin_img/2.jpg" width="746" height="242" /></a>
			                <a href="http://www.gatriya.com" target="_blank"><img src="http://www.gatriya.com/uploads/admin_img/3.jpg" width="746" height="242" /></a>
			        	</div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">آخرین اخبار گاتریا</div>
                    <img src="{$loct}/images/icon/rss.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
			            {for $foo=0 to 2}
			            {$row = $feed_contents[$foo] }            
			                <div style="padding: 5px; background: #CCCCCC;margin: 6px 5px 0 5px; border-radius: 10px;" >
			                   <strong>{$row->title}</strong><br />
			                   {$row->description}<br />
			                   <div style="font-size: 9px;" class="right">{jdate(" l j F Y",strtotime( $row->pubDate ))}</div>
			                   <a href="{$row->link}" target="_blank"><div class="left " style="color: blue;">ادامه خبر...</div></a>
			                   <div class="clear"></div>
			                </div>
			                <div class="clear"></div>
			            {/for}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->
	</div>
	<div class="clear"></div>    
</div>