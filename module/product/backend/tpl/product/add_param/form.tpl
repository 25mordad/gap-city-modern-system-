{if isset($smarty.get.edit) }
    {$form_action = "/gadmin/product/add_param/{$g_product->id}?edit={$smarty.get.edit}"}
    {$title = "ویرایش"}
{else}
    {$form_action = "/gadmin/product/add_param/{$g_product->id}"}
    {$title = " ایجاد "}
{/if}
<div class="row">


        <form method="post" action="{$form_action}"  >

            <div class="col-xs-3">

                <input type="text" placeholder=" نام پارامتر به فارسی "  name="param_name" id="param_name"
                       class="form-control"
                        {if isset($smarty.get.edit)}
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        {/if}
                        {if isset($smarty.get.edit)}value="{$get_param->param_name}"{/if} >


            </div>
            <div class="col-xs-4 input-group ">


                <input type="text" class="form-control "
                       placeholder=" نام پارامتر به لاتین "
                       name="param_tag"
                       id="param_tag"
                        {if isset($smarty.get.edit)}
                            style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        {/if}
                        {if isset($smarty.get.edit)}value="{$get_param->param_tag}"{/if}
                        >
                {if isset($smarty.get.edit)}
                    <span class="input-group-addon btn btn-danger"
                          data-toggle="tooltip" data-placement="right" title="انصراف"
                          onclick="window.location = '/gadmin/product/add_param/{$g_product->id}'"><i class="fa  fa-close " style="color: white"></i></span>
                {/if}
                <span class="input-group-btn " >
                        <button type="submit" class="btn btn-primary btn-flat">
                            {$title}
                        </button>
                     </span>
            </div>

        </form>

</div>