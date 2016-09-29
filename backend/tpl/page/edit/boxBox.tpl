<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
بلوک های صفحه
        </h3>
    </div>
    <div class="box-body">
                <p>
                    <a href="/gadmin/box/new?pid={$page->id}" class="btn bg-purple btn-block" >
                        ایجاد بلوک جدید برای صفحه
                    </a>

                    {foreach $boxes as $bx}
                        <br/>
                        <i class="fa fa-th-large" ></i>
                         <a href="/gadmin/box/edit/{$bx->id}" > {$bx->box_title|truncate:25:"..":true}</a>
                    {/foreach}

                </p>
    </div>
</div>
<!--  ******  -->