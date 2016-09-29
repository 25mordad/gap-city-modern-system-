{if isset($alert) }
    <!-- BOX_ALARM -->
    <div class="{$alert}_box" id="alert_box" onclick="fout_alert();" >
        <div class="title BYekan">
          @@{$alert}@@
        </div>
        <div class="txt ">
        {foreach from=$result item="res"}
			<p>@@{$res}@@</p>
		{/foreach}
        </div>
    </div>
    <script>
    function fout_alert()
    {
         setTimeout(function() {
            $('#alert_box').fadeOut('slow');
        }, 100);   
    }
    setTimeout(function() {
            $('#alert_box').fadeOut('slow');
        }, 5000); 
    </script>
    <!-- /BOX_ALARM -->
{/if}
