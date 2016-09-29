<form method="post" action="bazar_1/edit/{$show_bazar_1->id}" >
<link href="{$loct}/css/old_style.css" rel="stylesheet" type="text/css" />
<div class="wrapper" >
	<div class="right _255 ">
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right"></div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
						
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
	    <!-- start box -->
    <div class="box">
        <div class="top">
            <div class="title icon_info">
            ویرایش حراج
            </div>
        </div>
        <div class="mid">
            <div class="txt">
            {if $show_bazar_1->status eq "save" }
                <input type="submit" name="edit" value="ذخیره نهایی" />
            {else}
            	<input type="submit" name="edit" value="ویرایش" />
            {/if}
            </div>
        </div>
    </div>
    <!-- end box -->
    <!-- start box -->
    <div class="box">
        <div class="top">
            <div class="title icon_info">
            وضعیت حراج
            </div>
        </div>
        <div class="mid">
            <div class="txt">
            {$radios = [
                ['name'=>"فعال"       , 'value' => "publish"],
                ['name' => "غیر فعال" , 'value' => "pending"]
                ]}
            {if $show_bazar_1->status eq "save" }
            	{radioTagGenerator info = $radios default= "publish" radioName= "status"}
            {else}
                {radioTagGenerator info = $radios default= "{$show_bazar_1->status}" radioName= "status"}
            {/if}
                
            </div>
        </div>
    </div>
    <!-- end box -->
    <!-- start box -->
    <div class="box">
        <div class="top">
            <div class="title icon_info">
            زمان بندی حراج
            </div>
        </div>
        <div class="mid">
            <div class="txt">
            <link rel="stylesheet" type="text/css" media="all" href="{$loct}/css/skins/aqua/theme.css" title="Aqua" />
            <script type="text/javascript" src="{$loct}/js/jalali.js"></script>
            <script type="text/javascript" src="{$loct}/js/calendar.js"></script>
            <script type="text/javascript" src="{$loct}/js/calendar-setup.js"></script>
            <script type="text/javascript" src="{$loct}/js/calendar-fa.js"></script>		
		
		<div class="timestart">
			<label for="time_start"><b>زمان شروع حراج</b></label>
			<br/>{jdate(" l j F Y H:i",strtotime( $show_bazar_1->time_start ))}<br/>
			<input type="text" class="time_start" id="time_start" name="time_start" value="{$show_bazar_1->time_start}" />
			<img id="date_time_start" src="{$loct}/images/cal.png" style="vertical-align: top;margin-top: 10px" />
			<script type="text/javascript">
				Calendar.setup({
					inputField  : "time_start",   // id of the input field
					button      : "date_time_start",   // trigger for the calendar (button ID)
		       		ifFormat    : "%Y-%m-%d %H:%M:00",       // format of the input field
		       		showsTime   : true,
		       		dateType	: 'jalali',
		       		ifDateType	: 'gregorian',
		       		showOthers  : true ,
		       		weekNumbers : false
				});
			</script>
		</div>

		<div class="timemid">
			<label for="time_mid"><b>زمان میانی حراج</b></label>
			<br/>{jdate(" l j F Y H:i",strtotime( $show_bazar_1->time_mid ))}<br/>
			<input type="text" class="time_start" id="time_mid" name="time_mid" value="{$show_bazar_1->time_mid}" />
			<img id="date_time_mid" src="{$loct}/images/cal.png" style="vertical-align: top;margin-top: 10px" />
			<script type="text/javascript">
				Calendar.setup({
					inputField  : "time_mid",   // id of the input field
					button      : "date_time_mid",   // trigger for the calendar (button ID)
		       		ifFormat    : "%Y-%m-%d %H:%M:00",       // format of the input field
		       		showsTime   : true,
		       		dateType	: 'jalali',
		       		ifDateType	: 'gregorian',
		       		showOthers  : true,
		       		weekNumbers : false
				});
			</script>
		</div>

		<div class="timemidfin">
			<label for="time_mid_fin"><b>زمان قبل از پایان حراج</b></label>
			<br/>{jdate(" l j F Y H:i",strtotime( $show_bazar_1->time_mid_fin ))}<br/>
			<input type="text" class="time_start" id="time_mid_fin" name="time_mid_fin" value="{$show_bazar_1->time_mid_fin}" />
			<img id="date_time_mid_fin" src="{$loct}/images/cal.png" style="vertical-align: top;margin-top: 10px" />
			<script type="text/javascript">
				Calendar.setup({
					inputField  : "time_mid_fin",   // id of the input field
					button      : "date_time_mid_fin",   // trigger for the calendar (button ID)
		       		ifFormat    : "%Y-%m-%d %H:%M:00",       // format of the input field
		       		showsTime   : true,
		       		dateType	: 'jalali',
		       		ifDateType	: 'gregorian',
		       		showOthers  : true,
		       		weekNumbers : false
				});
			</script>
		</div>

		<div class="timeend">
			<label for="time_end"><b>زمان پایان حراج</b></label>
			<br/>{jdate(" l j F Y H:i",strtotime( $show_bazar_1->time_end ))}<br/>
			<input type="text" class="time_start" id="time_end" name="time_end" value="{$show_bazar_1->time_end}" />
			<img id="date_time_end" src="{$loct}/images/cal.png" style="vertical-align: top;margin-top: 10px" />
			<script type="text/javascript">
				Calendar.setup({
					inputField  : "time_end",   // id of the input field
					button      : "date_time_end",   // trigger for the calendar (button ID)
		       		ifFormat    : "%Y-%m-%d %H:%M:00",       // format of the input field
		       		showsTime   : true,
		       		dateType	: 'jalali',
		       		ifDateType	: 'gregorian',
		       		showOthers  : true,
		       		weekNumbers : false
				});
			</script>
		</div>

            </div>
        </div>
    </div>
    <!-- end box -->
    <!-- start box -->
    <div class="box">
        <div class="top">
            <div class="title icon_info">
            قیمت گذاری حراج
            </div>
        </div>
        <div class="mid">
            <div class="txt">
               <label for="fee_real"><b>قیمت واقعی کالا (تومان)</b></label>
               <input type="text" name="fee_real" class="class_name" id="fee_real" value="{$show_bazar_1->fee_real}"  />
               <br/>
               <label for="fee_start"><b>قیمت شروع حراج (تومان)</b></label>
               <input type="text" name="fee_start" class="class_name" id="fee_start"  value="{$show_bazar_1->fee_start}" />
				<br/>
               <label for="min_bid"><b>رنج پیشنهاد از (تومان)</b></label>
               <input type="text" name="min_bid" class="class_name" id="min_bid" value="{$show_bazar_1->min_bid}" />
				<br/>
               <label for="max_bid"><b>رنج پیشنهاد تا (تومان)</b></label>
               <input type="text" name="max_bid" class="class_name" id="max_bid" value="{$show_bazar_1->max_bid}" />
				<br/>
               <label for="bid_reng"><b>به صورت (تومان)</b></label>
               <input type="text" name="bid_reng" class="class_name" id="bid_reng" value="{$show_bazar_1->bid_reng}" />
            </div>
        </div>
    </div>
    <!-- end box -->
    <!-- start box -->
    <div class="box">
        <div class="top">
            <div class="title icon_info">
           انتخاب اسپانسر حراج
            </div>
        </div>
        <div class="mid">
            <div class="txt">
                <select name="id_sponsor" class="select_parent center" >
            	{selectTagGenerator info= $all_sponsor default= {$show_bazar_1->id_sponsor} }
            </select>
            </div>
        </div>
    </div>
    <!-- end box -->

</div>
    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right"></div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    	
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	
	
    <!-- start box -->
    <div class="box">
        <div class="top">
            <div class="title icon_info">
            عنوان کالا
            </div>
        </div>
        <div class="mid">
            <div class="txt">
            <input type="text"  name="name" class="box_title" value="{$show_bazar_1->name}" />
            </div>
        </div>
    </div>
    <!-- end box -->
    <!-- start box -->
    <div class="box">
        <div class="top">
            <div class="title icon_info">
           توضیحات
            </div>
        </div>
        <div class="mid">
            <div class="txt">
            <textarea id="txt" name="txt">{$show_bazar_1->txt}</textarea> 
    		<script type="text/javascript">
    			var oFCKeditor = new FCKeditor( 'txt' );
    			oFCKeditor.BasePath = "{$loct}/js/fckeditor/";
    			oFCKeditor.ReplaceTextarea();
    		</script>
            </div>
        </div>
    </div>
    <!-- end box -->
    <!-- start box -->
    <div class="box">
        <div class="top">
            <div class="title icon_info">
             متن توضیحات ساعت میانی
            </div>
        </div>
        <div class="mid">
            <div class="txt">
            <input type="text"  name="time_mid_txt" class="box_title" value="{$show_bazar_1->time_mid_txt}" />
            </div>
        </div>
    </div>
    <!-- end box -->
    <!-- start box -->
    <div class="box">
        <div class="top">
            <div class="title icon_img">
            @@page_index_image_label@@
            </div>
        </div>
        <div class="mid">
            <div class="txt">
                <div class="shakhes_brows">
                <div class="txt">
                <img src="{$loct}/images/icon/icon_arrow.png" class="arrow" />انتخاب تصویر <br />
                
                <link href="{$loct}/css/uploadify.css" type="text/css" rel="stylesheet" />
                <script type="text/javascript" src="{$loct}/js/swfobject.js"></script>
                <script type="text/javascript" src="{$loct}/js/jquery.uploadify.v2.1.4.min.js"></script>
                
                <script type="text/javascript">

                $(document).ready(function() {
                $('#file_upload').uploadify({
                'uploader'    : '{$loct}/images/uploadify.swf',
                'script'      : SERVER_HTTP_HOST() + '/gadmin/bazar_1/edit/{$show_bazar_1->id}/bazar_1AjaxController',
                'cancelImg'   : '{$loct}/images/cancel.png',
                'folder'      : '/uploads/bazar_1/{$show_bazar_1->id}/{$smarty.now|date_format:'%Y-%m-%d'}',
                'displayData' : 'speed',
                'fileExt'     : '*.jpg;*.gif;*.png;',
                'multi'       : true,
                'sizeLimit'   : 1000000,
                //'width'     : 250,
                'auto'        : true,
                'onComplete'  : function(event, ID, fileObj, response, data) {
                  showimagesf5_bazar_1({$show_bazar_1->id});
                }               
                });
                });
                
                </script>
                <input id="file_upload" name="file_upload" type="file"   />
                
                </div>
                </div>
                <div class="clear"></div>
                <div class="show_pics" >
                <div class="txt">
                <div class="showimages" id="showimages" >
                <script>showimagesf5_bazar_1({$show_bazar_1->id})</script>
                <div class="clear"></div>
                </div>
                </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <!-- end box -->
    
</div>
<div class="clear"></div>
</div>
</form>