var dviHeight = null;
var titleFirstTime = true;
var groupNameFirstTime = true;
var tempX = null;
var tempY = null;
var element = null;
var xmlHttp = null;
var menuLevel = 0;

//*******************************************************AJAX FUNCTIONS***************************************************

function createXMLHTTPObject(){	
	if(window.ActiveXObject){
		xmlHttp = new ActiveXObject('MICROSOFT.XMLHTTP'); 
	}
	else{
		xmlHttp = new XMLHttpRequest();
	}
}


function keywordAction(key,mode){
	
	requestString = null;
	selectedKey = '';
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/pageAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		if(mode == 'SUGGESTION'){
			xmlHttp.onreadystatechange = showResults;
			requestString = 'action=keySuggestion&keyName=' + key;
		}
		else if(mode == 'INSERT'){

			xmlHttp.onreadystatechange = keyInsertResult;
			requestString = 'action=keyInsertion&keyName=' + key + '&page_id=' + document.getElementById('page_id').value + '&selected=' + selectedKey;
		}
		xmlHttp.send(requestString);
		
	}
	
}


function getResults(){
	
	if(xmlHttp.readyState == 4){
		if(menuLevel == 'Level1'){
			if(document.getElementById('selectListLevel2') != null){
				document.getElementById('selectListLevel2').innerHTML = '';
			}
		}
		if(document.getElementById('selectList'+ menuLevel)!= null){
			document.getElementById('selectList'+ menuLevel).innerHTML = xmlHttp.responseText;
		}
	}
}


function showResults(){
	
	if(xmlHttp.readyState == 4){
		if(document.getElementById('keywords').value != ''){
			if(xmlHttp.responseText != 'Empty'){				
				document.getElementById('showList').style.display = 'block';		
				document.getElementById('showList').innerHTML = xmlHttp.responseText;
			}
			else{
				document.getElementById('showList').innerHTML = '';
				document.getElementById('showList').style.display = 'none';
			}
		}
		else{
			document.getElementById('showList').style.display = 'none';
		}
		
	}
	
}

function keyInsertResult(){
	if(xmlHttp.readyState == 4){
		document.getElementById('keywords').value = '';
		document.getElementById('showList').innerHTML = '';
		document.getElementById('showList').style.display = 'none';
	}
}
function showkeyf5(page_id){
	requestString = null;
	selectedKey = '';
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/pageAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showkeyword;
		requestString = 'action=showkeyf5&page_id=' + page_id;
		xmlHttp.send(requestString);
		
	}
	
	
}
function showkeyword(){
	
	if(xmlHttp.readyState == 4){
		document.getElementById('keywords').value = '';
		document.getElementById('showList').innerHTML = '';
		document.getElementById('showList').style.display = 'none';
		document.getElementById('showKey').innerHTML = xmlHttp.responseText;
	}
	
}
function delkey(key_id){
	requestString = null;
	selectedKey = '';
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/pageAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showkeyword;
		requestString = 'action=delkey&key_id=' + key_id ;
		xmlHttp.send(requestString);
		
	}
	
	
}

function showimagesf5(page_id){
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/pageAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=showimagesf5&page_id=' + page_id;
		xmlHttp.send(requestString);
		
	}
	
	
}
function showimages(){
	
	if(xmlHttp.readyState == 4){
		document.getElementById('showimages').innerHTML = xmlHttp.responseText;
	}
	
}
function delimg(page_id){
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/pageAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=delamage&page_id=' + page_id;
		xmlHttp.send(requestString);
		
	}

}
function showdirf5(path){
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post', SERVER_HTTP_HOST() + '/gadmin/file/add/0/fileAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showdir;
		requestString = 'action=showdirf5&path=' + path;
		xmlHttp.send(requestString);
		
	}
	
	
}

function showdir(){
	
	if(xmlHttp.readyState == 4){
		document.getElementById('showdir').innerHTML = xmlHttp.responseText;
	}
	
}

function creat_folder(name,path)
{
	createXMLHTTPObject();
	if(xmlHttp != null){
        
		xmlHttp.open('post', SERVER_HTTP_HOST() + '/gadmin/file/add/0/fileAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showdir;
		requestString = 'action=creat_folder&name=' + name + '&path=' + path;
		xmlHttp.send(requestString);
		
	}   
}

function showimagesf5_index(){
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',SERVER_HTTP_HOST() + '/gadmin/page_index/index/0/page_indexAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=showimagesf5_index' ;
		xmlHttp.send(requestString);
		
	}	
}
function delimg_index(page_id){
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',SERVER_HTTP_HOST() + '/gadmin/page_index/index/0/page_indexAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=delimg_index&page_id=' + page_id;
		xmlHttp.send(requestString);
		
	}
}
function showimagesf5_box(id){
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',SERVER_HTTP_HOST() + '/gadmin/box/edit/'+id+'/boxAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=showimagesf5_box&id='+id ;
		xmlHttp.send(requestString);
		
	}	
}
function delimg_box(box_id){
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/boxAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=delimg_box&box_id=' + box_id;
		xmlHttp.send(requestString);
		
	}
}

function showkey_newsf5(page_id)
{
	requestString = null;
	selectedKey = '';
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/newsAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showkeyword;
		requestString = 'action=showkeyf5&page_id=' + page_id;
		xmlHttp.send(requestString);
		
	}	
}

function news_keywordAction(key,mode)
{
	
	requestString = null;
	selectedKey = '';
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/newsAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		if(mode == 'SUGGESTION'){
			xmlHttp.onreadystatechange = showResults;
			requestString = 'action=keySuggestion&keyName=' + key;
		}
		else if(mode == 'INSERT'){

			xmlHttp.onreadystatechange = keyInsertResult;
			requestString = 'action=keyInsertion&keyName=' + key + '&news_id=' + document.getElementById('news_id').value + '&selected=' + selectedKey;
		}
		xmlHttp.send(requestString);
		
	}
	
}
function news_delkey(key_id)
{
	requestString = null;
	selectedKey = '';
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/newsAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showkeyword;
		requestString = 'action=delkey&key_id=' + key_id ;
		xmlHttp.send(requestString);
		
	}		
}
function showimagesf5_news(id){
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',SERVER_HTTP_HOST() + '/gadmin/news/edit/'+id+'/newsAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=showimagesf5_news&id='+id ;
		xmlHttp.send(requestString);
		
	}	
}

function delimg_news(id)
{
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/newsAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=delimg&id=' + id;
		xmlHttp.send(requestString);
		
	}
}

function showimagesf5_workbook(id){
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',SERVER_HTTP_HOST() + '/gadmin/workbook/edit/'+id+'/workbookAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=showimagesf5_workbook&id='+id ;
		xmlHttp.send(requestString);
		
	}	
}

function delimg_workbook(id)
{
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/workbookAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=delimg&id=' + id;
		xmlHttp.send(requestString);
		
	}
}

//task_student
function showimagesf5_task_student(id){
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',SERVER_HTTP_HOST() + '/gadmin/task_student/edit/'+id+'/task_studentAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=showimagesf5_task_student&id='+id ;
		xmlHttp.send(requestString);
		
	}	
}

function delimg_task_student(id)
{
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/task_studentAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=delimg&id=' + id;
		xmlHttp.send(requestString);
		
	}
}



//gallery
function gallery_keywordAction(key,mode)
{
	
	requestString = null;
	selectedKey = '';
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/galleryAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		if(mode == 'SUGGESTION'){
			xmlHttp.onreadystatechange = showResults;
			requestString = 'action=keySuggestion&keyName=' + key;
		}
		else if(mode == 'INSERT'){

			xmlHttp.onreadystatechange = keyInsertResult;
			requestString = 'action=keyInsertion&keyName=' + key + '&gallery_id=' + document.getElementById('gallery_id').value + '&selected=' + selectedKey;
		}
		xmlHttp.send(requestString);
		
	}
	
}
function gallery_delkey(key_id)
{
	requestString = null;
	selectedKey = '';
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/galleryAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showkeyword;
		requestString = 'action=delkey&key_id=' + key_id ;
		xmlHttp.send(requestString);
		
	}		
}
function showkey_galleryf5(page_id)
{
	requestString = null;
	selectedKey = '';
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/galleryAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showkeyword;
		requestString = 'action=showkeyf5&gallery_id=' + page_id;
		xmlHttp.send(requestString);
		
	}	
}

function showimagesf5_gallery(id){
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',SERVER_HTTP_HOST() + '/gadmin/gallery/edit/'+id+'/galleryAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=showimagesf5_gallery&id='+id ;
		xmlHttp.send(requestString);
		
	}	
}

function delimg_gallery(id)
{
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/galleryAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=delimg&id=' + id;
		xmlHttp.send(requestString);
		
	}
}

//adv gallery
function showimagesf5_advgallery(id){
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',SERVER_HTTP_HOST() + '/gadmin/gallery/picture/'+id+'/galleryAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=showimagesf5_advgallery&id='+id ;
		xmlHttp.send(requestString);
		
	}	
}


//link
function showimagesf5_link(id){
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',SERVER_HTTP_HOST() + '/gadmin/link/edit/'+id+'/linkAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=showimagesf5_link&id='+id ;
		xmlHttp.send(requestString);
		
	}	
}

function delimg_link(id)
{
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/linkAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=delimg&id=' + id;
		xmlHttp.send(requestString);
		
	}
}


//sound
function sound_keywordAction(key,mode)
{
	
	requestString = null;
	selectedKey = '';
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/soundAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		if(mode == 'SUGGESTION'){
			xmlHttp.onreadystatechange = showResults;
			requestString = 'action=keySuggestion&keyName=' + key;
		}
		else if(mode == 'INSERT'){

			xmlHttp.onreadystatechange = keyInsertResult;
			requestString = 'action=keyInsertion&keyName=' + key + '&sound_id=' + document.getElementById('sound_id').value + '&selected=' + selectedKey;
		}
		xmlHttp.send(requestString);
		
	}
	
}
function sound_delkey(key_id)
{
	requestString = null;
	selectedKey = '';
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/soundAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showkeyword;
		requestString = 'action=delkey&key_id=' + key_id ;
		xmlHttp.send(requestString);
		
	}		
}
function showkey_soundf5(page_id)
{
	requestString = null;
	selectedKey = '';
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/soundAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showkeyword;
		requestString = 'action=showkeyf5&sound_id=' + page_id;
		xmlHttp.send(requestString);
		
	}	
}

function showimagesf5_sound(id){
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',SERVER_HTTP_HOST() + '/gadmin/sound/edit/'+id+'/soundAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=showimagesf5_sound&id='+id ;
		xmlHttp.send(requestString);
		
	}	
}

function delimg_sound(id)
{
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/soundAjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=delimg&id=' + id;
		xmlHttp.send(requestString);
		
	}
}

//bazar_1
function showimagesf5_bazar_1(id){
	
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',SERVER_HTTP_HOST() + '/gadmin/bazar_1/edit/'+id+'/bazar_1AjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=showimagesf5_bazar_1&id='+id ;
		xmlHttp.send(requestString);
		
	}	
}
function delimg_bazar_1(b_id){
	createXMLHTTPObject();
	if(xmlHttp != null){

		xmlHttp.open('post',document.URL + '/bazar_1AjaxController',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = showimages;
		requestString = 'action=delimg_bazar_1&b_id=' + b_id;
		xmlHttp.send(requestString);
		
	}
}


//*******************************************END OF AJAX FUNCTIONS*******************************************


//******************************************NONE-AJAX FUNCTIONS***************************************
function SERVER_HTTP_HOST(){  
    var url = window.location.href;  
    url = url.replace("http://", "");   
      
    var urlExplode = url.split("/");  
    var serverName = urlExplode[0];  
      
    serverName = 'http://'+serverName;  
    return serverName;  
} 
function selectKeyFromList(id,keyName){
	document.getElementById('keywords').value = keyName;
	document.getElementById('showList').style.display = 'none';
	document.getElementById('showList').innerHTML = keyName;
}

function showHelp(obj,mode){
	
	document.getElementById('help').style.top =  tempY + 'px';
	document.getElementById('help').style.left = tempX + 'px';
	if(mode == 'view'){
		document.getElementById('msg').innerHTML = 'این آیکون برای مشاهده اطلاعات فرد می باشد';
	}
	else if(mode == 'pass'){
		document.getElementById('msg').innerHTML = 'این آیکون برای تغییر رمز عبور می باشد';		
	}
	else if(mode == 'edit'){
		document.getElementById('msg').innerHTML = 'این آیکون برای ویرایش اطلاعات می باشد';		
	}
	document.getElementById('help').style.display = 'block';
}

function hideHelp(obj,mode){
	document.getElementById('help').style.display = 'none';
}


function showLinkBg(id,prefix){
	
	document.getElementById(prefix+'left'+id).className = prefix + 'linkbg_left_side';
	document.getElementById(prefix+'mid'+id).className = prefix + 'linkbg_middle';
	document.getElementById(prefix+'right'+id).className = prefix + 'linkbg_right_side';
	
}

function hideLinkBg(id,prefix){
	
	document.getElementById(prefix+'left'+id).className = prefix + 'linkbg_sides';
	document.getElementById(prefix+'mid'+id).className = prefix + 'linkbg_middle_clear';
	document.getElementById(prefix+'right'+id).className = prefix + 'linkbg_sides';
	
}

function dataValidation(mode){
	
	var flag = true;	
	var formMode = null;
	var errorMsg = null;
	var emailMsg = null;
	var passwordMsg = null;
	
	if(mode == 'new_user' || mode == 'edit_user'){

		document.getElementById('NameMsg').innerHTML = '';
		document.getElementById('EmailMsg').innerHTML = '';
		document.getElementById('StatusMsg').innerHTML = '';
		document.getElementById('LevelMsg').innerHTML = '';
		if(document.getElementById('UsernameMsg') != null){
			document.getElementById('UsernameMsg').innerHTML = '';
			document.getElementById('PasswordMsg').innerHTML = '';
			document.getElementById('ConfirmPasswordMsg').innerHTML = '';
		}
		
		if(document.getElementById('Name').value == '' ){
				document.getElementById('NameMsg').innerHTML = 'فیلد مربوطه خالی می باشد';
				flag = false;
		}
		if(document.getElementById('Email').value == '' ){
				document.getElementById('EmailMsg').innerHTML = 'فیلد مربوطه خالی می باشد.';
				flag = false;			
		}
		else if(!emailValidation(document.getElementById('Email').value)){
			document.getElementById('EmailMsg').innerHTML = 'آدرس ایمیل مجاز نمی باشد.';	
			flag = false;
		}
		
		if(document.getElementById('Status').value == ''){
				document.getElementById('StatusMsg').innerHTML = 'فیلد مربوطه خالی می باشد';
				flag = false;			
		}
		if(document.getElementById('Level').value == '' && mode != 'edit_user'){
				document.getElementById('LevelMsg').innerHTML = 'فیلد مربوطه خالی می باشد';
				flag = false;			
		}
		
		if(document.getElementById('Username') != null){
			if(document.getElementById('Username').value == '' ){
					document.getElementById('UsernameMsg').innerHTML = 'فیلد مربوطه خالی می باشد';
					flag = false;			
			}
		}
		if(document.getElementById('Password') != null){
			if(document.getElementById('Password').value == '' ){
					document.getElementById('PasswordMsg').innerHTML = 'فیلد مربوطه خالی می باشد';
					flag = false;			
			}
			else if(document.getElementById('ConfirmPassword').value != ''){
				if(document.getElementById('Password').value != document.getElementById('ConfirmPassword').value){
					document.getElementById('PasswordMsg').innerHTML = 'رمز عبور و تایید رمز عبور با هم یکسان نمی باشند.';
					flag = false;
				}
			}			
			if(document.getElementById('ConfirmPassword').value == ''){
				document.getElementById('ConfirmPasswordMsg').innerHTML = 'فیلد مربوطه خالی می باشد';
				flag = false;
			}
		}
		

	}
	else if(mode == 'changePass'){
		
			document.getElementById('PasswordMsg').innerHTML = '';
			document.getElementById('ConfirmPasswordMsg').innerHTML = '';
			
		if(document.getElementById('Password').value == '' ){
				document.getElementById('PasswordMsg').innerHTML = 'فیلد مربوطه خالی می باشد';
				flag = false;			
		}
		else if(document.getElementById('ConfirmPassword').value != ''){
			if(document.getElementById('Password').value != document.getElementById('ConfirmPassword').value){
				document.getElementById('PasswordMsg').innerHTML = 'رمز عبور و تایید رمز عبور با هم یکسان نمی باشند.';
				flag = false;
			}
		}			
		if(document.getElementById('ConfirmPassword').value == ''){
			document.getElementById('ConfirmPasswordMsg').innerHTML = 'فیلد مربوطه خالی می باشد';
			flag = false;
		}
	}	
	if(mode == 'createPage'){
		
		document.getElementById('parentMsg').innerHTML = '';
		document.getElementById('langMsg').innerHTML = '';
		document.getElementById('commentMsg').innerHTML = '';
		document.getElementById('titleMsg').innerHTML = '';
		document.getElementById('textMsg').innerHTML = '';
		document.getElementById('pageSummaryMsg').innerHTML ='';
		
		if(document.getElementById('parent').value == ''){
			document.getElementById('parentMsg').innerHTML ='انتخاب کنید';
			flag = false;
		}
		if(!document.getElementsByName('lang').item(0).checked && !document.getElementsByName('lang').item(1).checked ){
			document.getElementById('langMsg').innerHTML ='انتخاب کنید';
			flag = false;
		}
		if(!document.getElementsByName('commentStatus').item(0).checked && !document.getElementsByName('commentStatus').item(1).checked){
			document.getElementById('commentMsg').innerHTML ='انتخاب کنید';
			flag = false;
		}	
		if(document.getElementById('pageTitle').value == ''){
			document.getElementById('titleMsg').innerHTML ='فیلد مربوطه خالی می باشد';
			flag = false;
		}
		if(document.getElementById('pageSummary').value == ''){
			document.getElementById('pageSummaryMsg').innerHTML ='فیلد مربوطه خالی می باشد';
			flag = false;
		}		
	/*	if(document.getElementById('mainText').value == ''){
			document.getElementById('textMsg').innerHTML ='فیلد مربوطه خالی می باشد';
			alert(document.getElementsByName('mainText').item(0).value);
			flag = false;
		}	*/	
	}
	return flag;
}

function emailValidation(input){
	
	var msg = null;
	
	var pattern = /^[-a-z0-9]+((\_[-a-z0-9~!$%^&*=+}{\?]+)*|(\.[-a-z0-9~!$%^&*=+}{\?]+)*)+@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	
	if(pattern.test(input)){
		return true;
	}
	else{
		return false;
	}	
}

function doRegExpCheck(inputText){
	
	var pattern = /<p>|<br \/>/ig;
	var pattern2 = /<[a-zA-Z0-9\/_\s.:="]+ \/>|<\/[a-zA-Z]+>|<[a-zA-Z0-9_\-="\s\/:]+>/ig;
	result = inputText.replace(pattern,"\n");
	result = result.replace(pattern2,"");
	return result;
}

function closebox(divid){
    document.getElementById (divid).style.display="none";
}

//*********************************************END OF NONE AJAX FUNCTIONS***************************************

