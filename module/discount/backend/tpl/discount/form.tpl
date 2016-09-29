{if $action eq "new"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}
	
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">{$title} تخفیف</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					<form action="discount/{$action}{if isset($discount)}/{$discount->id}{/if}" method="post" class="uniForm">
					<fieldset>
                            
                            <div class="ctrlHolder">
                            <label for="title"><em>*</em>عنوان تخفیف</label>
                            <input name="title" id="title" type="text" class="textInput required " {if isset($discount)}value="{$discount->title}"{/if}/>
                            <p class="formHint"></p>
                            </div>
                           
	                        <div class="ctrlHolder">
	                        	<label for="id_group">گروه تخفیف</label>
	                              <select name="id_group" id="id_group" class="selectInput" >
	                                <option value="0" selected="selected">--بدون گروه--</option>
	                                {foreach $groups as $group}
	                                <option value="{$group->id}" {if isset($discount) && $discount->id_group eq $group->id }selected="selected"{else if isset($smarty.get.g) && $smarty.get.g eq $group->id }selected="selected"{/if} >{$group->name}</option>
	                                {/foreach}
	                              </select>
	                              <p class="formHint"></p>
	                        </div>	  
                            
                            <div class="ctrlHolder">
                            <label for="real-price">قیمت واقعی</label>
                            <input name="real-price" id="real-price" type="text" class="textInput latin" {if isset($discount)}value="{$discount->{"real-price"}}"{/if} />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="discount_percent">درصد تخفیف</label>
                            <input name="discount_percent" id="discount_percent" type="text" class="textInput latin" {if isset($discount)}value="{$discount->discount_percent}"{/if} />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="expire_date">تاریخ انقضا</label>
                            <input name="expire_date" id="expire_date" type="text" class="textInput latin" {if isset($discount)}value="{miladi_to_shamsi($discount->expire_date)} {($discount->expire_date)|date_format:'%H:%M:%S'}"{else}value="{miladi_to_shamsi(($smarty.now+7*24*60*60)|date_format:'%Y-%m-%d')} {($smarty.now)|date_format:'%H:%M:%S'}"{/if} />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="max_sell">حداکثر تعداد خرید</label>
                            <input name="max_sell" id="max_sell" type="text" class="textInput latin" {if isset($discount)}value="{$discount->max_sell}"{/if} />
                            <p class="formHint"></p>
                            </div>
                            
	                    	<div class="ctrlHolder">
	                              <p class="label">نوع تحویل</p>
	                              {$type_delivery_select = [['name'=>"تحویل در محل",'value'=>"mahal"],['name'=>"ارسال با پیک",'value'=>"peyk"]]} 
					                {radioTagGenerator info = $type_delivery_select radioName = "type_delivery" ul="true" default="{if isset($discount)}{$discount->type_delivery}{/if}"}
	                              <p class="formHint"></p>
	                    	</div>
                            
                            <div class="ctrlHolder">
                            <label for="plus_count">تعداد پلاس‌ها</label>
                            <input name="plus_count" id="plus_count" type="text" class="textInput latin" {if isset($discount)}value="{$discount->plus_count}"  readonly="readonly"{/if} />
                            <p class="formHint"></p>
                            </div>
                            
	                        <div class="ctrlHolder">
	                              <label for="id_user_seller">کاربر فروشنده</label>
	                              <select name="id_user_seller" id="id_user_seller" class="selectInput" >
	                              	<option value="">@@Choose@@</option>
	                                {foreach $users as $user}
	                                <option value="{$user->id}" {if isset($discount) && $discount->id_user_seller eq $user->id }selected="selected"{/if} >{$user->name} ({$user->username})</option>
	                                {/foreach}
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
                            
                            <div class="ctrlHolder">
                            <label for="shop_name">نام فروشگاه</label>
                            <input name="shop_name" id="shop_name" type="text" class="textInput" {if isset($discount)}value="{$discount->shop_name}"{/if} />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="shop_address">آدرس فروشگاه</label>
                              <textarea name="shop_address" id="shop_address" >{if isset($discount)}{$discount->shop_address}{/if}</textarea>
                              <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="shop_tell">تلفن فروشگاه</label>
                            <input name="shop_tell" id="shop_tell" type="text" class="textInput latin validatePhone" {if isset($discount)}value="{$discount->shop_tell}"{/if} />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="shop_cell">تلفن همراه فروشگاه</label>
                            <input name="shop_cell" id="shop_cell" type="text" class="textInput latin validatePhone" {if isset($discount)}value="{$discount->shop_cell}"{/if} />
                            <p class="formHint"></p>
                            </div>

                            <div class="ctrlHolder">
                              <label for="conditions">انتخاب از روی نقشه</label>

                              <!-- shirazplus Key AIzaSyBeNegMBGPA4QVMITGk7lZQbskQ7sUHRAw -->
                              <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeNegMBGPA4QVMITGk7lZQbskQ7sUHRAw"
            type="text/javascript"></script>

    <script>
    {if isset($discount)}
    var myCenter=new google.maps.LatLng({$discount->latitude},{$discount->longitude});
    {else}
    var myCenter=new google.maps.LatLng(29.63073390393767,52.521042823791504);
    {/if}

        var markers = [];
        function initialize()
        {
                                  var mapProp = {
                                  center:myCenter,
                                  zoom:12,
                                  mapTypeId:google.maps.MapTypeId.ROADMAP ,
                                  panControl:false,
                                  zoomControl:true,
                                  zoomControlOptions: {
                                  style:google.maps.ZoomControlStyle.SMALL
                                  },
                                  mapTypeControl:false,
                                  scaleControl:false,
                                  streetViewControl:false,
                                  overviewMapControl:false,
                                  rotateControl:false

                                  };

                                  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

                                  google.maps.event.addListener(map,'click',function(event) {
                                  deleteMarkers()
                                  addMarker(event.latLng);
                                  document.getElementById('latitude').value = event.latLng.lat()
                                  document.getElementById('longitude').value = event.latLng.lng()
                                  });

                                  infowindow.open(map,marker);
                                  marker.setMap(map);



                                  // Add a marker to the map and push to the array.
                                  function addMarker(location) {
                                  var marker = new google.maps.Marker({
                                  position: location,
                                  map: map
                                  });
                                  markers.push(marker);
                                  }
                                  // Sets the map on all markers in the array.
                                  function setAllMap(map) {
                                  for (var i = 0; i < markers.length; i++) {
                                  markers[i].setMap(map);
                                  }
                                  }
                                  // Removes the markers from the map, but keeps them in the array.
                                  function clearMarkers() {
                                  setAllMap(null);
                                  }
                                  // Deletes all markers in the array by removing references to them.
                                  function deleteMarkers() {
                                  clearMarkers();
                                  markers = [];
                                  }
                                  }




                                  google.maps.event.addDomListener(window, 'load', initialize);
                                  </script>


                                  <div id="googleMap" style="width:600px;height:180px;"></div>




                              <p class="formHint"></p>
                            </div>


                            <div class="ctrlHolder">
                            <label for="latitude">عرض جغرافیایی</label>
                            <input name="latitude" id="latitude" type="text" class="textInput latin" {if isset($discount)}value="{$discount->latitude}"{/if} />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="longitude">طول جغرافیایی</label>
                            <input name="longitude" id="longitude" type="text" class="textInput latin" {if isset($discount)}value="{$discount->longitude}"{/if} />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="url">سایت فروشگاه</label>
                            <input name="url" id="url" type="text" class="textInput latin" {if isset($discount)}value="{$discount->url}"{/if} />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="shop_specification">مشخصات فروشگاه</label>
                              <textarea name="shop_specification" id="shop_specification" >{if isset($discount)}{$discount->shop_specification}{/if}</textarea>
                              <p class="formHint"></p>
                            </div>
                            
	                    	<div class="ctrlHolder">
	                              <p class="label">امکان استفاده به صورت لحظه‌ای</p>
	                              {$ismoment_select = [['name'=>"دارد",'value'=>"true"],['name'=>"ندارد",'value'=>"false"]]} 
					                {radioTagGenerator info = $ismoment_select radioName = "ismoment" ul="true" default="{if isset($discount)}{$discount->ismoment}{/if}"}
	                              <p class="formHint"></p>
	                    	</div>
                            
                            <div class="ctrlHolder">
                              <label for="text">توضیحات</label>
                              <textarea name="text" id="text" >{if isset($discount)}{$discount->text}{/if}</textarea>
                              <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="info">اطلاعات فروش</label>
                              <script	type="text/javascript"	src="{$loct}/js/fckeditor/fckeditor.js"></script>
                              <textarea name="info" id="info" >{if isset($discount)}{$discount->info}{/if}</textarea>
                              <script type="text/javascript">
                    			var oFCKeditor = new FCKeditor( 'info' );
                    			oFCKeditor.BasePath = "{$loct}/js/fckeditor/";
                    			oFCKeditor.ReplaceTextarea( 'info',
                            	{
                                      //skin : 'silver' ,

                                  });
                                </script>
                              <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="conditions">شرایط</label>
                              <textarea name="conditions" id="conditions" >{if isset($discount)}{$discount->conditions}{/if}</textarea>
                              <p class="formHint"></p>
                            </div>
                            
	                    	<div class="ctrlHolder">
	                              <p class="label">وضعیت</p>
	                              {$status_select = [['name'=>"فعال",'value'=>"active"],['name'=>"غیرفعال",'value'=>"inactive"]]}
					                {radioTagGenerator info = $status_select radioName = "status" ul="true" default="{if isset($discount)}{$discount->status}{else}active{/if}"}
	                              <p class="formHint"></p>
	                    	</div>
			                   
                            </fieldset>
                            
                            <div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">{$title}</button>
                            </div>
                        
                        
                        <div class="clear"></div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
					</form>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->