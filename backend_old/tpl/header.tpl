
  		<div class="wrapper " >
  		    <div class="top_menu right " >
                <ul>
                    <li class="menu_item">
                    <a class="logout" href="/logout"	><span class="over">خروج</span></a>
                    </li>
                    <li class="menu_item">
                    <a class="home" href=""	><span class="over">میزکار</span></a>
                    </li>
                    <li class="menu_item" >
                    <a class="comment" href="comment"	><span class="over">نظرات</span></a>
                    </li>
                    <li class="menu_item">
                    <a class="statistic" href="statistic"	><span class="over">آمار سایت</span></a>
                    </li>
                    <li class="menu_item">
                    <a class="file" href="file"	><span class="over">مدیریت فایل</span></a>
                    </li>
                    <li class="menu_item">
                    <a class="operator" href="operator"	><span class="over">مدیریت اپراتورها</span></a>
                    </li>
                    <li class="menu_item">
                    <a class="menu" href="menu"	><span class="over">مدیریت منو</span></a>
                    </li>
                    <li class="menu_item">
                    <a class="setting" href="setting"	><span class="over">تنظیمات</span></a>
                    </li>
                    <li class="menu_item">
                    <a class="hlp" href="help/?part={$part}"	><span class="over">راهنما</span></a>
                    </li>
                    <li class="menu_item">
                    <a class="show" href="http://{$smarty.server.HTTP_HOST}" target="_blank"	><span class="over">نمایش سایت</span></a>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="welcome " >{jdate(" l j F Y",strtotime( "now" ))}  :: 
            <a  href="operator/edit/{$smarty.session.userid}">{$smarty.session.username}</a>
             خوش آمدید.</div>
            <div class="clear"></div>
  		</div>