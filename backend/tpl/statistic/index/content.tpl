<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    آمار هفته گذشته
                    {jdate("Y/m/d",strtotime( "$static_date_from" ))}-{jdate("Y/m/d",strtotime( "$static_date_to" ))}
                </h3>
            </div><!-- /.box-header -->
            <div class="box-body ">
                {include file="tpl/$part/menu.tpl"}

                <div class="chart" id="line-chart" style="height: 300px;"></div>

                <div class="col-md-12" >
                    <div class="clearfix" ></div>
                    <span class="label label-primary">
                        بازدید کل صفحات تا کنون
                        {number_format($static_key_getVisits)} مرتبه
                    </span>

                    <span class="label label-success" style="margin-right: 10px">
                        نمایش کل صفحات تا کنون
                        {number_format($static_key_getPageviews)} مرتبه
                    </span>
                    <div class="clearfix" ></div>
                </div>

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
                        var line = new Morris.Area({
                            element: 'line-chart',
                            resize: true,
                            data: [
                                {foreach $static_date as $s_d}
                                {assign var=year value=substr($s_d, -8 , 4)}
                                {assign var=mnth value=substr($s_d, -4 , 2)}
                                {assign var=day value=substr($s_d, -2)}

                                { y: '{jdate("l j F",strtotime( "$year-$mnth-$day" ))}', item1: {$s_d->getPageviews()}, item2: {$s_d->getVisits()} },
                                {/foreach}

                            ],
                            xkey: 'y',
                            ykeys: ['item1','item2'],
                            labels: [' نمایش ',' بازدید '],
                            lineColors: ['#a0d0e0', '#00a65a'],
                            parseTime:false
                        });

                    });
                </script>


            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>