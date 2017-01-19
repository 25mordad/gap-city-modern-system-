					<script >
                    function add_answer(id)
                	{
                    	$.post("{$smarty.server.REDIRECT_URL}{if $action eq "index"}{$action}{/if}/AjaxController?controller=test_ajax", { id: 4 },function(data,status){
  						  	 $("#answers").html(data);
						    });
                	}
                    </script>
                    <div id="answers">tes</div>
                    <a href="javascript:add_answer(3)" >اضافه کردن پاسخ جدید</a>