
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">پاسخ‌ها</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
				        <script src="{$loct}/js/jquery-ui-1.7.2.custom.min.js"></script>
				        <link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
						<script src="{$loct}/js/jquery.easy-confirm-dialog.js"></script>	
                    	{literal}
                    	<style>
                    	.answer
                    	{
                    		background-color:white;
                    		width: 500px;
							height: 25px;
							padding: 5px;
							font-family: tahoma;
							border-radius: 5px;
							border: 1px solid #CCCCCC;
							direction: rtl;
							text-align: right;
							margin: 5px;
						}
                    	</style>
                    	<script>
                    	function edit_answer(id)
                    	{
                    		$.post(document.URL+ "/AjaxController?controller=edit_answer", { id: id, answer: document.getElementById(id).value },function(data,status){
     						     alert(data);
  						    });
                    	}
                    	function del_answer(id)
                    	{
                    		$.post(document.URL+ "/AjaxController?controller=del_answer", { id: id },function(data,status){
                    			get_answers()
  						    });
                    	}
                    	function add_answer(id)
                    	{
                    		$.post(document.URL+ "/AjaxController?controller=add_answer", { id: id },function(data,status){
                    			get_answers()
  						    });
                    	}
                    	function get_answers()
                    	{
                    		$.post(document.URL+ "/AjaxController?controller=get_answers", { id: {/literal}{$poll->id}{literal} },function(data,status){
   						  	 $("#answers").html(data);
   						     $(".confirm_del").easyconfirm({locale: $.easyconfirm.locales.faIR});
						    });
                    	}
                    	get_answers();
                    	</script>
                    	{/literal}
                    	<div id="answers">
                    	</div>
						<h3><a href="javascript:add_answer({$poll->id})" >اضافه کردن پاسخ جدید</a></h3>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	