<?php

/**
 * frontend_pay_mellat.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > pay_mellat
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/pay_mellat/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

require_once(__COREROOT__."/libs/nusoap/nusoap_client.php");

function index()
{
	if(isset($_SESSION["glogin_username"]) or $GLOBALS['GCMS_SETTING']['pay_mellat']['usermodule'] == "notactive")
	{
		if(isset($_GET['confirm'])and valid_form())
		{
			$form_RefId="";
			$client=new nusoap_client('https://pgws.bpm.bankmellat.ir/pgwchannel/services/pgw?wsdl');
			$namespace='http://interfaces.core.sw.bps.com/';
			if ($GLOBALS['GCMS_SETTING']['pay_mellat']['usermodule'] == "notactive")
			{
				$_POST['txt'] = $_POST['txt'] . " - " . $_POST['name'];
				$_SESSION["glogin_user_id"] = 0 ;
			}
				
			$arr_insert=array(
					"id_user" => $_SESSION["glogin_user_id"],
					"amount" => $_POST['amount'],
					"txt" => $_POST['txt'],
					"date" => date("Y-m-d H:i:s"),
					"bank_info" => "",
					"status" => "pending"
			);
			PayMellat::insert($arr_insert);
			$orderId=mysql_insert_id();

			$terminalId=$GLOBALS['GCMS_SETTING']['pay_mellat']['terminal_id'];
			$userName=$GLOBALS['GCMS_SETTING']['pay_mellat']['username'];
			$userPassword=$GLOBALS['GCMS_SETTING']['pay_mellat']['password'];
			$site_url= "http://".$_SERVER['SERVER_NAME']; //$site_url=$GLOBALS['GCMS_SETTING']['pay_mellat']['site_url'];
				
			$amount="$_POST[amount]";
			$localDate=date("Ymd");
			$localTime=date("Gis");
			$additionalData="$_POST[txt]";
			require_once(__COREROOT__."/libs/utility/hashing.php");
			$callBackUrl=$site_url."/pay_mellat/back/".$orderId."?id=".rndstring(90)."&id_user="
					.$_SESSION["glogin_user_id"]."&amount=".$_POST['amount'];
			$payerId="0";
			// Check for an error
			$err=$client->getError();
			if($err)
			{
				die("ERROR l:52");
			}
			$parameters=array(
					'terminalId' => $terminalId,
					'userName' => $userName,
					'userPassword' => $userPassword,
					'orderId' => $orderId,
					'amount' => $amount,
					'localDate' => $localDate,
					'localTime' => $localTime,
					'additionalData' => $additionalData,
					'callBackUrl' => $callBackUrl,
					'payerId' => $payerId
			);

			// Call the SOAP method
			$result=$client->call('bpPayRequest', $parameters, $namespace);
			// Check for a fault
			if($client->fault)
			{
				die("ERROR l:72");
			}
			else
			{
				$resultStr=$result;
				$err=$client->getError();
				if($err)
				{
					die("ERROR l:88");
				}
				else
				{
					// Display the result
					$res=explode(',', $resultStr);
					$ResCode=$res[0];
					if($ResCode=="0")
					{
						//update_table to save status

						$form_RefId="
						<form method=\"POST\" name=\"pay_form\" action=\"https://pgw.bpm.bankmellat.ir/pgwchannel/startpay.mellat\" id=\"pay_form\"  >
						<input type=\"hidden\" value=\"$res[1]\" name=\"RefId\" />
						</form>
						";
						$GLOBALS['GCMS']->assign('form_RefId', $form_RefId);
						$GLOBALS['GCMS']->assign('error', "false");
					}
					else
					{
						$GLOBALS['GCMS']->assign('error', "true");
						//$result[]="مشکل در اتصال به بانک  ملت. لطفا چند ساعت دیگر تلاش کنید";
						$GLOBALS['GCMS']->assign('result', $result);
						$GLOBALS['GCMS']->assign('alert', "alarm");
					}
				}
			}

		}
}
else
	header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}

function back($id)
{
	if(isset($_SESSION["glogin_username"])  or $GLOBALS['GCMS_SETTING']['pay_mellat']['usermodule'] == "notactive")
	{
		$pay=PayMellat::get(array("id" => $id));
		if($pay->id_user!=$_SESSION["glogin_user_id"] and $GLOBALS['GCMS_SETTING']['pay_mellat']['usermodule'] != "notactive" )
		{
			$_SESSION['result']="یه چیزی ، یه جایی اشتباه شده";
			$_SESSION['alert']="error";
			header("location: /pay_mellat");
		}
		if($_REQUEST["ResCode"]==0)
		{
			$client=new nusoap_client('https://pgws.bpm.bankmellat.ir/pgwchannel/services/pgw?wsdl');
			$namespace='http://interfaces.core.sw.bps.com/';
			$terminalId=$GLOBALS['GCMS_SETTING']['pay_mellat']['terminal_id'];
			$userName=$GLOBALS['GCMS_SETTING']['pay_mellat']['username'];
			$userPassword=$GLOBALS['GCMS_SETTING']['pay_mellat']['password'];

			$orderId=$_REQUEST["ResCode"];
			$verifySaleOrderId=$_REQUEST["SaleOrderId"];
			$verifySaleReferenceId=$_REQUEST["SaleReferenceId"];

			// Check for an error
			$err=$client->getError();
			if($err)
			{
				$message=$message.'<h2>Constructor error</h2><pre>'.$err.'</pre>';
				die("5");
			}

			$parameters=array(
					'terminalId' => $terminalId,
					'userName' => $userName,
					'userPassword' => $userPassword,
					'orderId' => $orderId,
					'saleOrderId' => $verifySaleOrderId,
					'saleReferenceId' => $verifySaleReferenceId
			);

			// Call the SOAP method
			$result=$client->call('bpVerifyRequest', $parameters, $namespace);
			// Check for a fault
			if($client->fault)
			{
				$message=$message.'<h2>Fault</h2><pre>';
				//print_r($result);
				$message=$message.'</pre>';
				die("6");
			}
			else
			{

				$resultStr=$result;

				$err=$client->getError();
				if($err)
				{
					// Display the error
					$message=$message.'<h2>Error</h2><pre>'.$err.'</pre>';
					die("7");
				}
				else
				{
					// Display the result
					// Update Table, Save Verify Status
					// Note: Successful Verify means complete successful sale was done.
					//echo "<script>alert('Verify Response is : " . $resultStr . "');</script>";
					//$message = $message. "Verify Response is : " . $resultStr;

					// Call the SOAP method
					$result=$client->call('bpSettleRequest', $parameters, $namespace);
					if($client->fault)
					{
						$message=$message.'<h2>Fault</h2><pre>';
						//print_r($result);
						$message=$message.'</pre>';
						die("8");
					}
					else
					{
						$resultStr=$result;

						$err=$client->getError();
						if($err)
						{
							// Display the error
							$message=$message.'<h2>Error</h2><pre>'.$err.'</pre>';
							die("9");
						}
						else
						{
							// Update Table, Save Settle Status
							// Note: Successful Settle means that sale is settled.
							//echo "<script>alert('Settle Response is : " . $resultStr . "');</script>";
							//$message = $message. "Settle Response is : " . $resultStr;
							$txtDB="
							RefId = $_POST[RefId] , ResCode = $_POST[ResCode] ,                         SaleOrderId = $_POST[SaleOrderId]  , SaleReferenceId = $_POST[SaleReferenceId] , CardHolderInfo = $_POST[CardHolderInfo] ";
							$arr_update=array(
									"id" => $id,
									"bank_info" => $txtDB,
									"status" => "confirm"
							);
							PayMellat::update($arr_update);
							if ($GLOBALS['GCMS_SETTING']['pay_mellat']['usermodule'] != "notactive")
							{
								$row_c=MetaUser::get(
										array(
												"id_user" => $_SESSION["glogin_user_id"],
												"name" => "credit"
										));
								if(!isset($row_c->id))
								{
									$arr_new_meta=array(
											"id_user" => $_SESSION["glogin_user_id"],
											"name" => "credit",
											"value" => 0
									);
									MetaUser::insert($arr_new_meta);
									$row_c=MetaUser::get(
											array(
													"id_user" => $_SESSION["glogin_user_id"],
													"name" => "credit"
											));
								}
								$new_credit=$row_c->value+$pay->amount;
								$arr_update_meta=array(
										"id" => $row_c->id,
										"value" => $new_credit
								);
								MetaUser::update($arr_update_meta);
								$_SESSION["glogin_user_credit"]=$new_credit;
							}
								
							//
							$text_form="
                            پرداخت در سیستم ثبت شد
                            ";
							$arr_email=array(
									"from" => $GLOBALS['GCMS_SETTING']['general']['email'],
									"to" => $GLOBALS['GCMS_SETTING']['general']['email'],
									//"support@rses.ir",
									"subject" => "Pay Form ".$_SERVER['HTTP_HOST'],
									"text" => $text_form,
									"sign" => "::ارسال شده توسط سیستم::",
									"URL" => "آدرس سایت :: ".$_SERVER['HTTP_HOST'],
							);
							$sendmail=new Email();
							$sendmail->set("html", true);
							$sendmail->getParams($arr_email);
							$sendmail->parseBody();
							$sendmail->setHeaders();

							$sendmail->send();
							$_SESSION['result']="پرداخت شما با موفقیت در سیستم ثبت شد ، شماره تراکنش شما $_POST[SaleReferenceId]";
							$_SESSION['alert']="success";
							if ($GLOBALS['GCMS_SETTING']['pay_mellat']['usermodule'] != "notactive")
								header("location: /pay_mellat/list");
							else
								header("location: /pay_mellat");

						}// end Display the result
					}// end Check for errors

				}// end Display the result
			}// end Check for errors

		}
		else
		{
			if($_REQUEST["ResCode"]==17)
			{
				$arr_update=array(
						"id" => $id,
						"bank_info" => "ResCode::".$_REQUEST["ResCode"],
						"status" => "cancel"
				);
				PayMellat::update($arr_update);
				$_SESSION['result']="کاربر از انجام تراکنش منصرف شده است";
				$_SESSION['alert']="alarm";
				header("location: /pay_mellat");
			}
			else
			{
				$arr_update=array(
						"id" => $id,
						"bank_info" => "ResCode::".$_REQUEST["ResCode"],
						"status" => "error"
				);
				PayMellat::update($arr_update);
				$_SESSION['result']="خطا در پرداخت";
				$_SESSION['alert']="alarm";
				header("location: /pay_mellat");
			}
		}
	}
	else
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}

function list_pay_mellat()
{
	if(isset($_SESSION["glogin_username"]))
	{
		$GLOBALS['GCMS']
		->assign('lists_pay',
				PayMellat::get(
						array(
								"id_user" => $_SESSION["glogin_user_id"],
								"status" => "confirm"
						), true, array("by" => "date", "sort" => "DESC")));
	}
	else
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}

function valid_form()
{
	$validation=true;

	$_POST['amount']=htmlspecialchars(trim($_POST['amount']), ENT_QUOTES);
	$_POST['txt']=htmlspecialchars(trim($_POST['txt']), ENT_QUOTES);

	if(trim($_POST['amount'])=="")
	{
		$result[]="فیلد مبلغ خالی است.";
		$validation=false;
		$GLOBALS['GCMS']->assign('result', $result);
		$GLOBALS['GCMS']->assign('alert', "alarm");
	}
	return $validation;
}
