<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/club/menu.tpl"}
		      <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">اطلاعات عضو</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    
									<style>
                                    .row_t {
                                         background: #cccccc; margin: 2px; border-radius: 5px; padding: 10px;
                                    }
                                    .row_t:hover {
                                        background: #333333; color: white; 
                                    }
                                    </style>
                                    
								    <div class="row_t" style="background: black; color: white;" >
                                        <div class="right" >
                                        <strong>امتیازات کاربر</strong>
                                        </div>
								        <div class="clear"></div>
								    </div>
								    <div class="clear"></div>
								    {if isset($group->name)}
								    	<div>&raquo; گروه : <a href="/gadmin/club/group/{$group->id_group}">{$group->name}</a></div>
										<div class="clear"></div>
									{else}
								    	<div>&raquo;  عضو هیچ گروهی نیست </div>
										<div class="clear"></div>
									{/if}
								    <div class="clear"></div>
								    {if count($scores) eq 0}
								    <div class="row_t" >
                                        <div class="right" >
                                        بدون امتیاز!
                                        </div>
								        <div class="clear"></div>
								    </div>		    
								    <div class="clear"></div>
									{else}
									{$scores_sum=0}
								    {foreach $scores as $score}
								    <div class="row_t" >
                                        <div class="right" >{$score->title}</div>
                                        <div class="left" style="direction:ltr;color:red;" >{$score->score}</div>
                                        {$scores_sum=$scores_sum+$score->score}
								        <div class="clear"></div>
                                        <div class="left" >{jdate(" l j F Y",strtotime($score->date))}</div>
                                        <div class="clear"></div>
								    </div>		    
								    <div class="clear"></div>
								    {/foreach}
								    <div class="row_t" style="background: blue; color: white;" >
                                        <div class="right" >
                                        <strong>جمع کل: </strong>
                                        </div>
                                        <div class="left" style="direction:ltr;color:white;" ><strong>{$scores_sum}</strong></div>
								        <div class="clear"></div>
								    </div>
								    <div class="clear"></div>
								    {/if}
								    
								    <br>
								    <div class="row_t" style="background: black; color: white;" >
                                        <div class="right" >
                                        <strong>کارت‌های ثبت‌شده</strong>
                                        </div>
								        <div class="clear"></div>
								    </div>
								    <div class="clear"></div>
								    {if count($cards) eq 0}
								    <div class="row_t" >
                                        <div class="right" >
                                        بدون کارت!
                                        </div>
								        <div class="clear"></div>
								    </div>		    
								    <div class="clear"></div>
									{else}
								    {foreach $cards as $card}
								    <div class="row_t" >
                                        <div class="right" >&raquo; سریال: {$card->serial}</div>
                                        <div class="clear"></div>
                                        {if $card->status eq "both" or $card->status eq "product"}
                                        ----------------------------------<br>
                                        <div class="right" ><strong>محصولات خریداری‌شده</strong><br>
                                        	{foreach $card->products as $product}
                                        	&raquo; {$product->pg_title}<br>
                                        	{/foreach}
                                        </div>
                                        <br>----------------------------------<br>
								        <div class="clear"></div>
                                        {/if}
										{if $card->status eq "both" or $card->status eq "poll"}
                                        <div class="right" >&raquo; تاریخ خرید: 
                                        	 {jdate(" l j F Y",strtotime($card->poll_buy_date))}
                                        </div>
								        <div class="clear"></div>
                                        {/if}
                                        <div class="right" >&raquo; تاریخ ثبت: {jdate(" l j F Y",strtotime($card->reg_date))}</div>
								        <div class="clear"></div>
								    </div>		    
								    <div class="clear"></div>
								    {/foreach}
								    {/if}
							    <div class="clear"><br></div>
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
                    <div class="title right">ویرایش عضو {$user->username}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $user->status neq "delete"}
						<form action="club/edituser/{$user->id}" method="post" class="uniForm">
						<fieldset>
                            
                            <div class="ctrlHolder">
                            <label for="name"><em>*</em>نام و نام خانوادگی</label>
                            <input name="name" id="name" type="text" class="textInput required" value="{$user->name}" />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="username"><em>*</em>نام کاربری</label>
                            <input name="username" id="username" type="text" class="textInput latin disabled" value="{$user->username}" readonly="readonly" />
                            <p class="formHint">غیرقابل ویرایش</p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="email">ایمیل</label>
                            <input name="email" id="email" type="text" class="textInput latin validateEmail" value="{$user->email}" />
                            <p class="formHint">آدرس ایمیل معتبر</p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="cell">موبایل</label>
                            <input name="cell" id="cell" type="text" class="textInput latin validatePhone" value="{$user->cell}" />
                            <p class="formHint">مثال: 09125521340</p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="user_level"><em>*</em>نوع عضو</label>
                              {$user_level_select = [['name'=>"اصلی",'value'=>"original"]]}
                              <select name="user_level" id="user_level" class="selectInput required">
		                    	<option value="">-- @@Choose@@ --</option>
		                    	{selectTagGenerator info= $user_level_select default= {$user->user_level} }
                              </select>
                              <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="nickname">نام مستعار</label>
                            <input name="nickname" id="nickname" type="text" class="textInput" value="{$user->nickname}" />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="address">آدرس</label>
                              <textarea name="address" id="address" >{$user->address}</textarea>
                              <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <p class="label">تاریخ تولد</p>
                              <input name="birth_date" id="birth_date" type="hidden" {if $user->birth_date neq ""}value="{miladi_to_shamsi($user->birth_date)}"{/if} />
                              		<script>
								    function update_birth_hidden()
								    {
								        var birth_date             = document.getElementById('birth_date');
								        var DateOfBirth_Day   = document.getElementById('DateOfBirth_Day');
								        var DateOfBirth_Month = document.getElementById('DateOfBirth_Month');
								        var DateOfBirth_Year  = document.getElementById('DateOfBirth_Year');
								        if((!(DateOfBirth_Year.value==""))&&(!(DateOfBirth_Month.value==""))&&(!(DateOfBirth_Day.value=="")))
								        	birth_date.value = DateOfBirth_Year.value+"-"+DateOfBirth_Month.value+"-"+DateOfBirth_Day.value;
								    }
									</script>
									{if $user->birth_date neq ""}
								    {assign "arrbirthdate" explode("-", miladi_to_shamsi($user->birth_date))}
								    {/if}
								    {$rooz = [
								    ['name' => '1','value' => "1"], 
								    ['name' => '2','value' => "2"], 
								    ['name' => '3','value' => "3"], 
								    ['name' => '4','value' => "4"], 
								    ['name' => '5','value' => "5"], 
								    ['name' => '6','value' => "6"], 
								    ['name' => '7','value' => "7"], 
								    ['name' => '8','value' => "8"], 
								    ['name' => '9','value' => "9"], 
								    ['name' => '10','value' => "10"], 
								    ['name' => '11','value' => "11"], 
								    ['name' => '12','value' => "12"], 
								    ['name' => '13','value' => "13"], 
								    ['name' => '14','value' => "14"], 
								    ['name' => '15','value' => "15"], 
								    ['name' => '16','value' => "16"], 
								    ['name' => '17','value' => "17"], 
								    ['name' => '18','value' => "18"], 
								    ['name' => '19','value' => "19"], 
								    ['name' => '20','value' => "20"], 
								    ['name' => '21','value' => "21"], 
								    ['name' => '22','value' => "22"], 
								    ['name' => '23','value' => "23"], 
								    ['name' => '24','value' => "24"], 
								    ['name' => '25','value' => "25"], 
								    ['name' => '26','value' => "26"], 
								    ['name' => '27','value' => "27"], 
								    ['name' => '28','value' => "28"], 
								    ['name' => '29','value' => "29"], 
								    ['name' => '30','value' => "30"],
								    ['name' => '31','value' => "31"]
								     ]}
								    {$mah = [
								    ['name' => 'فروردین','value' => "1"], 
								    ['name' => 'اردیبهشت','value' => "2"], 
								    ['name' => 'خرداد','value' => "3"], 
								    ['name' => 'تیر','value' => "4"], 
								    ['name' => 'مرداد','value' => "5"], 
								    ['name' => 'شهریور','value' => "6"], 
								    ['name' => 'مهر','value' => "7"], 
								    ['name' => 'آبان','value' => "8"], 
								    ['name' => 'آذر','value' => "9"], 
								    ['name' => 'دی','value' => "10"], 
								    ['name' => 'بهمن','value' => "11"], 
								    ['name' => 'اسفند','value' => "12"]
								     ]}
								    {$sal = [
								    ['name' => '1300','value' => "1300"],
								    ['name' => '1301','value' => "1301"],
								    ['name' => '1302','value' => "1302"],
								    ['name' => '1303','value' => "1303"],
								    ['name' => '1304','value' => "1304"],
								    ['name' => '1305','value' => "1305"],
								    ['name' => '1306','value' => "1306"],
								    ['name' => '1307','value' => "1307"],
								    ['name' => '1308','value' => "1308"],
								    ['name' => '1309','value' => "1309"],
								    ['name' => '1310','value' => "1310"],
								    ['name' => '1311','value' => "1311"],
								    ['name' => '1312','value' => "1312"],
								    ['name' => '1313','value' => "1313"],
								    ['name' => '1314','value' => "1314"],
								    ['name' => '1315','value' => "1315"],
								    ['name' => '1316','value' => "1316"],
								    ['name' => '1317','value' => "1317"],
								    ['name' => '1318','value' => "1318"],
								    ['name' => '1319','value' => "1319"],
								    ['name' => '1320','value' => "1320"],
								    ['name' => '1321','value' => "1321"],
								    ['name' => '1322','value' => "1322"],
								    ['name' => '1323','value' => "1323"],
								    ['name' => '1324','value' => "1324"],
								    ['name' => '1325','value' => "1325"],
								    ['name' => '1326','value' => "1326"],
								    ['name' => '1327','value' => "1327"],
								    ['name' => '1328','value' => "1328"],
								    ['name' => '1329','value' => "1329"],
								    ['name' => '1330','value' => "1330"],
								    ['name' => '1331','value' => "1331"],
								    ['name' => '1332','value' => "1332"],
								    ['name' => '1333','value' => "1333"],
								    ['name' => '1334','value' => "1334"],
								    ['name' => '1335','value' => "1335"],
								    ['name' => '1336','value' => "1336"],
								    ['name' => '1337','value' => "1337"],
								    ['name' => '1338','value' => "1338"],
								    ['name' => '1339','value' => "1339"],
								    ['name' => '1340','value' => "1340"],
								    ['name' => '1341','value' => "1341"],
								    ['name' => '1342','value' => "1342"],
								    ['name' => '1343','value' => "1343"],
								    ['name' => '1344','value' => "1344"],
								    ['name' => '1345','value' => "1345"],
								    ['name' => '1346','value' => "1346"],
								    ['name' => '1347','value' => "1347"],
								    ['name' => '1348','value' => "1348"],
								    ['name' => '1349','value' => "1349"],
								    ['name' => '1350','value' => "1350"],
								    ['name' => '1351','value' => "1351"],
								    ['name' => '1352','value' => "1352"],
								    ['name' => '1353','value' => "1353"],
								    ['name' => '1354','value' => "1354"],
								    ['name' => '1355','value' => "1355"],
								    ['name' => '1356','value' => "1356"],
								    ['name' => '1357','value' => "1357"],
								    ['name' => '1358','value' => "1358"],
								    ['name' => '1359','value' => "1359"],
								    ['name' => '1360','value' => "1360"],
								    ['name' => '1361','value' => "1361"],
								    ['name' => '1362','value' => "1362"],
								    ['name' => '1363','value' => "1363"],
								    ['name' => '1364','value' => "1364"],
								    ['name' => '1365','value' => "1365"],
								    ['name' => '1366','value' => "1366"],
								    ['name' => '1367','value' => "1367"],
								    ['name' => '1368','value' => "1368"],
								    ['name' => '1369','value' => "1369"],
								    ['name' => '1370','value' => "1370"],
								    ['name' => '1371','value' => "1371"],
								    ['name' => '1372','value' => "1372"],
								    ['name' => '1373','value' => "1373"],
								    ['name' => '1374','value' => "1374"],
								    ['name' => '1375','value' => "1375"],
								    ['name' => '1376','value' => "1376"],
								    ['name' => '1377','value' => "1377"],
								    ['name' => '1378','value' => "1378"],
								    ['name' => '1379','value' => "1379"],
								    ['name' => '1380','value' => "1380"],
								    ['name' => '1381','value' => "1381"],
								    ['name' => '1382','value' => "1382"],
								    ['name' => '1383','value' => "1383"],
								    ['name' => '1384','value' => "1384"],
								    ['name' => '1385','value' => "1385"],
								    ['name' => '1386','value' => "1386"],
								    ['name' => '1387','value' => "1387"],
								    ['name' => '1388','value' => "1388"],
								    ['name' => '1389','value' => "1389"],
								    ['name' => '1390','value' => "1390"],
								    ['name' => '1391','value' => "1391"]
								     ]}
                              <ul class="alternate">
                                <li><label for="sal">سال
                                	<select name="DateOfBirth_Year" id="DateOfBirth_Year" onchange="update_birth_hidden()">
                                		<option value="" selected="selected">@@Choose@@</option>
                                		{selectTagGenerator info= $sal  default= {$arrbirthdate[0]} }</select></label></li>
                                <li><label for="mah">ماه
                                	<select name="DateOfBirth_Month" id="DateOfBirth_Month" onchange="update_birth_hidden()">
                                		<option value="" selected="selected">@@Choose@@</option>
                                		{selectTagGenerator info= $mah  default= {$arrbirthdate[1]} }</select></label></li>
                                <li><label for="rooz">روز
                                	<select name="DateOfBirth_Day" id="DateOfBirth_Day" onchange="update_birth_hidden()">
                                		<option value="" selected="selected">@@Choose@@</option>
                                		{selectTagGenerator info= $rooz  default= {$arrbirthdate[2]} }</select></label></li>
                              </ul>
                              <p class="formHint"></p>
                            </div>
							
                            <div class="ctrlHolder">
                            <style>
                            label[for=avatar1] , label[for=avatar2] , label[for=avatar3] ,
                            label[for=avatar4] , label[for=avatar5] , label[for=avatar6] ,
                            label[for=avatar7] , label[for=avatar8] , label[for=avatar9] ,
                            label[for=avatar10] , label[for=avatar11] , 
                            label[for=avatar12] { float: right; }
                            </style>
                              <label for="avatar">نمایه</label>
								    {$avatar_radio = [
                                    ['name' => "<img src=\"{$temp_root}/images/avatar/1.png\" />" , 'value' => "1"],
                                    ['name' => "<img src=\"{$temp_root}/images/avatar/2.png\" />" , 'value' => "2"],
                                    ['name' => "<img src=\"{$temp_root}/images/avatar/3.png\" />" , 'value' => "3"],
                                    
                                    ['name' => "<img src=\"{$temp_root}/images/avatar/4.png\" />" , 'value' => "4"],
                                    ['name' => "<img src=\"{$temp_root}/images/avatar/5.png\" />" , 'value' => "5"],
                                    ['name' => "<img src=\"{$temp_root}/images/avatar/6.png\" />" , 'value' => "6"],
                                    
                                    ['name' => "<img src=\"{$temp_root}/images/avatar/7.png\" />" , 'value' => "7"],
                                    ['name' => "<img src=\"{$temp_root}/images/avatar/8.png\" />" , 'value' => "8"],
                                    ['name' => "<img src=\"{$temp_root}/images/avatar/9.png\" />" , 'value' => "9"],
                                   
                                    ['name' => "<img src=\"{$temp_root}/images/avatar/10.png\" />" , 'value' => "10"],
                                    ['name' => "<img src=\"{$temp_root}/images/avatar/11.png\" />" , 'value' => "11"],
                                    ['name' => "<img src=\"{$temp_root}/images/avatar/12.png\" />" , 'value' => "12"]
                                    
                                    ]}
                              <div class="left">      
                                    {radioTagGenerator info = $avatar_radio radioName = "avatar" default="{$user->avatar}"}
                              </div>
                              <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="gender">جنسیت</label>
                              {$gender_select = [['name'=>"زن" , 'value' => "female"],['name' => "مرد" , 'value' => "male"]]}
                              <select name="gender" id="gender" class="selectInput">
				                <option value="NULL" selected="selected">-- @@Choose@@ --</option>
				                {selectTagGenerator info= $gender_select default= {$user->gender} }
                              </select>
                              <p class="formHint">زن | مرد</p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="marital">وضعیت تاهل</label>
                              {$marital_select = [['name'=>"مجرد" , 'value' => "single"],['name' => "متاهل" , 'value' => "married"]]}
                              <select name="marital" id="marital" class="selectInput">
				                <option value="NULL" selected="selected">-- @@Choose@@ --</option>
				                {selectTagGenerator info= $marital_select default= {$user->marital} }
                              </select>
                              <p class="formHint">مجرد | متاهل</p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="type"><em>*</em>نمایش اطلاعات</label>
                              {$type_select = [['name'=>"عمومی" , 'value' => "public"],['name' => "خصوصی" , 'value' => "private"]]}
                              <select name="type" id="type" class="selectInput required">
				                <option value="" selected="selected">-- @@Choose@@ --</option>
				                {selectTagGenerator info= $type_select default= {$user->type} }
                              </select>
                              <p class="formHint">عمومی | خصوصی</p>
                            </div>
								    
							<h3>تاریخ ایجاد عضو: {jdate(" l j F Y",strtotime({$user->date_created}))}</h3>
	                    </fieldset>
	                    <div class="buttonHolder">
	                    	<button type="submit"  name="submit" class="primaryAction">@@Edit@@</button>
	                    </div>
	                    <div class="clear"></div>
	                    {literal}
	                    <script>
	                    $(function(){
	                    	$('form.uniForm').uniform({
	                    		prevent_submit : true
	                    	});
	                    });
	                    </script>
	                    {/literal}
	                    </form>
					{else}
						این عضو حذف شده است.
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
		                			<a href="club/undeluser/{$user->id}" title="عضو {$user->username} بازیابی شود؟"  class="del_btn confirm_del" >بازیابی عضو</a>
		                		</p>
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