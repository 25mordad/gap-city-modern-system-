<script type="text/javascript" src="{$loct}/js/jquery.tokeninput.js"></script>
<link rel="stylesheet" href="{$loct}/css/token-input.css" type="text/css" />

              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">کلمات کلیدی</div>
                    <img src="{$loct}/images/icon/tag.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
						<input type="text" id="demo-input-facebook-theme" name="" />
						<div class="clear"></div>
                        {literal}
                        <script type="text/javascript">
						    $(document).ready(function() {
						        $("input[type=button]").click(function () {
						            alert("Would submit: " + $(this).siblings("input[type=text]").val());
						        });

						        var result = null;
						        var scriptUrl = document.URL + "/AjaxController?controller=get_keywords&id=" + {/literal}{${$part}->id}{literal};
						        $.ajax({
						           url: scriptUrl,
						           type: 'get',
						           dataType: 'html',
						           async: false,
						           success: function(data) {
						               result = eval(data);
						           } 
						        });
						        $("#demo-input-facebook-theme").tokenInput(document.URL+ "/AjaxController?controller=get_suggestions", {
						        	prePopulate: result,
					                onAdd: function (item) {
					                	$.post(document.URL+ "/AjaxController?controller=add_keyword", { key_id: item.id, page_id: {/literal}"{${$part}->id}"{literal} }, function(data){
						                	item.rel_id = data;							      
									    }); 
					                },
					                onDelete: function (item) {
									    $.post(document.URL+ "/AjaxController?controller=del_keyword", { id: item.rel_id }); 
					                },
					                onNew: function (item) {
					                	$.post(document.URL+ "/AjaxController?controller=new_keyword", { kw_title: item, page_id: {/literal}"{${$part}->id}"{literal} }, function(data){
					                		$("#demo-input-facebook-theme").tokenInput("add", eval(data));							      
									    }); 
					                }                
					            });
						    });
						</script>
						{/literal}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->