<?php
/**
 * SAMPLE.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */
//Find table is update

 if (!table_exists("gcms_khodro_adver"))
 	run_sql_query();   
    


function table_exists ($table)
{ 
    $query  = "
        DESCRIBE  `$table`
          ";
    $val = mysql_query($query);
    
    if($val !== FALSE)
    {
        /* FOR CHK STUKCHR
        while($row = mysql_fetch_array($val)) 
        {
            echo "{$row['Field']} - {$row['Type']}\n";
        }
        */
       return true;
    }else{
        return false;
    }          
	
}

function run_sql_query()
{
    $q[] = "

CREATE TABLE IF NOT EXISTS `gcms_khodro_adver` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_brand` bigint(20) DEFAULT NULL,
  `id_model` bigint(20) DEFAULT NULL,
  `id_tip` bigint(20) DEFAULT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `auto_gear` varchar(45) DEFAULT NULL,
  `two_some` varchar(45) DEFAULT NULL,
  `fee` varchar(45) DEFAULT NULL,
  `used_zero` varchar(45) DEFAULT NULL,
  `used` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `bim_month` varchar(45) DEFAULT NULL,
  `bim_body` varchar(45) DEFAULT NULL,
  `fabric` varchar(45) DEFAULT NULL,
  `txt` text,
  `adv_type` varchar(45) DEFAULT NULL,
  `adv_status` varchar(45) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `error_report_count` varchar(45) DEFAULT NULL,
  `error_report_type` varchar(45) DEFAULT NULL,
  `aghsat` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ; ";
    
    $q[] = "
    		
CREATE TABLE IF NOT EXISTS `gcms_khodro_brand` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
    
    $q[] = "
    		
    		
CREATE TABLE IF NOT EXISTS `gcms_khodro_message` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `txt` text,
  `date` datetime DEFAULT NULL,
  `flag_read` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
    
    $q[] = "
    		
    		
CREATE TABLE IF NOT EXISTS `gcms_khodro_model` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_brand` bigint(20) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `min_year` varchar(45) NOT NULL,
  `max_year` varchar(45) NOT NULL,
  `year_type` varchar(45) NOT NULL,
  `auto_gear` varchar(45) NOT NULL,
  `two_some` varchar(45) NOT NULL,
  `min_fee` varchar(45) NOT NULL,
  `max_fee` varchar(45) NOT NULL,
  `model_status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
    
    $q[] = "
    		
    		
CREATE TABLE IF NOT EXISTS `gcms_khodro_pay` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `pay_fee` varchar(255) DEFAULT NULL,
  `pay_title` varchar(255) DEFAULT NULL,
  `pay_text` text,
  `bank_info` varchar(255) DEFAULT NULL,
  `pay_status` varchar(45) DEFAULT NULL,
  `pay_type` varchar(45) DEFAULT NULL,
  `pay_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
    
    $q[] = "
    		
CREATE TABLE IF NOT EXISTS `gcms_khodro_search` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `url` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
    
    $q[] = "
    		
CREATE TABLE IF NOT EXISTS `gcms_khodro_tip` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_brand` bigint(20) DEFAULT NULL,
  `id_model` bigint(20) DEFAULT NULL,
  `tip_name` varchar(255) DEFAULT NULL,
  `tip_form` varchar(45) DEFAULT NULL,
  `tip_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
    
    $q[] = "
    		
CREATE TABLE IF NOT EXISTS `gcms_khodro_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `office_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `tell` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `address` text,
  `cell_vrfy` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_salt` varchar(255) DEFAULT NULL,
  `password_temp_code` varchar(255) DEFAULT NULL,
  `user_status` varchar(45) DEFAULT NULL,
  `user_type` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `admin_txt` text,
  `label` varchar(255) DEFAULT NULL,
  `res_list` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1234 ;";
    
    $q[] = "
    		
CREATE TABLE IF NOT EXISTS `gcms_khodro_usercost` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `cost_name` varchar(255) DEFAULT NULL,
  `cost_fee` varchar(255) DEFAULT NULL,
  `cost_text` text,
  `cost_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
    
    $q[] = "

    		
INSERT INTO `gcms_setting` (`st_group`, `st_key`, `st_value`) VALUES('khodro', 'vijeDay', '1');";
    
    $q[] = "
INSERT INTO `gcms_setting` (`st_group`, `st_key`, `st_value`) VALUES('khodro', 'vijeFee', '1');";
    
    $q[] = "
INSERT INTO `gcms_setting` (`st_group`, `st_key`, `st_value`) VALUES('khodro', 'normalDay', '3');";
    
    $q[] = "
INSERT INTO `gcms_setting` (`st_group`, `st_key`, `st_value`) VALUES('khodro', 'vijeMoon', '0');";
    
    $q[] = "
INSERT INTO `gcms_setting` (`st_group`, `st_key`, `st_value`) VALUES('khodro', 'normalMoon', '3');
    		";

        echo "
        <div style=\"border:1px solid blue; padding:10px; width: 700px; margin:10px auto;\" >
        Install new plugin : ".$_POST['module_name']."<br />
        </div>
        ";
    foreach ($q as $row)
    {
        $GLOBALS['GCMS_DB']->query($row);
        echo "
        <div style=\"border:1px solid blue; padding:10px; width: 700px; margin:10px auto;\" >
        query execute : 
        <br />$row 
        </div>
        ";
    }
    
}
    
