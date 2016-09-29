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
            امکانات
            </div>
        </div>
        <div class="mid">
            <div class="txt">
                <!-- sm -->
                <a href="link">
                <div class="side_menu">
                <div class="txt">لیست پیوند ها</div>
                <div class="icon ns_nw"></div>
                <div class="clear"></div>
                </div>
                </a>
                <!-- /sm -->                        
                <!-- sm -->
                <a href="link/new">
                <div class="side_menu">
                <div class="txt">ایجاد پیوند</div>
                <div class="icon ns_nw"></div>
                <div class="clear"></div>
                </div>
                </a>
                <!-- /sm -->                         
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
            تصویر شاخص
            </div>
        </div>
        <div class="mid">
            <div class="txt">
                <div class="shakhes_brows">
                <div class="txt">
                <img src="{$loct}/images/icon/icon_arrow.png" class="arrow" />انتخاب فایل <br />
                
                <link href="{$loct}/css/uploadify.css" type="text/css" rel="stylesheet" />
                <script type="text/javascript" src="{$loct}/js/swfobject.js"></script>
                <script type="text/javascript" src="{$loct}/js/jquery.uploadify.v2.1.4.min.js"></script>
                
                <script type="text/javascript">

                $(document).ready(function() {
                $('#file_upload').uploadify({
                'uploader'    : '{$loct}/images/uploadify.swf',
                'script'      : SERVER_HTTP_HOST() + '/gadmin/link/edit/{$show_link->id}/linkAjaxController',
                'cancelImg'   : '{$loct}/images/cancel.png',
                'folder'      : '/uploads/link/{$smarty.now|date_format:'%Y-%m-%d'}/{$show_link->id}',
                'displayData' : 'speed',
                'fileExt'     : '*.jpg;*.gif;*.png;',
                'multi'       : true,
                'sizeLimit'   : 1000000,
                //'width'     : 250,
                'auto'        : true,
                'onComplete'  : function(event, ID, fileObj, response, data) {
                  showimagesf5_link({$show_link->id});
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
                <script>showimagesf5_link({$show_link->id})</script>
                <div class="clear"></div>
                </div>
                </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <!-- end box -->
    <!-- start box -->
    <div class="box">
        <div class="top">
            <div class="title icon_info">
            ویرایش پیوند
            </div>
        </div>
        <div class="mid">
            <div class="txt">
                <div id="stylized" class="form_add_user">
                <form action="link/edit/{$show_link->id} " method="post" >
                <h1>ویرایش پیوند</h1>
                <p></p>
                
                <label for="parent_id">گروه پیوند
                <span class="small"></span>
                </label>
                <select name="parent_id" id="parent_id" class="select_parent center">
                <option value="0">انتخاب کنید&hellip;</option>
                {selectTagGenerator info=$show_title_link default= {$show_link->parent_id} }
                </select> 
                
                <label for="pg_title">عنوان پیوند
                <span class="small"></span>
                </label>
                <input type="text" name="pg_title" id="pg_title" value="{$show_link->pg_title}" />
              
                <label for="pg_content">شرح پیوند
                <span class="small"></span>
                </label>
                <input type="text" name="pg_content" id="pg_content" value="{$show_link->pg_content}" />
              
                <label for="pg_excerpt">آدرس URL پیوند
                <span class="small"></span>
                </label>
                <input type="text" name="pg_excerpt" id="pg_excerpt" value="{$show_link->pg_excerpt}" />
              
               
                <label for="pg_status">وضعیت نمایش پیوند
                <span class="small"></span>
                </label>
                {$radios = [['name'=>"در دست بررسی" , 'value' => "pending"],['name' => "status_button_publish" , 'value' => "publish"],['name'=>"status_button_delete" , 'value' => "delete"]]}  	
                {radioTagGenerator info = $radios default= $show_link->pg_status radioName= "pg_status"}
        	
                
                   
                <input type="submit" value="ویرایش" name="edit" />
                
                <div class="clear"></div>
                </form>
                
                </div>
                
            </div>
        </div>
    </div>
    <!-- end box -->
   
    
</div>
<div class="clear"></div>
</div>