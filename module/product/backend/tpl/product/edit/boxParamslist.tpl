<div class="modal fade" id="paramsList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    لیست پارامترهای محصول
                </h4>
            </div>
            <div class="modal-body">

                    {foreach $params as $row}
                        <label class="col-md-4">
                            {$row->param_name} ({$row->param_tag})
                            <input type="text"  value="{$param_vals[$row->id]["value"]}" name="value_{$param_vals[$row->id]["rel_id"]}"  class="form-control">
                        </label>
                    {/foreach}
                    <div class="clearfix" ></div>
                    <button class="btn btn-success " name="update_params">
به روز رسانی پارامترها
                    </button>
                    <div class="clearfix" ></div>

            </div>
        </div>
    </div>
</div>