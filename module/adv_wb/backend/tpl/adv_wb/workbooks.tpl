<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/adv_wb/menu.tpl"}
	</div>    
	<div class="right _765 ">
	<!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">کارنامه {show_value_user_param id_user =$smarty.get.id_student name = 14 } {show_value_user_param id_user =$smarty.get.id_student name = 15 } | کلاس {$class->name} | سال تحصیلی {$default_year->name}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
								<style>
                                .list { background: gray; margin: 2px; padding: 5px;border-radius: 5px; }
                                .list:hover { background: #CCCCCC; }
                                </style>
                                
							            <div class="right" style="width: 30px;border:1px solid black;text-align: center;" ><strong>ردیف</strong></div>
							            <div class="right" style="width: 100px;border:1px solid black;text-align: center;" ><strong>نام درس</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>ضریب</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>مهر</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>آبان</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>آذر</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>دی</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>بهمن</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>اسفند</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>فروردین</strong></div>
							            <div class="right" style="width: 60px;border:1px solid black;text-align: center;" ><strong>اردیبهشت</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>خرداد</strong></div>
							            
							            <div class="clear"></div>
							            <style>
							            .bg_0 {
							                background: #CCCCCC;
							                width: 50px;border:1px solid black;text-align: center;
							                
							            }
							            .bg_1 {
							                background: #666666;
							                width: 50px;border:1px solid black;text-align: center;
							                color: white;
							            }
							            </style>
							            {$cnt             = 0}
							            {$i               = 1}
							            {$jam_zarb        = 0}
							            {$mehr_avg        = 0}
							            {$aban_avg        = 0}
							            {$azar_avg        = 0}
							            {$dey_avg         = 0}
							            {$bahman_avg      = 0}
							            {$sfand_avg       = 0}
							            {$farvardin_avg   = 0}
							            {$ordibehesht_avg = 0}
							            {$khordad_avg     = 0}
													            
						            {foreach $lessons as $lesson}
						            <div title="{$cnt++}" class="right bg_{$cnt%2}" style="width: 30px;border:1px solid black;text-align: center;" >{$i++}</div>
						            <div  class="right bg_{$cnt%2}" style="width: 100px;border:1px solid black;text-align: center;" >{$lesson->name}</div>
						            <div  class="right bg_{$cnt%2}" style="width: 50px;border:1px solid black;text-align: center;" >{if $lesson->rate eq null}{$rate='1'}{else}{$rate=$lesson->rate}{/if}{$rate}{$jam_zarb = $jam_zarb + $rate}</div>
									<div class=" right bg_{$cnt%2}"  >{find_number_of_student type="mhr" id_student=$smarty.get.id_student  id_class=$class->id  id_lesson=$lesson->id_lesson }{$number_ls}{$mehr_avg = $mehr_avg + $number_ls*$rate}{if $number_ls eq "-"}{$error_mehr = true}{/if}</div>
						            <div class="right bg_{$cnt%2}"  >{find_number_of_student type="abn" id_student=$smarty.get.id_student  id_class=$class->id  id_lesson=$lesson->id_lesson }{$number_ls}{$aban_avg = $aban_avg + $number_ls*$rate}{if $number_ls eq "-"}{$error_aban = true}{/if}</div>
						            <div class="right bg_{$cnt%2}"  >{find_number_of_student type="azr" id_student=$smarty.get.id_student  id_class=$class->id  id_lesson=$lesson->id_lesson }{$number_ls}{$azar_avg = $azar_avg + $number_ls*$rate}{if $number_ls eq "-"}{$error_azar = true}{/if}</div>
						            <div class="right bg_{$cnt%2}"  >{find_number_of_student type="dey" id_student=$smarty.get.id_student  id_class=$class->id  id_lesson=$lesson->id_lesson }{$number_ls}{$dey_avg = $dey_avg + $number_ls*$rate}{if $number_ls eq "-"}{$error_dey = true}{/if}</div>
						            <div class="right bg_{$cnt%2}"  >{find_number_of_student type="bah" id_student=$smarty.get.id_student  id_class=$class->id  id_lesson=$lesson->id_lesson }{$number_ls}{$bahman_avg = $bahman_avg + $number_ls*$rate}{if $number_ls eq "-"}{$error_bahman = true}{/if}</div>
						            <div class="right bg_{$cnt%2}"  >{find_number_of_student type="sfn" id_student=$smarty.get.id_student  id_class=$class->id  id_lesson=$lesson->id_lesson }{$number_ls}{$sfand_avg = $sfand_avg + $number_ls*$rate}{if $number_ls eq "-"}{$error_sfand = true}{/if}</div>
						            <div class="right bg_{$cnt%2}" >{find_number_of_student type="far" id_student=$smarty.get.id_student  id_class=$class->id  id_lesson=$lesson->id_lesson }{$number_ls}{$farvardin_avg = $farvardin_avg + $number_ls*$rate}{if $number_ls eq "-"}{$error_farvardin = true}{/if}</div>
						            <div class="right bg_{$cnt%2}" style="width: 60px;" >{find_number_of_student type="ord" id_student=$smarty.get.id_student  id_class=$class->id  id_lesson=$lesson->id_lesson }{$number_ls}{$ordibehesht_avg = $ordibehesht_avg + $number_ls*$rate}{if $number_ls eq "-"}{$error_ordibehesht = true}{/if}</div>
						            <div class="right bg_{$cnt%2}"  >{find_number_of_student type="kho" id_student=$smarty.get.id_student  id_class=$class->id  id_lesson=$lesson->id_lesson }{$number_ls}{$khordad_avg = $khordad_avg + $number_ls*$rate}{if $number_ls eq "-"}{$error_khordad = true}{/if}</div>
						            <div class="clear"></div>
						            {/foreach}
							            
							            <div class="right" style="width: 132px;border:1px solid black;text-align: center;" ><strong>جمع</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{$jam_zarb}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{$mehr_avg}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{$aban_avg}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{$azar_avg}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{$dey_avg}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{$bahman_avg}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{$sfand_avg}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{$farvardin_avg}</strong></div>
							            <div class="right" style="width: 60px;border:1px solid black;text-align: center;" ><strong>{$ordibehesht_avg}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{$khordad_avg}</strong></div>
							            <div class="clear"></div>
							            
							            <div class="right" style="width: 184px;border:1px solid black;text-align: center;" ><strong>معدل</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{if !isset($error_mehr)}{number_format($mehr_avg/$jam_zarb, 2, '.', '')}{else}-{/if}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{if !isset($error_aban)}{number_format($aban_avg/$jam_zarb, 2, '.', '')}{else}-{/if}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{if !isset($error_azar)}{number_format($azar_avg/$jam_zarb, 2, '.', '')}{else}-{/if}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{if !isset($error_dey)}{number_format($dey_avg/$jam_zarb, 2, '.', '')}{else}-{/if}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{if !isset($error_bahman)}{number_format($bahman_avg/$jam_zarb, 2, '.', '')}{else}-{/if}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{if !isset($error_sfand)}{number_format($sfand_avg/$jam_zarb, 2, '.', '')}{else}-{/if}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{if !isset($error_farvardin)}{number_format($farvardin_avg/$jam_zarb, 2, '.', '')}{else}-{/if}</strong></div>
							            <div class="right" style="width: 60px;border:1px solid black;text-align: center;" ><strong>{if !isset($error_ordibehesht)}{number_format($ordibehesht_avg/$jam_zarb, 2, '.', '')}{else}-{/if}</strong></div>
							            <div class="right" style="width: 50px;border:1px solid black;text-align: center;" ><strong>{if !isset($error_khordad)}{number_format($khordad_avg/$jam_zarb, 2, '.', '')}{else}-{/if}</strong></div>
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
