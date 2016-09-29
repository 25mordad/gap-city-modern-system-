    <div class="row">
        <form method="post" action="/gadmin/contact/edit/{$contact->id}" id="newContactForm" >
        <div class="col-md-12 col-xs-12">

            <div class="form-group  col-md-6">
                <label>
    نام و نام خانوادگی
                </label>
                <input  type="text" name="name"  class="form-control" value="{$contact->name}">
            </div>

            <div class="form-group  col-md-6">
                <label>
         ایمیل
                </label>
                <input  type="email" name="email"  class="form-control" value="{$contact->email}">
            </div>

            <div class="form-group  col-md-6">
                <label>
    شماره تماس
                </label>
                <input required  type="text" name="cell"  class="form-control" value="{$contact->cell}">
            </div>




            <div class="form-group col-md-6">
                <label>
                    گروه
                </label>
                <select class="form-control"  name="id_group" id="id_group" >
                    <option value="0" selected="selected">--بدون گروه--</option>
                    {foreach $group_contacts as $key => $val}
                        <option value="{$key}" {if isset($contact) && $contact->id_group eq $key }selected="selected"{/if} >{$val}</option>
                    {/foreach}
                </select>
            </div>



            <button class="btn btn-success btn-block btn-flat" type="submit">
    ویرایش
            </button>
        </div>
            <script>
                $(document).ready(function() {
                    $('#newContactForm').bootstrapValidator();
                });
            </script>
        </form>
    </div>