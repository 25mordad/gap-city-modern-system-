<div class="wrapper" >
	<div class="right _255 ">
        {include file="tpl/khodro/search.tpl"}
        {include file="tpl/khodro/filter.tpl"}
		{include file="tpl/khodro/menu.tpl"}                
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست مدل ها</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					    <script src="{$loct}/js/jquery-ui-1.7.2.custom.min.js"></script>
					    <link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
						<script src="{$loct}/js/jquery.easy-confirm-dialog.js"></script>
			            {literal}
			            <script>
				            $(function() {
				            $(".confirm_dialog").easyconfirm({locale: $.easyconfirm.locales.faIR});
				            });
			            </script>
			            {/literal}
	                    <style>
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    .info { background: url({$loct}/images/icon/info.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                            	<span style="width: 30px;">ID</span>
                                <span style="width: 300px;">نام مدل</span>
                                <span style="width: 150px;">نام برند</span>
                                <span style="width: 100px;">تیپ های مربوطه</span>
                                <span style="width: 50px;">ویرایش</span>
                                
                                <div class="clear"></div>
                            </div>
                            {foreach $models as $row}
                            
                            <div class="row_1">
                                <span style="width: 30px;">{$row->id}</span>
                            	 <span style="width: 300px;"><img src="/uploads/khodro/model/model_{$row->id}.png" width="30" style="float: right; margin-top: -2px;" />{$row->model_name}</span>
                                <span style="width: 150px;">{get_brand id_brand=$row->id_brand}{$getbrand->name}</span>
                                <span style="width: 100px;">
                                <a href="khodro/tips?paging=1&search=NULL&brand={$row->id_brand}&model={$row->id}">لیست تیپ ها</a>
                                </span>
                                <span style="width: 50px;" class="last"><a href="khodro/editmodel/{$row->id}"><div class="icon edit" ></div></a></span>
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                        </div>
		                <div class="clear"></div>   
                         <!-- paging -->
		                <div class="paging">
		                {section name=num start=1 loop=$paging+1 }
		                    {if $smarty.section.num.index neq $smarty.get.paging}
		                    <a href="khodro/?paging={$smarty.section.num.index}&search={$smarty.get.search}&brand={$smarty.get.brand}"><span>{$smarty.section.num.index}</span></a>
		                    {else}
		                    <span class="actpagin">{$smarty.section.num.index}</span>
		                    {/if}
		                {/section}
		                </div>
		                <!-- paging -->                  	
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->    	
	</div>
	<div class="clear"></div>    
</div>