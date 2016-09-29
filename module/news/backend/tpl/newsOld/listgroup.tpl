<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/news/menu.tpl"}             
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست گروه‌های خبری</div>
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
                                <span style="width: 300px;">عنوان گروه خبری</span>
                                <span style="width: 150px;">گروه خبری مادر</span>
                                <span style="width: 150px;">اضافه کردن خبر جدید</span>
                                <span style="width: 50px;">ویرایش</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $groups as $group}
                            <div class="row_1">
                                <span style="width: 300px;" class="BYekan">{$group->pg_title|truncate:34:"..":true}</span>
                                <span style="width: 150px;font-size:10px;">{if $group->parent_id}<a href="news/editgroup/{$group->parent_id}">{showtitle id=$group->parent_id chagetoplus="false" }</a>{else}ندارد{/if}</span>
                                <span style="width: 150px;"><a href="news/new/?g={$group->id}"><div class="icon plus" ></div></a></span>
                                <span style="width: 50px;" class="last"><a href="news/editgroup/{$group->id}"><div class="icon edit" ></div></a></span>
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