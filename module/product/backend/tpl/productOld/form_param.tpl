{if isset($smarty.get.edit) }
	{$form_action = "product/add_param/{$g_product->id}?edit={$smarty.get.edit}"}
    {$submit_txt = "ویرایش"}
{else}
    {$form_action = "product/add_param/{$g_product->id}"}
    {$submit_txt = "ثبت"}
{/if}
<form action="{$form_action}" method="post" class="uniForm">
<fieldset>
<div class="ctrlHolder">
    <label for="param_name"><em>*</em>نام پارامتر به فارسی</label>
    <input name="param_name" id="param_name" type="text" class="textInput required " {if isset($smarty.get.edit)}value="{$get_param->param_name}"{/if} />
    <p class="formHint"></p>
</div>
<div class="ctrlHolder">
    <label for="param_tag"><em>*</em>نام پارامتر به انگلیسی</label>
    <input name="param_tag" id="param_tag" type="text" class="textInput latin required " {if isset($smarty.get.edit)}value="{$get_param->param_tag}"{/if} />
    <p class="formHint"></p>
</div>
</fieldset>
<div class="buttonHolder">
    <button type="submit"  name="submit" class="primaryAction">{$submit_txt}</button>
</div>
</form>