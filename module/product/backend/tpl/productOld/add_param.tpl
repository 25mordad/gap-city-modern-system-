<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/product/formgroup.tpl"}
		{include file="tpl/product/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">افزودن پارامتر به گروه "{$g_product->pg_title}"</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					  <a href="product/grouping/">&laquo; بازگشت</a> <br />
                             <p>{$g_product->pg_content}</p>
                             {include file="tpl/product/form_param.tpl"}
                          
                      <div class="clear"></div>
                      لیست پارامترهای مربوط به گروه "{$g_product->pg_title}" : <br />  	
                      <style>
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    .pending { background: url({$loct}/images/icon/pending.png)  }
	                    .publish { background: url({$loct}/images/icon/publish.png)  }
	                    </style>
                        {$arr_status = [
	                   'pending'=>"در دست بررسی"  ,
	                   'publish' => "انتشاریافته" ,
	                   'open' => "فعال" ,
	                   'close' => "غیر فعال" 
	                   ]} 
                      <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 250px;">نام پارامتر</span>
                                <span style="width: 150px;">نام لاتین</span>
                                <span style="width: 90px;">وضعیت</span>
                                <span style="width: 90px;">ویرایش</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $param_lists as $param_list}
                            <div class="row_1">
                                <span style="width: 250px;" class="BYekan" >{$param_list->param_name}</span>
                                <span style="width: 150px;">{$param_list->param_tag}</span>
                                <span style="width: 90px;"><a href="product/add_param/{$g_product->id}?status={$param_list->status}&id={$param_list->id}"><div class="icon {$param_list->status}" ></div></a></span>
                                
                                <span style="width: 90px;"><a href="product/add_param/{$g_product->id}?edit={$param_list->id}"><div class="icon edit" ></div></a></span>
                                                                
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                        </div>
		                <div class="clear"></div> 
                      
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->
		
	</div>
	<div class="clear"></div>    
</div>
