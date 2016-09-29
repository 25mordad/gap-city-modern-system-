<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/adv_wb/menu.tpl"}
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/search.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
		{include file="tpl/adv_wb/filter.tpl"}
	</div>
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست کلاس‌ها</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
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
					    <script src="{$loct}/js/jquery-ui-1.7.2.custom.min.js"></script>
					    <link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
						<script src="{$loct}/js/jquery.easy-confirm-dialog.js"></script>
			            {literal}
			            <script>
				            $(function() {
				            $(".confirm_dialog").easyconfirm({locale: $.easyconfirm.locales.faIR});
				            });
			            </script>
			            {/literal}
	                    <style>
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    .plus { background: url({$loct}/images/icon/plus.png)  }
	                    .score { background: url({$loct}/images/icon/parent.png)  }
	                    .info { background: url({$loct}/images/icon/info.png)  }
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 120px;">نام</span>
                                <span style="width: 110px;">شعبه</span>
                                <span style="width: 110px;">پایه</span>
                                <span style="width: 70px;">ظرفیت خالی</span>
                                <span style="width: 55px;">اطلاعات</span>
                                <span style="width: 90px;">ویرایش</span>
                                <span style="width: 40px;">نمرات</span>
                                <span style="width: 40px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $classes as $class}
                            <div class="row_1">
                                <span style="width: 120px;" class="BYekan" title="{$class->name}<br>{$arr_ages[$class->ages]} - {$arr_sex[$class->sex]}<br>{if $class->tuition}شهریه: {$class->tuition} ریال{/if}<br>{if $class->text}{$class->text|truncate:40}{/if}">{$class->name|truncate:15:"..":true}</span>
                                <span style="width: 110px;font-size:10px;" title="{$branches[$class->id_branch]}">{$branches[$class->id_branch]|truncate:20:"..":true}</span>
                                <span style="width: 110px;font-size:10px;" title="{$class->grade_name}">{$class->grade_name|truncate:20:"..":true}</span>
                                <span style="width: 70px;" title="ظرفیت اولیه: {$class->capacity} نفر">{$class->capacity - $class->used_capacity} نفر</span>
                                <span style="width: 50px;" title="برای دیدن لیست معلم‌ها، درس‌ها و دانش‌آموزان کلاس کلیک کنید "><a href="adv_wb/infoclass/{$class->id}"><div class="icon info" ></div></a></span>
                                <span style="width: 40px;"><a href="adv_wb/editclass/{$class->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 40px;" title="اضافه کردن درس، معلم یا دانش‌آموز به کلاس"><a href="adv_wb/infoclass/{$class->id}"><div class="icon plus" ></div></a></span>
                                <span style="width: 40px;"><a href="adv_wb/scoreclass/{$class->id}"><div class="icon score" ></div></a></span>
                                <span style="width: 40px;" class="last">
                                	<a href="adv_wb/delclass/{$class->id}/?paging={$smarty.get.paging}" 
                                		title="کلاس {$class->name} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
                                </span>
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                        </div>
		                <div class="clear"></div>      
		                <!-- paging -->
		                <div class="paging">
		                {section name=num start=1 loop=$paging+1 }
		                    {if $smarty.section.num.index neq $smarty.get.paging}
		                    <a href="{pagingurl url= $smarty.server.REQUEST_URI paging= {$smarty.section.num.index} }"><span>{$smarty.section.num.index}</span></a>
		                    {else}
		                    <span class="actpagin">{$smarty.section.num.index}</span>
		                    {/if}
		                {/section}
		                </div>
		                <!-- paging -->         	
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->
	</div>
	<div class="clear"></div>
</div>