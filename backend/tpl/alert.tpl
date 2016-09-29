{if isset($alert) }
    <div class="alert alert-{$alert} alert-dismissable " id="alert_box">
        <i class="fa fa-{if $alert eq "success"}check{/if}{if $alert eq "danger"}ban{/if}{if $alert eq "info"}info{/if}{if $alert eq "warning"}warning{/if}"></i>
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4>@@{$alert}@@</h4>
        <p>
        {foreach from=$result item="res"}
        <p>{$res}</p>
        {/foreach}
        </p>
    </div>

    <script>
    setTimeout(function() {
            $('#alert_box').fadeOut('slow');
        }, 5000); 
    </script>
{/if}
