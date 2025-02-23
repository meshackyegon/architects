<?php
require_once "create.php";
$conn = connect();
$total = 0;

$date_today = date('Ymd');

foreach($_POST['invoice_item_price'] as $val){
    
    if(is_numeric($val)){
        $total += $val; 
    }
}

// INSERT TO TABLE INVOICE
$arr['invoice_id']  = create_id('invoice', 'invoice_id');
$arr['property_id'] = security('property_id');
$arr['employee_id'] = $_SESSION['employee_id'];
$arr['invoice_key'] = 'HUD-'.generateRandomString();
$arr['invoice_total_price'] = $total;

build_sql_insert("invoice",$arr);

//INSERT TO TABLE INVOICE ITEMS

foreach($_POST['invoice_item_name'] as $key=>$value){
    $arr2['invoice_item_quantity']      = mysqli_real_escape_string($conn,$_POST['invoice_item_quantity'][$key]);
    $arr2['invoice_id']                 = $arr['invoice_id'];
    $arr2['invoice_item_name']          = mysqli_real_escape_string($conn,$_POST['invoice_item_name'][$key]); 
    $arr2['invoice_item_id']            = create_id('invoice_item', 'invoice_item_id');
    $arr2['invoice_item_description']   = mysqli_real_escape_string($conn,$_POST['invoice_item_description'][$key]); 
    $arr2['invoice_item_price']         = mysqli_real_escape_string($conn,$_POST['invoice_item_price'][$key]); 
    build_sql_insert("invoice_item",$arr2);
    
}
//EMAIL ADMIN

$name       = APP_NAME;
$subject    = 'New Invoice From '. $_SESSION['employee_email'];
$email      = 'patjunhopat@gmail.com';
$body       = '<p style="font-family:Poppins, sans-serif">';
$body       .= 'Dear Admin, <br>';
$body       .= 'You have an invoice from '.$_SESSION['employee_name'].' , <br>';
$body       .= 'Log in to your admin dashboard : <a href=" ' . admin_url . ' "> CLICK HERE </a> to respond to the request';
$body       .= '</p>';

$invoice        = get_by_id('invoice', $arr['invoice_id']);
$property_name  = get_single_property($invoice['property_id']);
$invoice_items  = get_invoice_items($arr['invoice_id']);

$body       .= '<!DOCTYPE html>

<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">

<head>
	<title></title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
	<style>
		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			padding: 0;
		}

		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: inherit !important;
		}

		#MessageViewBody a {
			color: inherit;
			text-decoration: none;
		}

		p {
			line-height: inherit
		}

		.desktop_hide,
		.desktop_hide table {
			mso-hide: all;
			display: none;
			max-height: 0px;
			overflow: hidden;
		}

		@media (max-width:660px) {

			.desktop_hide table.icons-inner,
			.social_block.desktop_hide .social-table {
				display: inline-block !important;
			}

			.icons-inner {
				text-align: center;
			}

			.icons-inner td {
				margin: 0 auto;
			}

			.image_block img.big,
			.row-content {
				width: 100% !important;
			}

			.mobile_hide {
				display: none;
			}

			.stack .column {
				width: 100%;
				display: block;
			}

			.mobile_hide {
				min-height: 0;
				max-height: 0;
				max-width: 0;
				overflow: hidden;
				font-size: 0px;
			}

			.desktop_hide,
			.desktop_hide table {
				display: table !important;
				max-height: none !important;
			}
		}
	</style>
</head>

<body style="background-color: #FFFFFF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
	<table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;" width="100%">
		<tbody>
			<tr>
				<td>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #000000; color: #000000; width: 640px;" width="640">
										<tbody>
											<tr>
												<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 20px; padding-bottom: 20px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
																<div align="center" class="alignment" style="line-height:10px"><a href="http://www.example.com/" style="outline:none" tabindex="-1" target="_blank"><img alt="Logo" src="https://veseninternal.co.ke/realtors/assets/images/email/logo_white.png" style="display: block; height: auto; border: 0; width: 160px; max-width: 100%;" title="Logo" width="160" /></a></div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffde79; color: #000000; width: 640px;" width="640">
										<tbody>
											<tr>
												<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 60px; padding-bottom: 60px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
																<div align="center" class="alignment" style="line-height:10px"><img alt="Image" class="big" src="https://veseninternal.co.ke/realtors/assets/images/email/image-01_5.png" style="display: block; height: auto; border: 0; width: 481px; max-width: 100%;" title="Image" width="481" /></div>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-left:10px;padding-right:10px;padding-top:30px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #0c2b5b; line-height: 1.2; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:58px;"><strong>Dear Admin,</strong></span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #0c2b5b; line-height: 1.2; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:34px;"><strong>You have a pending invoice</strong></span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 640px;" width="640">
										<tbody>
											<tr>
												<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="10" cellspacing="0" class="divider_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td class="pad">
																<div align="center" class="alignment">
																	<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
																		<tr>
																			<td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 0px solid #FFFFFF;"><span></span></td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #8cc0e8; color: #000000; width: 640px;" width="640">
										<tbody>
											<tr>
												<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
													<table border="0" cellpadding="0" cellspacing="0" class="image_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:25px;">
																<div align="center" class="alignment" style="line-height:10px"><img alt="Image" src="https://veseninternal.co.ke/realtors/assets/images/email/icon-01_2.png" style="display: block; height: auto; border: 0; width: 24px; max-width: 100%;" title="Image" width="24" /></div>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:25px;padding-left:10px;padding-right:10px;padding-top:15px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 21px; color: #ffffff; line-height: 1.5; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">Invoice No:</p>
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;"><strong>'.$arr['invoice_key'].'</strong></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
												<td class="column column-2" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
													<table border="0" cellpadding="0" cellspacing="0" class="image_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:25px;">
																<div align="center" class="alignment" style="line-height:10px"><img alt="Image" src="https://veseninternal.co.ke/realtors/assets/images/email/icon-02_2.png" style="display: block; height: auto; border: 0; width: 22px; max-width: 100%;" title="Image" width="22" /></div>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:25px;padding-left:10px;padding-right:10px;padding-top:10px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 21px; color: #ffffff; line-height: 1.5; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">Invoice Date:</p>
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;"><strong>'.$date_today.'</strong></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
												<td class="column column-3" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
													<table border="0" cellpadding="0" cellspacing="0" class="image_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td class="pad" style="width:100%;padding-right:0px;padding-left:0px;padding-top:25px;">
																<div align="center" class="alignment" style="line-height:10px"><img alt="Image" src="https://veseninternal.co.ke/realtors/assets/images/email/icon-03_2.png" style="display: block; height: auto; border: 0; width: 25px; max-width: 100%;" title="Image" width="25" /></div>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:25px;padding-left:10px;padding-right:10px;padding-top:10px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 21px; color: #ffffff; line-height: 1.5; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">Amount Due:</p>
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;"><strong>'.$invoice['invoice_total_price'].'</strong></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #5c98c7; color: #000000; width: 640px;" width="640">
										<tbody>
											<tr>
												<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-left: 30px; padding-right: 30px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="66.66666666666667%">
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-left:10px;padding-right:10px;padding-top:30px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;"><span style="font-size:20px;"><strong>Client:</strong></span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:30px;padding-left:10px;padding-right:10px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 21px; color: #ffffff; line-height: 1.5; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 21px;">Nicola Realty LLC, represented by John Doe,</p>
																		<p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 21px;">ID: 020 5793 9378, Prairie Drive Far,</p>
																		<p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 21px;">Rockaway, Y 11691, US</p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
												<td class="column column-2" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:45px;padding-left:10px;padding-right:10px;padding-top:50px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 21px; color: #ffffff; line-height: 1.5; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">Amount Due:</p>
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;"><strong>$1200.00</strong></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #6da3cd; color: #000000; width: 640px;" width="640">
										<tbody>
											<tr>
												<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="25%">
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>No.</strong></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
												<td class="column column-2" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="25%">
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>ITEM DESCRIPTION</strong></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
												<td class="column column-3" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="25%">
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>PRICE</strong></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
												<td class="column column-4" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="25%">
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong>QTY</strong></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>';
					
                    $i = 1;
                    foreach($invoice_items as $item)
                    {
					$body .= '
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #5c98c7; color: #000000; width: 640px;" width="640">
										<tbody>
											<tr>
												<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 1px solid #6DA3CD; vertical-align: top; border-top: 0px; border-right: 0px; border-left: 0px;" width="25%">
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;">'.$i.'</p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
												<td class="column column-2" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 1px solid #6DA3CD; vertical-align: top; border-top: 0px; border-right: 0px; border-left: 0px;" width="25%">
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;">'.$item['invoice_item_name'].'</p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
												<td class="column column-3" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 1px solid #6DA3CD; vertical-align: top; border-top: 0px; border-right: 0px; border-left: 0px;" width="25%">
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;">Ksh. '.$item['invoice_item_price'].'</p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
												<td class="column column-4" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 1px solid #6DA3CD; vertical-align: top; border-top: 0px; border-right: 0px; border-left: 0px;" width="25%">
													<table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad" style="padding-bottom:15px;padding-left:10px;padding-right:10px;padding-top:15px;">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #ffffff; line-height: 1.2; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;">'.$item['invoice_item_quantity'].'</p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
                    ';
                    }
                    
                    $body .= '
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-10" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #5c98c7; color: #000000; width: 640px;" width="640">
										<tbody>
											<tr>
												<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 20px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="10" cellspacing="0" class="text_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 25.2px; color: #ffffff; line-height: 1.8; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 28.8px;"><span style="font-size:16px;">Subtotal:<strong> Ksh. '.$invoice['invoice_total_price'].' </strong></span><br />

																			<br /><span style="font-size:16px;">Amount Due: <strong>Ksh. '.$invoice['invoice_total_price'].'</strong></span>
																		</p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-11" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #5c98c7; color: #000000; width: 640px;" width="640">
										<tbody>
											<tr>
												<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="10" cellspacing="0" class="divider_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td class="pad">
																<div align="center" class="alignment">
																	<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
																		<tr>
																			<td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 0px solid #5C98C7;"><span></span></td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-12" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #5c98c7; color: #000000; width: 640px;" width="640">
										<tbody>
											<tr>
												<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 45px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="10" cellspacing="0" class="button_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td class="pad">
																<div align="center" class="alignment">
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-13" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 640px;" width="640">
										<tbody>
											<tr>
												<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 25px; padding-bottom: 15px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="10" cellspacing="0" class="social_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
														<tr>
															<td class="pad">
																<div align="center" class="alignment">
																	<table border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;" width="168px">
																		<tr>
																			<td style="padding:0 10px 0 0px;"><a href="http://www.example.com/" target="_blank"><img alt="Facebook" height="32" src="https://veseninternal.co.ke/realtors/assets/images/email/facebook2x.png" style="display: block; height: auto; border: 0;" title="Facebook" width="32" /></a></td>
																			<td style="padding:0 10px 0 0px;"><a href="http://www.example.com/" target="_blank"><img alt="Twitter" height="32" src="https://veseninternal.co.ke/realtors/assets/images/email/twitter2x.png" style="display: block; height: auto; border: 0;" title="Twitter" width="32" /></a></td>
																			<td style="padding:0 10px 0 0px;"><a href="http://www.example.com/" target="_blank"><img alt="Instagram" height="32" src="https://veseninternal.co.ke/realtors/assets/images/email/instagram2x.png" style="display: block; height: auto; border: 0;" title="Instagram" width="32" /></a></td>
																			<td style="padding:0 10px 0 0px;"><a href="http://www.example.com/" target="_blank"><img alt="LinkedIn" height="32" src="https://veseninternal.co.ke/realtors/assets/images/email/linkedin2x.png" style="display: block; height: auto; border: 0;" title="LinkedIn" width="32" /></a></td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-14" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
						<tbody>
							<tr>
								<td>
									<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 640px;" width="640">
										<tbody>
											<tr>
												<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
													<table border="0" cellpadding="10" cellspacing="0" class="text_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
														<tr>
															<td class="pad">
																<div style="font-family: sans-serif">
																	<div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #555555; line-height: 1.2; font-family: Poppins, sans-serif;">
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:11px;">Copyright © 2020 All Rights Reserved
																			</span>
																		</p>
																		<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><span style="font-size:11px;">848 North St. Hopewell, VA 23860</span></p>
																	</div>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</body>

</html>';

// echo $body;
email($email,$subject,$name,$body);

header("location:../../employee/view_invoices.php?success");