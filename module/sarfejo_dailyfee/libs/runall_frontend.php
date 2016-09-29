<?php

/**
 * runall_frontend.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * This file will be excuted before other controllers in frontend section.
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

if ( $GLOBALS['GCMS_SETTING']['sarfejo_dailyfee']['sms'] == "true" and $GLOBALS['GCMS_SETTING']['sarfejo_dailyfee']['last'] < date("Y-m-d",strtotime( "now" ))   )
{
    //;
    if ($GLOBALS['GCMS_SETTING']['sarfejo_dailyfee']['time'] < date("H:m",strtotime( "now" )))
    {
        //TODO find all asnaf
        //TODO find today fee
        //TODO send sms to all
        //TODO update last in setting
    }

}


