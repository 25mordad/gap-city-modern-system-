<div class="wrapper" >
	<div class="right _255 ">
	    {include file="tpl/statistic/menu.tpl"}
</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">بازدید هفته گذشته |  
            {if !$static_error}{jdate("Y/m/d",strtotime( "$static_date_from" ))}-{jdate("Y/m/d",strtotime( "$static_date_to" ))}{/if}</div>
                    <img src="{$loct}/images/icon/st_wk.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
            
                {if !$static_error}
                <div >
                     
                               
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    {literal}
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
    {/literal}
        var data = google.visualization.arrayToDataTable([
          ['تاریخ', 'نمایش صفحه', 'بازدید کننده'],
          	{foreach $static_date as $s_d}
	       {assign var=year value=substr($s_d, -8 , 4)}
	       {assign var=mnth value=substr($s_d, -4 , 2)}
	       {assign var=day value=substr($s_d, -2)}
	       ['{jdate(" l j F",strtotime( "$year-$mnth-$day " ))}',  {$s_d->getPageviews() },      {$s_d->getVisits()}],
	       {/foreach}
        ]);
	
        var options = {literal}{{/literal}
          title: 'آمار هفته ی گذشته'
       {literal} }{/literal};

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
     {literal} }{/literal}
    </script>
<div id="chart_div" style="width: 750px; height: 500px;"></div>

                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                               نمایش صفحات {$static_date_getPageviews} مرتبه 
                               <hr />
                               بازدید کننده {$static_date_getVisits} نفر
                         
                              
                         
                        <div class="complt border">
                        تعداد کل بازدید کنندگان  {$static_key_getVisits} نفر <br />
                        تعداد کل نمایش صفحات  {$static_key_getPageviews} مرتبه 
                        </div>
                    </div>
                    <div class="clear"></div>

            {else}
            خطا در نمایش اطلاعات آماری
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