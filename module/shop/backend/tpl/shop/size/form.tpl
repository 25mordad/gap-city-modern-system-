{if isset($group_product)}
    {$form_action = "/gadmin/shop/size/?edit={$group_product->id}"}
    {$title = "ویرایش"}
{else}
    {$form_action = "/gadmin/shop/newsize"}
    {$title = "ایجاد"}
{/if}
<div class="row">

<br>
        <form method="post" action="{$form_action}"  >
            
            <div class="col-xs-2">

                <input type="text" placeholder="نام لاتین"  name="pg_title" id="pg_title"
                       class="form-control"
                        {if isset($group_product)}
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        {/if}
                       {if isset($group_product)}value="{$group_product->pg_title}"{/if}
                       {if isset($smarty.get.new)}value="{$smarty.get.new}"{/if}
                       >


            </div>
            <div class="col-xs-2">

                <input type="text" placeholder="نام فارسی"  name="pg_content" id="pg_content"
                       class="form-control"
                        {if isset($group_product)}
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        {/if}
                       {if isset($group_product)}value="{$group_product->pg_content}"{/if}>


            </div>
            <div class="col-xs-2">

                <input type="text" placeholder=" کد گروه "  name="pg_excerpt" id="pg_excerpt"
                       class="form-control"
                        {if isset($group_product)}
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        {/if}
                       {if isset($group_product)}value="{$group_product->pg_excerpt}"{/if}>


            </div>
            
            <div class="col-xs-3 input-group ">


                <input type="text" class="form-control "
                       placeholder="ترتیب نمایش "
                       name="pg_order"
                        {if isset($group_product)}
                            style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        {/if}
                        {if isset($group_product)}value="{$group_product->pg_order}"{else}value="0"{/if}
                        >
                {if isset($group_product)}
                    <span class="input-group-addon btn btn-danger"
                          data-toggle="tooltip" data-placement="right" title="انصراف"
                          onclick="window.location = '/gadmin/shop/size/'"><i class="fa  fa-close " style="color: white"></i></span>
                {/if}
                <span class="input-group-btn " >
                        <button type="submit" class="btn btn-primary btn-flat">
                            {$title} سایز	
                        </button>
                     </span>
            </div>

        </form>

</div>