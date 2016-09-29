<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu " >
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="glyphicon glyphicon-user"></i>
        <span>{$smarty.session.username} <i class="caret"></i></span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header bg-light-blue">
            <img src="{$loct}/img/default-avatar.png" class="img-circle" alt="User Image" />
            <p>
                {$smarty.session.name}
                <small>{$smarty.session.email}</small>
            </p>
        </li>

        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="/logout" class="btn btn-danger  btn-flat btn-sm">
                    خروج
                </a>
            </div>
            <div class="pull-right">
                <a href="/gadmin/operator/edit/{$smarty.session.userid}" class="btn btn-default btn-flat btn-sm">
                    پروفایل کاربری
                </a>
                <a href="/gadmin/operator/pass/{$smarty.session.userid}" class="btn btn-default btn-flat btn-sm">
تغییر کلمه عبور
                </a>
            </div>
        </li>
    </ul>
</li>
