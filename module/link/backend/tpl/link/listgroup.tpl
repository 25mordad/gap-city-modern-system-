<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/link/formgroup.tpl"}
		{include file="tpl/link/menu.tpl"}             
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست گروه‌پیوندها</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                    <style>
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    .plus { background: url({$loct}/images/icon/plus.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 450px;">عنوان گروه‌پیوند</span>
                                <span style="width: 150px;">اضافه کردن پیوند جدید</span>
                                <span style="width: 50px;">ویرایش</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $groups as $group}
                            <div class="row_1">
                                <span style="width: 450px;" class="BYekan">{$group->pg_title|truncate:44:"..":true}</span>
                                <span style="width: 150px;"><a href="link/new/?g={$group->id}"><div class="icon plus" ></div></a></span>
                                <span style="width: 50px;" class="last"><a href="link/listgroup/?edit={$group->id}"><div class="icon edit" ></div></a></span>
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