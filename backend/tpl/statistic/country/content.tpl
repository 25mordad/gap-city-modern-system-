<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    آمار کشور
                </h3>
            </div><!-- /.box-header -->
            <div class="box-body ">
                {include file="tpl/$part/menu.tpl"}

                <div class="chart" id="line-chart" style="height: 600px;"></div>


                <link href="{$loct}/css/morris/morris.css" rel="stylesheet" type="text/css" />
                <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

                <!-- Morris.js charts -->
                <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
                <script src="{$loct}/js/plugins/morris/morris.min.js" type="text/javascript"></script>

                <!-- AdminLTE App -->
                <script src="{$loct}/js/AdminLTE/app.js" type="text/javascript"></script>
                <!-- AdminLTE for demo purposes -->
                <script src="{$loct}/js/AdminLTE/demo.js" type="text/javascript"></script>
                <!-- page script -->
                <script type="text/javascript">
                    $(function() {
                        "use strict";


                        // LINE CHART
                        var line = new Morris.Donut({
                            element: 'line-chart',
                            resize: true,
                            data: [
                                {foreach $static_country as $s_k}
                                    {if $s_k->getcountry() neq "(not set)" }{ label: '{$s_k->getcountry()}', value: {$s_k->getVisits()} },{/if}
                                {/foreach}

                            ]
                        });

                    });
                </script>


            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>