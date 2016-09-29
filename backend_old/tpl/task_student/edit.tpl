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
                <a href="task_student">
                <div class="side_menu">
                <div class="txt">لیست تکالیف</div>
                <div class="icon ns_nw"></div>
                <div class="clear"></div>
                </div>
                </a>
                <!-- /sm -->                         
                <!-- sm -->
                <a href="task_student/new">
                <div class="side_menu">
                <div class="txt">ایجاد تکلیف</div>
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
          اضافه کردن تکلیف
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
                'script'      : SERVER_HTTP_HOST() + '/gadmin/task_student/edit/{$show_task_student->id}/task_studentAjaxController',
                'cancelImg'   : '{$loct}/images/cancel.png',
                'folder'      : '/uploads/task_student/{$smarty.now|date_format:'%Y-%m-%d'}/{$show_task_student->id}/{10000|rand:99000}',
                'displayData' : 'speed',
                'fileExt'     : '*.jpg;*.gif;*.png;*.pdf;*.doc;*.docx;',
                'multi'       : true,
                'sizeLimit'   : 2000000,
                //'width'     : 250,
                'auto'        : true,
                'onComplete'  : function(event, ID, fileObj, response, data) {
                  showimagesf5_task_student({$show_task_student->id});
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
                <script>showimagesf5_task_student({$show_task_student->id})</script>
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
            تکلیف جدید
            </div>
        </div>
        <div class="mid">
            <div class="txt">
                <div id="stylized" class="form_add_user">
                <form action="task_student/edit/{$show_task_student->id} " method="post" >
                <h1>ویرایش تکلیف</h1>
                <p></p>
                
                <label for="parent_id">عنوان تکلیف
                <span class="small"></span>
                </label>
                <select name="parent_id" id="parent_id" class="select_parent center">
                <option value="0">انتخاب کنید&hellip;</option>
                {selectTagGenerator info=$show_title_task_student default= {$show_task_student->parent_id} }
                </select> 
                
                <label for="pg_title">مربوط به کاربر
                <span class="small"></span>
                </label>
               <select name="pg_title" id="pg_title" class="select_parent center">
                <option value="0">انتخاب کنید&hellip;</option>
                {selectTagGenerator info= $show_title_user default= {$show_task_student->pg_title} }
                </select> 

                <label for="pg_content">توضیحات
                <span class="small"></span>
                </label>
                <input type="text" name="pg_content" id="pg_content" value="{$show_task_student->pg_content}" />
              
              
                   
                <input type="submit" value="ویرایش" name="edit" />
                
                <div class="clear"></div>
                </form>
                
                </div>
                <!-- sm -->
                <div align="left">
                <a href="task_student/delete/{$show_task_student->id}">
                <div class="side_menu">
                <div class="txt">حذف تکلیف</div>
                <div class="icon ns_nw"></div>
                <div class="clear"></div>
                </div>
                </a>
                </div>
                <!-- /sm --> 
            </div>
        </div>
    </div>
    <!-- end box -->
   
    
</div>
<div class="clear"></div>

</div>