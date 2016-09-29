<form method="post" action="bazar_1/editsponsor/{$show_sponsor->id}" >
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
            ویرایش اسپانسر جدید
            </div>
        </div>
        <div class="mid">
            <div class="txt">
                <input type="submit" name="edit" value="ویرایش  اسپانسر" />
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
            نام اسپانسر
            </div>
        </div>
        <div class="mid">
            <div class="txt">
            <input type="text"  name="name" class="box_title" value="{$show_sponsor->name}" />
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
            <textarea id="txt" name="txt">{$show_sponsor->txt}</textarea> 
    		<script type="text/javascript">
    			var oFCKeditor = new FCKeditor( 'txt' );
    			oFCKeditor.BasePath = "{$loct}/js/fckeditor/";
    			oFCKeditor.ReplaceTextarea();
    		</script>
            </div>
        </div>
    </div>
    <!-- end box -->
    
</div>
<div class="clear"></div>
</div>
</form>