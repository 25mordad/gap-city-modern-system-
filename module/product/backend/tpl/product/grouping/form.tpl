{if isset($group_product)}
    {$form_action = "/gadmin/product/grouping/?edit={$group_product->id}"}
    {$title = "ویرایش"}
{else}
    {$form_action = "/gadmin/product/newgroup"}
    {$title = "ایجاد"}
{/if}
<div class="row">


        <form method="post" action="{$form_action}"  >
            <div class="col-xs-3" >
                <select class="form-control" name="parent_id" id="parent_id" >
                    <option value="0" >
                        بدون گروه والد
                    </option>
                    {foreach $groups as $group}
                        <option value="{$group->id}" {if isset($group_product) and $group->id eq $group_product->parent_id }selected="selected"{/if}>{$group->pg_title}</option>
                    {/foreach}
                </select>
            </div>
            <div class="col-xs-3">

                <input type="text" placeholder="نام گروه"  name="pg_title" id="pg_title"
                       class="form-control"
                        {if isset($group_product)}
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        {/if}
                       {if isset($group_product)}value="{$group_product->pg_title}"{/if}>


            </div>
            <div class="col-xs-4 input-group ">


                <input type="text" class="form-control "
                       placeholder="توضیحات گروه"
                       name="pg_content"
                        {if isset($group_product)}
                            style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        {/if}
                        {if isset($group_product)}value="{$group_product->pg_content}"{/if}
                        >
                {if isset($group_product)}
                    <span class="input-group-addon btn btn-danger"
                          data-toggle="tooltip" data-placement="right" title="انصراف"
                          onclick="window.location = '/gadmin/product/grouping/'"><i class="fa  fa-close " style="color: white"></i></span>
                {/if}
                <span class="input-group-btn " >
                        <button type="submit" class="btn btn-primary btn-flat">
                            {$title} گروه
                        </button>
                     </span>
            </div>

        </form>

</div>