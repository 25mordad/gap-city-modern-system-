<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/adv_wb/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">اطلاعات کلاس {$class->name}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					    <script src="{$loct}/js/jquery-ui-1.7.2.custom.min.js"></script>
					    <link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
						<script src="{$loct}/js/jquery.easy-confirm-dialog.js"></script>
			            {literal}
			            <script>
				            $(function() {
				            	$(".confirm_dialog").easyconfirm({locale: $.easyconfirm.locales.faIR});

	                            $('form.uniForm').uniform({
	                              prevent_submit : true
	                            });
				                $( "#addlessontoclassform" ).dialog({
				                    autoOpen: false,
				                    //height: 200,
				                    //width: 220,
				                    modal: true
				                });
				                $( "#addteachertoclassform" ).dialog({
				                    autoOpen: false,
				                    modal: true
				                });
				                $( "#addstudenttoclassform" ).dialog({
				                    autoOpen: false,
				                    modal: true
				                });
				            });
				            function addlessontoclass()
				            {
				            	$( "#addlessontoclassform" ).dialog( "open" );
				            }
				            function addteachertoclass()
				            {
				            	$( "#addteachertoclassform" ).dialog( "open" );
				            }
				            function addstudenttoclass()
				            {
				            	$( "#addstudenttoclassform" ).dialog( "open" );
				            }
				            function get_teachers(level)
				            {
							    $.post(document.URL+ "/AjaxController?controller=get_users", { level: level }, function(data,status){
							    	$( "#id_teacher" ).html(data);					      
							    }); 
				            }
				            function get_students(level)
				            {
							    $.post(document.URL+ "/AjaxController?controller=get_users", { level: level }, function(data,status){
							    	$( "#id_student" ).html(data);					      
							    }); 
				            }
			            </script>
			            {/literal}
	                    <style>
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    </style>
	                	{$arr_sex = [
	                   'female' => "زن" ,
	                   'male' => "مرد" ,
	                   'coed' => "مختلط"
	                   ]} 
	                	{$arr_ages = [
	                   'khord'=>"خردسال"  ,
	                   'koodak' => "کودک" ,
	                   'ebteda' => "ابتدایی" ,
	                   'rahnama' => "راهنمایی" ,
	                   'dabires' => "دبیرستان" ,
	                   'pishdanesh' => "پیش‌دانشگاهی" ,
	                   'bozorg' => "بزرگسال"
	                   ]}
	                   	<p>نام کلاس: <b>{$class->name}</b>  
	                   	[ <a href="adv_wb/editclass/{$class->id}">ویرایش</a> - 
	                   	<a href="javascript:addlessontoclass()">اضافه کردن درس</a> - 
	                   	<a href="javascript:addteachertoclass()">اضافه کردن معلم</a> - 
	                   	<a href="javascript:addstudenttoclass()">اضافه کردن دانش‌آموز</a> -
	                   	<a href="adv_wb/scoreclass/{$class->id}">نمرات کلاس</a> - 
	                   	<a href="adv_wb/delclass/{$class->id}" title="کلاس {$class->name} حذف شود؟"  class="confirm_dialog" >حذف</a> ]</p>
                    	<div class="right" style="width:250px;margin-right:150px;">
                    	<p>شعبه: {$branch->name}</p>
                    	<p>رده سنی: {$arr_ages[$class->ages]}</p>
                    	<p>ظرفیت: {$class->capacity} نفر (ظرفیت خالی: {$class->capacity - count($students)} نفر)</p>
                    	</div>
                    	<div class="right">
                    	<p>پایه: {$grade->name}</p>
                    	<p>جنسیت کلاس: {$arr_sex[$class->sex]}</p>
                    	<p>شهریه: {$class->tuition}</p>
                    	</div>
                    	<div class="clear"></div>
                    	<p style="margin-right:150px;">توضیحات: {$class->text}</p>
                    	<br>
                    	<div class="clear"></div>
                    	
		                 
						<div id="addlessontoclassform" title="اضافه کردن درس به کلاس">
						    <form method="post" action="adv_wb/addlessontoclass" class="uniForm">                            
						    <fieldset>
						    	<input type="hidden" name="id_class" id="id_class" value="{$class->id}"/>
						    	
	                        <div class="ctrlHolder">
	                              <label for="id_lesson">نام درس</label>
	                              <select name="id_lesson" id="id_lesson" class="selectInput r_size required" >
	                              	<option value="">@@Choose@@</option>
		                                {foreach $select_lesson as $key => $val}
		                                <option value="{$key}">{$val}</option>
		                                {/foreach}
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
						    </fieldset>
							<div class="buttonHolder" style="text-align:center;">
	                            <button type="submit"  name="submit" class="primaryAction">ثبت</button>
	                        </div>
	                        <div class="clear"></div>
						    </form>
						</div>
						<div id="addteachertoclassform" title="اضافه کردن معلم به کلاس">
						    <form method="post" action="adv_wb/addteachertoclass" class="uniForm">                            
						    <fieldset>
						    	<input type="hidden" name="id_class" id="id_class" value="{$class->id}"/>
						    	
                            <div class="ctrlHolder">
	                          <label for="level">نوع کاربر</label>
                              <ul>
                              {foreach $GCMS_USER_LEVEL as $key => $val}
                                <li><label for="level"><input id="" name="level"  type="radio" onclick="get_teachers(this.value);" value="{$key}" />{$val}</label></li>
                              {/foreach}
                              </ul>
                              <p class="formHint">لطفا نوع کاربر مناسب را انتخاب کنید</p>
                            </div>
	                        <div class="ctrlHolder">
	                              <label for="id_teacher">معلم</label>
	                              <select name="id_teacher" id="id_teacher" class="selectInput r_size required" >
	                              	<option value="">@@Choose@@</option>
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
						    </fieldset>
							<div class="buttonHolder" style="text-align:center;">
	                            <button type="submit"  name="submit" class="primaryAction">ثبت</button>
	                        </div>
	                        <div class="clear"></div>
						    </form>
						</div>
						<div id="addstudenttoclassform" title="اضافه کردن دانش‌آموز به کلاس">
						    <form method="post" action="adv_wb/addstudenttoclass" class="uniForm">                            
						    <fieldset>
						    	<input type="hidden" name="id_class" id="id_class" value="{$class->id}"/>
						    	
                            <div class="ctrlHolder">
	                          <label for="level">نوع کاربر</label>
                              <ul>
                              {foreach $GCMS_USER_LEVEL as $key => $val}
                                <li><label for="level"><input id="" name="level"  type="radio" onclick="get_students(this.value);" value="{$key}" />{$val}</label></li>
                              {/foreach}
                              </ul>
                              <p class="formHint">لطفا نوع کاربر مناسب را انتخاب کنید</p>
                            </div>
	                        <div class="ctrlHolder">
	                              <label for="id_student">دانش‌آموز</label>
	                              <select name="id_student" id="id_student" class="selectInput r_size required" >
	                              	<option value="">@@Choose@@</option>
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
						    </fieldset>
							<div class="buttonHolder" style="text-align:center;">
	                            <button type="submit"  name="submit" class="primaryAction">ثبت</button>
	                        </div>
	                        <div class="clear"></div>
						    </form>
						</div>
                    	
	                    <div class="list">
                            <div class="top">
                                <span>لیست درس‌های کلاس</span>
                                <div class="clear"></div>
                            </div>
                            {if count($lessons) eq 0}
                            <div class="row_0">
                            	هنوز درسی اضافه نشده است
                            </div>
                            {else}
                            {foreach $lessons as $lesson}
                            <div class="row_1">
                                <span style="width: 600px;"><a href="adv_wb/lessons/?paging=1&edit={$lesson->id_lesson}">{$lesson->name}</a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="adv_wb/dellessonfromclass/{$lesson->id}" 
                                		title="درس {$lesson->name} از کلاس {$class->name} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
                                </span>
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                            {/if}
                        </div>
		                <div class="clear"></div>
	                    <div class="list">
                            <div class="top">
                                <span>لیست معلم‌های کلاس</span>
                                <div class="clear"></div>
                            </div>
                            {if count($teachers) eq 0}
                            <div class="row_0">
                            	هنوز معلمی اضافه نشده است
                            </div>
                            {else}
                            {foreach $teachers as $teacher}
                            <div class="row_1">
                                <span style="width: 600px;"><a href="user/edit/{$teacher->id_teacher}">{$teacher->username} ({$teacher->params})</a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="adv_wb/delteacherfromclass/{$teacher->id}" 
                                		title="معلم {$teacher->username} از کلاس {$class->name} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
                                </span>
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                            {/if}
                        </div>
		                <div class="clear"></div>
	                    <div class="list">
                            <div class="top">
                                <span>لیست دانش‌آموزان کلاس</span>
                                <div class="clear"></div>
                            </div>
                            {if count($students) eq 0}
                            <div class="row_0">
                            	هنوز دانش‌آموزی اضافه نشده است
                            </div>
                            {else}
                            {foreach $students as $student}
                            <div class="row_1">
                                <span style="width: 490px;"><a href="user/edit/{$student->id_student}">{$student->username} ({$student->params})</a></span>
                                <span style="width: 100px;"><a href="adv_wb/workbooks/{$class->id}/?id_student={$student->id_student}">مشاهده کارنامه</a></span>
                                <span style="width: 50px;" class="last">
                                	<a href="adv_wb/delstudentfromclass/{$student->id}" 
                                		title="دانش‌آموز {$student->username} از کلاس {$class->name} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
                                </span>
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                            {/if}
                        </div>
		                <div class="clear"></div>
		                {if count($lessons) eq 0 and count($teachers) eq 0 and count($students) eq 0 }
		                <p style="margin-top:10px;text-align:center;">
		                	<a href="adv_wb/delclass/{$class->id}" title="کلاس {$class->name} حذف شود؟"  class="del_btn confirm_dialog" >حذف کلاس</a>
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