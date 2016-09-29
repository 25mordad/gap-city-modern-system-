<div class="wrapper" >
	<div class="right _255 ">
        {include file="tpl/khodro/formbrand.tpl"}
		{include file="tpl/khodro/menu.tpl"}         
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">برند</div>
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
                                <span style="width: 320px;">نــام بــرند</span>
                                 <span style="width: 100px;">مدل های مربوطه</span>
                                <span style="width: 100px;">تیپ های مربوطه</span>
                                <span style="width: 50px;">ویرایش</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $brands as $row}
                            <div class="row_1">
                            	<span style="width: 30px;">{$row->id}</span>
                                <span style="width: 320px;"><img src="/uploads/khodro/brand/brand_{$row->id}.png" width="30" style="float: right; margin-top: -2px;" />{$row->name}</span>
                                 <span style="width: 100px;">
                                <a href="khodro/?paging=1&search=NULL&brand={$row->id}">لیست مدل ها</a>
                                </span>
                                <span style="width: 100px;">
                                <a href="khodro/tips?paging=1&search=NULL&brand={$row->id}">لیست تیپ ها</a>
                                </span>
                                <span style="width: 50px;"  class="last"><a href="khodro/brand/?edit={$row->id}"><div class="icon edit" ></div></a></span>
                                
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