<div class="wrapper" >
	<div class="right _255 ">
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/search.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
		{include file="tpl/sarfejo_user/filter.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست اعضا</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                    <style>
	                    .pass { background: url({$loct}/images/icon/pass.png)  }
	                    .user { background: url({$loct}/images/icon/user.png)  }
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 150px;">نام</span>
                                <span style="width: 150px;">ایمیل</span>
                                <span style="width: 70px;" >اعتبار</span>
                                <span style="width: 80px;" >سطح دسترسی</span>
                                <span style="width: 50px;">وضعیت</span>
                                <span style="width: 150px;">مشاهده مشخصات</span>
                                <div class="clear"></div>
                            </div>
                            
	                	{$arr_level = [
	                   'ozv'=>"عضو"  ,
	                   'senf' => "صنف"  ,
	                   'sanatgar' => "صنعتگر" 
	                   ]} 
                            {foreach $users as $user}
                            <div class="row_1">
                            	<span style="width: 150px;font-size:10px;"  title="{$user->name}" >{$user->name|truncate:26:"..":true}</span>
                                <span style="width: 150px;font-size:10px;"  title="{$user->email}" >{$user->email|truncate:26:"..":true}</span>
                                <span style="width: 70px;" >{$user->credit}</span>
                                <span style="width: 80px;" >{$arr_level[$user->level]}</span> 
                                <span style="width: 50px;">{if $user->status eq "active"}فعال{else}غیرفعال{/if}</span>
                                <span style="width: 150px;" class="last"><a href="sarfejo_user/show/{$user->id}"><div class="icon user" ></div></a></span>
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                        </div>
                        <div class="clear"></div>
		                <!-- paging -->
		                <div class="paging">
		                {section name=num start=1 loop=$paging+1 }
		                    {if $smarty.section.num.index neq $smarty.get.paging}
		                    <a href="{pagingurl url= $smarty.server.REQUEST_URI paging= {$smarty.section.num.index} }"><span>{$smarty.section.num.index}</span></a>
		                    {else}
		                    <span class="actpagin">{$smarty.section.num.index}</span>
		                    {/if}
		                {/section}
		                </div>
		                <!-- paging -->
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