<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/poll/menu.tpl"}
	</div>    
	<div class="right _765 ">
		
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">نظرسنجی شماره {$poll->id}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
						<h3>{$poll->question}</h3>
						{foreach $answers as $answer }
							<div>{$answer->answer} ({$answer->count} رای)</div>
							<div class="clear"></div>	 
						{/foreach}
						<div class="clear"></div>
						<!--Load the AJAX API-->
						    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
						    
						    <script type="text/javascript">
						
						      // Load the Visualization API and the piechart package.
						      {literal}google.load('visualization', '1.0', {'packages':['corechart']}); {/literal}
						  
						      // Set a callback to run when the Google Visualization API is loaded.
						      google.setOnLoadCallback(drawChart);
						
						      // Callback that creates and populates a data table,
						      // instantiates the pie chart, passes in the data and
						      // draws it.
						      
						      function drawChart() {literal}{{/literal}
						
						        // Create the data table.
						        var data = new google.visualization.DataTable();
						        data.addColumn('string', 'Topping');
						        data.addColumn('number', 'Slices');
						        data.addRows([
						        {foreach $answers as $answer}
						        ['{$answer->answer}', {$answer->count}],
						        {/foreach}
						        ]);
						
						        // Set chart options
						        var options = {literal}{{/literal}'title':'{$poll->question}',
						                       'width':740,
						                       'height':300,
						                       'background' : '#f4f4f4' ,
						                       {literal}}{/literal};
						
						        // Instantiate and draw our chart, passing in some options.
						        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
						        chart.draw(data, options);
						        
						        
						        
						      {literal}}{/literal}
						       
						    </script>
						    <div id="chart_div" ></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	
	</div>
	<div class="clear"></div>    
</div>