{if isset($group_contact)}
    {$form_action = "/gadmin/contact/editgroup/{$group_contact->id}"}
    {$title = "ویرایش"}
{else}
    {$form_action = "/gadmin/contact/newgroup"}
    {$title = "ایجاد"}
{/if}
<div class="box-tools pull-left">
    <div >

        <form method="post" action="{$form_action}"  >
            <div class="input-group input-group-sm">
                    <span class="input-group-btn" >
                        <button type="submit" class="btn btn-primary btn-flat">
                        {$title} گروه
                        </button>
                     </span>
                <input type="text" placeholder="نام گروه"  name="name" id="name"
                       class="form-control"
                        {if isset($group_contact)}
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        {/if}
                       {if isset($group_contact)}value="{$group_contact->name}"{/if}>
                {if isset($group_contact)}<span class="input-group-addon btn btn-danger"
                                                        data-toggle="tooltip" data-placement="right" title="انصراف"
                                                        onclick="window.location = '/gadmin/contact/grouping/'"><i class="fa  fa-close " style="color: white"></i></span>{/if}
            </div>
        </form>
    </div>
</div>