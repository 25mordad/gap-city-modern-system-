<div class="wrapper" >
    <div class="right _255 ">
        {include file="tpl/sarfejo_dailyfee/menu.tpl"}
    </div>
    <div class="right _765 ">
        <!-- _LBOX_ -->
        <div class="l_box" >
            <div class="top">
                <div class="title right">
                    ثبت قیمت روزانه - تاریخ ثبت
                    {jdate("y/m/d",strtotime( "now" ))}
                </div>
                <img src="/core/module/sarfejo_dailyfee/backend/images/stuff.png" />
                <div class="clear"></div>
            </div>
            <div class="mid">
                <div class="txt">
                    <form method="post" action="sarfejo_dailyfee/newfee?s=true" class="uniForm">
                        <fieldset>
                        {foreach $stuffs as $stuff}
                                    <div class="ctrlHolder">
                                        <label for="{$stuff->id}">{$stuff->name} </label>
                                        <input name="fee_{$stuff->id}" id="{$stuff->id}" type="text" class="textInput latin required "  />
                                    </div>
                        {/foreach}
                            </fieldset>
                        <div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">ثبت</button>
                        </div>
                    </form>

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
