<!DOCTYPE html>
<html>
<head>
    <title>Pembatalan Transaksi</title>
    <link href="{{ url('assets/mpnj/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
</head>
<style>
    body {
        padding: 0;
        margin: 0;
    }

    html {
        -webkit-text-size-adjust: none;
        -ms-text-size-adjust: none;
    }

    @media only screen and (max-device-width: 680px), only screen and (max-width: 680px) {
        *[class="table_width_100"] {
            width: 96% !important;
        }

        *[class="border-right_mob"] {
            border-right: 1px solid #dddddd;
        }

        *[class="mob_100"] {
            width: 100% !important;
        }

        *[class="mob_center"] {
            text-align: center !important;
        }

        *[class="mob_center_bl"] {
            float: none !important;
            display: block !important;
            margin: 0px auto;
        }

        .iage_footer a {
            text-decoration: none;
            color: #929ca8;
        }

        img.mob_display_none {
            width: 0px !important;
            height: 0px !important;
            display: none !important;
        }

        img.mob_width_50 {
            width: 40% !important;
            height: auto !important;
        }
    }

    .table_width_100 {
        width: 680px;
    }

    .btn {
        border: 2px solid black;
        background-color: white;
        color: black;
        padding: 14px 28px;
        font-size: 16px;
        cursor: pointer;
    }

    /* Green */
    .success {
        border-color: #4CAF50;
        color: green;
    }

    .success:hover {
        background-color: #4CAF50;
        color: white;
    }
</style>
<body>
<div id="mailsub" class="notification" align="center">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;">
        <tr>
            <td align="center" bgcolor="#eff3f8">


                <!--[if gte mso 10]>
                <table width="680" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                <![endif]-->

                <table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%"
                       style="max-width: 680px; min-width: 300px;">
                    <tr>
                        <td>
                            <!-- padding -->
                            <div style="height: 80px; line-height: 80px; font-size: 10px;"> </div>
                        </td>
                    </tr>
                    <!--header -->
                    <tr>
                        <td align="center" bgcolor="#ffffff">
                            <!-- padding -->
                            <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div>
                            <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="left"><!--

				Item -->
                                        <div class="mob_center_bl"
                                             style="float: left; display: inline-block; width: 115px;">
                                            <table class="mob_center" width="115" border="0" cellspacing="0"
                                                   cellpadding="0" align="left" style="border-collapse: collapse;">
                                                <tr>
                                                    <td align="left" valign="middle">
                                                        <!-- padding -->
                                                        <div style="height: 20px; line-height: 20px; font-size: 10px;">
                                                             
                                                        </div>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <a href="http://belanj/id" target="_blank">
                                                                        <img src="http://belanj.id/assets/logo/belaNJ-hijau.png" alt="Belanj" width="150"/>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div><!-- Item END--><!--[if gte mso 10]> -->
                                        </td>
                                </tr>
                            </table>
                            <!-- padding -->
                            <div style="height: 50px; line-height: 50px; font-size: 10px;"> </div>
                        </td>
                    </tr>
                    <!--header END-->

                    <!--content 1 -->
                    <tr>
                        <td align="center" bgcolor="#fbfcfd">
                            <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">
                                        <!-- padding -->
                                        <div style="height: 60px; line-height: 60px; font-size: 10px;"> </div>
                                        <div style="line-height: 44px;">
                                            <font face="Arial, Helvetica, sans-serif" size="5" color="#57697e"
                                                  style="font-size: 34px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 34px; color: #57697e;">
						Halo {{ $user->nama_lengkap }}
					</span></font>
                                        </div>
                                        <!-- padding -->
                                        <div style="height: 40px; line-height: 40px; font-size: 10px;"> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <div style="line-height: 24px;">
                                            <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e"
                                                  style="font-size: 15px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
						Terima kasih telah mendaftar aku Belanj. <br>
                        Silahkan klik link dibawah ini untuk mengaktifkan akun Belanj anda.
					</span></font>
                                        </div>
                                        <!-- padding -->
                                        <div style="height: 40px; line-height: 40px; font-size: 10px;"> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <div style="line-height: 24px;">
                                            <a href="{{ $url }}" target="_blank" class="btn success">Konfirmasi Disini</a>
                                        </div>
                                        <!-- padding -->
                                        <div style="height: 60px; line-height: 60px; font-size: 10px;"> </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!--content 1 END-->
                    <!--footer -->
                    <tr>
                        <td class="iage_footer" align="center" bgcolor="#ffffff">
                            <!-- padding -->
                            <div style="height: 80px; line-height: 80px; font-size: 10px;"> </div>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">
                                        <font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5"
                                              style="font-size: 13px;">
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
					2020 © Belanj. ALL Rights Reserved.
				</span></font>
                                    </td>
                                </tr>
                            </table>

                            <!-- padding -->
                            <div style="height: 30px; line-height: 30px; font-size: 10px;"> </div>
                        </td>
                    </tr>
                    <!--footer END-->
                    <tr>
                        <td>
                            <!-- padding -->
                            <div style="height: 80px; line-height: 80px; font-size: 10px;"> </div>
                        </td>
                    </tr>
                </table>
                <!--[if gte mso 10]>
                </td></tr>
                </table>
                <![endif]-->

            </td>
        </tr>
    </table>

</div>
</body>
</html>