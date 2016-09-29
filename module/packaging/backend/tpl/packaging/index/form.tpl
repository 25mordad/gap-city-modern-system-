{if isset($smarty.get.edit)}
    {$form_action = "/gadmin/packaging/?edit={$bag->id}"}
    {$title = "ویرایش"}
{else}
    {$form_action = "/gadmin/packaging/new"}
    {$title = "ایجاد"}
{/if}
<div class="row">
<br>
        <form method="post" action="{$form_action}"  >
            
            <div class="col-xs-3">

                <select name="pg_title" class="col-md-12" id="pg_title"
                {if isset($smarty.get.edit)}
                        style= "border: 1px solid #ffa902;background: #FFFF66;font-size: 14px;"
                        {/if}
                >
                	<option value="0"> انتخاب نماینده فروش </option>
                	{foreach $users as $row}
                	<option value="{$row->id}" {if $bag->pg_title eq $row->id }selected="selected" {/if}>{$row->params} - {$row->username} </option>
                	{/foreach}
                </select>


            </div>
            <div class="col-xs-2">

                <input type="text" placeholder="تاریخ ارسال بسته " data-toggle="tooltip" data-placement="top" title="تاریخ ارسال بسته" name="date_modified" id="date_modified"
                       class="form-control"
                       style= "font-family: verdana
                        {if isset($smarty.get.edit)}
                        ;border: 1px solid #ffa902;background: #FFFF66;font-size: 14px;
                        {/if}
                        "
                       {if isset($smarty.get.edit)}value="{date("Y-m-d",strtotime($bag->date_modified))}"
                       {else}
                       value="{date("Y-m-d",strtotime("now"))}"
                       {/if}>


            </div>
            
            
            
            <div class="col-xs-3 input-group ">


                 <input type="text" placeholder=" مسوول ارسال "  title=" مسوول ارسال" data-toggle="tooltip" data-placement="top" name="pg_content" id="pg_content"
                       class="form-control"
                        {if isset($smarty.get.edit)}
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        {/if}
                       {if isset($smarty.get.edit)}value="{$bag->pg_content}"{/if}>
                
                {if isset($smarty.get.edit)}
                    <span class="input-group-addon btn btn-danger"
                          data-toggle="tooltip" data-placement="right" title="انصراف"
                          onclick="window.location = '/gadmin/packaging'"><i class="fa  fa-close " style="color: white"></i></span>
                {/if}
                <span class="input-group-btn " >
                        <button type="submit" class="btn btn-primary btn-flat">
                            {$title} بسته
                        </button>
                     </span>
            </div>

        </form>

</div>