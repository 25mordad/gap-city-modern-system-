<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            اطلاعات گروه خبری
        </h3>
    </div>
    <div class="box-body">
        <p>

            <span data-toggle="tooltip" data-placement="left" title=" نویسنده "><i class="fa fa-pencil" ></i> {$operator->name}</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" تاریخ ایجاد صفحه "><i class="fa fa-clock-o" ></i> {jdate(" l j F Y",strtotime($page->date_created))}</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" تاریخ آخرین تغییر "><i class="fa fa-clock-o" ></i> {jdate(" l j F Y",strtotime($page->date_modified))}</span>


        </p>
    </div>
</div>
<!--  ******  -->
