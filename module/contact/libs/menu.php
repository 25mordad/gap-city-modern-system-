<?php

/**
 * menu.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the Utility Component.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */


/**
 * 
 *  Change Line 28 , 32 , 33 , 38 , 42
 *  
 */

echo
'
		  <!-- MENU_ITEM -->
                    <div class="ca-item ">
                        <div class="mym ';
if ($GLOBALS['GCMS_ROUTER']->controller=="contact")
	echo 'mymactive';
echo ' ">
                            <a href="contact">
                                <span class="title">
                                   <p >دفترچه تلفن</p>
                                   <img src="/core/module/contact/backend/images/contact.png" />
                                </span>
                            </a>
                            <div class="clear"></div>
                            <div class="link right ">
                        		<a href="contact/grouping"><span>گروه بندی</span></a><br />
								<a href="contact"><span>لیست تماس ها</span></a><br />
                             </div>
                            <div class="link_sp right"></div>
                            <div class="link right ">
                                <a href="contact/new"><span>ایجاد تماس جدید</span></a><br />
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!-- MENU_ITEM -->
			';