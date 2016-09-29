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
{include file="tpl/web_sample/menu.tpl"}
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
    <div class="title icon_info">ویرایش نمونه کار</div>
    </div>
<div class="mid">
<div class="txt">
                <div class="shakhes_brows">
                <div class="txt">
                <img src="{$loct}/images/icon/icon_arrow.png" class="arrow" />انتخاب فایل <br />
                
                <script>
                //web_sample
                function showimagesf5_web_sample(id){
                	createXMLHTTPObject();
                	if(xmlHttp != null){
                
                		xmlHttp.open('post',SERVER_HTTP_HOST() + '/gadmin/web_sample/edit/'+id+'/web_sampleAjaxController',true);
                		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                		xmlHttp.onreadystatechange = showimages;
                		requestString = 'action=showimagesf5_web_sample&id='+id ;
                		xmlHttp.send(requestString);
                		
                	}	
                }
                
                function delimg_web_sample(id)
                {
                	createXMLHTTPObject();
                	if(xmlHttp != null){
                
                		xmlHttp.open('post',document.URL + '/web_sampleAjaxController',true);
                		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                		xmlHttp.onreadystatechange = showimages;
                		requestString = 'action=delimg&id=' + id;
                		xmlHttp.send(requestString);
                		
                	}
                }
                </script>
                <link href="{$loct}/css/uploadify.css" type="text/css" rel="stylesheet" />
                <script type="text/javascript" src="{$loct}/js/swfobject.js"></script>
                <script type="text/javascript" src="{$loct}/js/jquery.uploadify.v2.1.4.min.js"></script>
                
                <script type="text/javascript">

                $(document).ready(function() {
                $('#file_upload').uploadify({
                'uploader'    : '{$loct}/images/uploadify.swf',
                'script'      : SERVER_HTTP_HOST() + '/gadmin/web_sample/edit/{$show_sample->id}/web_sampleAjaxController',
                'cancelImg'   : '{$loct}/images/cancel.png',
                'folder'      : '/uploads/web_sample/{$smarty.now|date_format:'%Y-%m-%d'}/{$show_sample->id}',
                'displayData' : 'speed',
                'fileExt'     : '*.jpg;*.gif;*.png;',
                'multi'       : true,
                'sizeLimit'   : 2000000,
                //'width'     : 250,
                'auto'        : true,
                'onComplete'  : function(event, ID, fileObj, response, data) {
                  showimagesf5_web_sample({$show_sample->id});
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
                <script>showimagesf5_web_sample({$show_sample->id})</script>
                <div class="clear"></div>
                </div>
                </div>
                </div>
<div	id="stylized"	class="form_add_user">
<form	action="web_sample/edit/{$show_sample->id}"	method="post">
<h1>ویرایش نمونه کار</h1>
<p>{$show_sample->name}</p>

<label for="name">نام<span class="small"></span> </label> 
<input	type="text"	name="name"	id="name" value="{$show_sample->name}"/>

<label for="url">آدرس url<span class="small"></span> </label> 
<input	type="text"	name="url"	id="url" value="{$show_sample->url}"/>

{$status = [
                        ['name'=>"در حال فعالیت" ,'value'=>"active"],
                        ['name'=>"تعطیل شده"     ,'value'=>"closed"]
                        ]} 
<label for="site_status">وضعیت سایت<span class="small"></span> </label> 
<select	name="site_status"	id="site_status"	class="select_parent center">
	<option value="0">انتخاب کنید&hellip;</option>
	{selectTagGenerator info=$status default= "{$show_sample->site_status}" }
</select> 

<label for="activity">زمینه فعالیت<span class="small"></span> </label> 
<textarea name="activity" id="activity" style="width: 250px;font-size: 11px;">{$show_sample->activity}</textarea>

<label for="active_date">تاریخ راه اندازی سایت<span class="small"></span> </label> 
<input	type="text"	name="active_date"	id="active_date" value="{$show_sample->active_date}"/>

{$status_m = [
                        ['name'=>"در حال نمایش" ,'value'=>"publish"],
                        ['name'=>"حذف"          ,'value'=>"delete"]
                        ]} 
<label for="status">وضعیت<span class="small"></span> </label> 
<select	name="status"	id="status"	class="select_parent center">
	{selectTagGenerator info=$status_m default= "{$show_sample->status}" }
</select> 



<input	type="submit"	value="ویرایش"	name="edit"/>
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