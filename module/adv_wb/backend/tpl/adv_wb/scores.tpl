<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/adv_wb/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست دانش‌آموزان کلاس {$class->name}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                	{$arr_types = [
						'far' => "فروردین",
						'ord' => "اردیبهشت",
						'kho' => "خرداد",
						'tir' => "تیر",
						'mor' => "مرداد",
						'sha' => "شهریور",
						'mhr' => "مهر",
						'abn' => "آبان",
						'azr' => "آذر",
						'dey' => "دی",
						'bah' => "بهمن",
						'sfn' => "اسفند",
						'normal' => "عادی",
						'midterm' => "میان‌ترم",
						'finterm' => "پایان‌ترم",
						'1midterm' => "نوبت اول مستمر 1",
						'1finterm' => "نوبت اول پایانی 1",
						'2midterm' => "نوبت دوم مستمر 2",
						'2finterm' => "نوبت دوم پایانی 2" ,
                        'clsact' => "فعالیت کلاسی" ,
                        'prgrs' => "پیشرفت" ,
                        'vocb' => "شفاهی" 
	                   ]}
	                   
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span>ثبت و ویرایش نمرات {$score->title} ({$arr_types[$score->type]}) درس {$lesson->name}</span>
                                <div class="clear"></div>
                            </div>
                            <form method="post" action="adv_wb/scores/{$score->id}" class="uniForm">
                            {foreach $students as $student}
                            <div class="row_1" style="width: 680px;">
                                <span style="width: 500px;"><a href="user/edit/{$student->id_student}">{$student->username} ({$student->params})</a></span>
                                <span style="width: 150px;" class="last">
                                <input	type="text"	name="number_{$score->id}_{$student->id_student}" id="number_{$score->id}_{$student->id_student}" value="{$student->score}" style="width: 40px;height:15px;" />
                                </span>
                                <div class="clear"></div>
                            </div>
                            {/foreach}
							<div class="buttonHolder" style="text-align:center;">
	                            <button type="submit"  name="submit" class="primaryAction">ثبت</button>
	                        </div>
	                        <div class="clear"></div>
                        	</form>
                        </div>
		                <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	
	</div>
	<div class="clear"></div>    
</div>
