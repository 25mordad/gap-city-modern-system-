<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
بلوک های صفحه
        </h3>
    </div>
    <div class="box-body">
                <p>
                    <a href="" class="btn bg-purple btn-block" >
                        ایجاد بلوک جدید برای صفحه
                    </a>

                    {foreach $boxes as $bx}
                        <a href="/gadmin/box/edit/{$bx->id}"><div class="r_menu">
                                <span>{$bx->box_title|truncate:25:"..":true}</span>
                                
                            </div></a>
                    {/foreach}

                </p>
    </div>
</div>
<!--  ******  -->