<div class="wrapper" >
	<div class="right _255 ">
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">انتخاب کاربر</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                		<form method="get" action="workbook/chart/?" class="uniForm" >
                        <div class="ctrlHolder">
                              <select name="id" id="id" class="selectInput r_size" >
                              	<option value="">--انتخاب کاربر--</option>
	                                {foreach $users as $key => $val}
	                                <option value="{$key}" {if $key eq $smarty.get.id }selected="selected"{/if} >{$val}</option>
	                                {/foreach}
                              </select>
                              <p class="formHint"></p>
                        </div>
						<div class="buttonHolder">
                            <button type="submit" class="primaryAction">تایید</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                        <div class="clear"></div>
                        </form>
                    	<div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
		{include file="tpl/workbook/menu.tpl"}
	</div>
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">نمودار پیشرفت تحصیلی</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    
						{if isset($smarty.get.id) and $users[$smarty.get.id] neq null}
							<p>نمودار پیشرفت تحصیلی <b>{$users[$smarty.get.id]}</b></p>							
							{if isset($workbooks)}
						    	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
									    <script type="text/javascript">
									    {literal}
									      google.load("visualization", "1", {packages:["corechart"]});
									      google.setOnLoadCallback(drawChart);
									      function drawChart() {
									    {/literal}

											  var dataTable = new google.visualization.DataTable();
									      dataTable.addColumn('string', 'کارنامه');
									      dataTable.addColumn('number', 'معدل');
									      dataTable.addRows([
											    {foreach $workbooks as $row }
											    ["{show_pg_title id = $row->parent_id}", {$row->pg_content}],
											    {/foreach}
									      ]);

									        var options = {literal}{{/literal}
									          title: ''
									       {literal} }{/literal};

									           var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
									           chart.draw(dataTable, options);
									        {literal} }{/literal}
								</script>
								<div id="chart_div" style="width: 700px; height: 500px;"></div>
							{else}
								<p align="center">این کاربر کارنامه‌ای ندارد</p>
							{/if}
						{else}
							<p align="center">لطفا در سمت راست کاربر را انتخاب کنید</p>
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