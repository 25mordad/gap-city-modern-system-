<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/adv_wb/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">نمرات کلاس {$class->name}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt"  style="min-height:500px;" > 
	                    <style>
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    </style>
					    <script src="{$loct}/js/jquery-ui-1.7.2.custom.min.js"></script>
					    <link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
						<script src="{$loct}/js/jquery.easy-confirm-dialog.js"></script>
					<script> 
					$(function() {
						$('form.uniForm').uniform({
                            prevent_submit : true
                        });
			            $( "#addscoreform" ).dialog({
			                    autoOpen: false,
			                    modal: true
			            });
						$('#id_rel_class_lesson').change(function(event) {
							get_scores();
						});
						get_scores();
		            });
					function get_scores()
					{
					    if($('#id_rel_class_lesson').val()) {
						    $.post(document.URL+ "/AjaxController?controller=get_scores", { id_rel_class_lesson: $('#id_rel_class_lesson').val() }, function(data,status){
						    	$( "#scores" ).html(data);
						    	$(".confirm_dialog").easyconfirm( { locale: $.easyconfirm.locales.faIR } );					      
						    });
					    	$("#addscore").show();
					    }
					    else {
					    	$( "#scores" ).html("برای دیدن عنوان نمرات یک درس، آن را انتخاب کنید.");
					    	$("#addscore").hide();
					    }
					}
		            function add_score()
		            {
		            	$( "#id_rel_class_lesson_hidden" ).val($('#id_rel_class_lesson').val());
		            	$( "#addscoreform" ).dialog( "open" );
		            }
					</script>
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
	                     
						<div id="addscoreform" title="اضافه کردن نمره درس">
						    <form method="post" action="adv_wb/addscore" class="uniForm">                            
						    <fieldset>
						    	<input type="hidden" name="id_class" id="id_class" value="{$class->id}"/>
						    	<input type="hidden" name="id_rel_class_lesson_hidden" id="id_rel_class_lesson_hidden" />
						    <div class="ctrlHolder">
						        <label for="title">عنوان</label>
						        <input type="text" name="title" id="title" size="15"  class="textInput auto required" />
						        <p class="formHint"></p>
						    </div>
	                        <div class="ctrlHolder">
	                        	{$type_select = [['name'=>"فروردین",'value'=>"far"], ['name'=>"اردیبهشت",'value'=>"ord"],
												['name'=>"خرداد",'value'=>"kho"], ['name'=>"تیر",'value'=>"tir"],
												['name'=>"مرداد",'value'=>"mor"], ['name'=>"شهریور",'value'=>"sha"],
												['name'=>"مهر",'value'=>"mhr"], ['name'=>"آبان",'value'=>"abn"],
												['name'=>"آذر",'value'=>"azr"], ['name'=>"دی",'value'=>"dey"],
												['name'=>"بهمن",'value'=>"bah"], ['name'=>"اسفند",'value'=>"sfn"],
												['name'=>"عادی",'value'=>"normal"], ['name'=>"میان‌ترم",'value'=>"midterm"],
												['name'=>"پایان‌ترم",'value'=>"finterm"], ['name'=>"نوبت اول مستمر 1",'value'=>"1midterm"],
												['name'=>"نوبت اول پایانی 1",'value'=>"1finterm"], ['name'=>"نوبت دوم مستمر 2",'value'=>"2midterm"],
												['name'=>"نوبت دوم پایانی 2",'value'=>"2finterm"] , 
                                                
                                                ['name'=>"فعالیت کلاسی",'value'=>"clsact"] , 
                                                ['name'=>"پیشرفت",'value'=>"prgrs"] , 
                                                ['name'=>"شفاهی",'value'=>"vocb"] 
                                                ]}
	                              <label for="type">نوع</label>
	                              <select name="type" id="type" class="selectInput r_size required" >
		                    		<option value="">@@Choose@@</option>
		                    		{selectTagGenerator info= $type_select }
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
                    	
						    <form method="post" action="adv_wb/" class="uniForm">                            
						    <fieldset>
	                        <div class="ctrlHolder">
	                              <label for="id_rel_class_lesson">انتخاب درس مربوط به کلاس</label>
	                              <select name="id_rel_class_lesson" id="id_rel_class_lesson" class="selectInput r_size required" >
	                              	<option value="">@@Choose@@</option>
	                                {foreach $select_lesson as $key => $val}
	                                <option value="{$key}"  {if $key eq 12}selected="selected"{/if} >{$val}</option>
	                                {/foreach}
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
	                        </fieldset>
	                        <div class="clear"></div>
						    </form>
			                <div class="clear"></div>
		                    <div class="list" id="scores">
	                        برای دیدن عنوان نمرات یک درس، آن را انتخاب کنید.
	                        </div>
	                        <div id="addscore" style="display:none;">
	                        		<a href="javascript:add_score()">اضافه کردن نمره</a>
	                        </div>
						    
		                 
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	
	</div>
	<div class="clear"></div>    
</div>