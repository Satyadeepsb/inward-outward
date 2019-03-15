<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0">    <!-- So that mobile webkit will display zoomed in -->
    <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/> <!-- enable MQ on Windows Phone -->
</head>
<style>
    @font-face {
        font-family : 'Century-Gothic';
        src: url('/fonts/Century-Gothic.ttf')  format('ttf');
    }
    body {
        font-family : 'Century-Gothic',  Helvetica ,sans-serif
    }
    table, td{
        font-family : 'Century-Gothic', Helvetica ,sans-serif
    }
    .tile-highlight{
        background-image: linear-gradient(to left, #27527b, #2196f3 85%) !important;
        color: white;
        width: 100%;
        height: 40px;
    }
    .tile-highlight:hover {
        background-image: linear-gradient(to left, #27527b, #2196f3 85%) !important;
        color: white;
    }
</style>
<body style="font-family : 'Century Gothic', Helvetica ,sans-serif;">
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
    <tr>
        <td align="center" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" style="width:700px" id="emailContainer">
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="10" cellspacing="0" width="100%" id="emailHeader">
                            <tr>
                                <td align="center" valign="top">
                                    <div class="col-md-12 tile-highlight text-center" style="margin-bottom: 5px">
                                            <p style="font-weight: bold;
                                            color: white;font-size: 20px;padding-top: 5px;
                                            font-family : 'Century Gothic', Helvetica ,sans-serif;">
                                                Inward-Outward Management
                                            </p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">
                        <table border="0" cellpadding="30" cellspacing="0" width="100%" id="emailBody">
                            <tr>
                                <td>
                                    <span style="font-family : 'Century Gothic', Helvetica ,sans-serif;text-align:left">
                                            Hello <b>{{$name}}</b>,<br>
                                        	Your invited to join Inward-Outward Management.<br>
                                        	Please use the login details below:<br>
                                        	Username: <b>{{$username}}</b><br>
                                            Password: <b>{{$password}}</b><br>
                                            <a href='{{$link}}'>Click Here</a>.<br><br>
   	                                        Thank you,<br>
                                            - Admin Team
                                    </span>
                                    <br><br>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="10" cellspacing="0" width="100%" id="emailFooter" bgcolor="#333333">
                                        <tr>
                                            <td align="center" valign="top">
                                                <table border="0"   cellpadding="0" cellspacing="10" style="font-family: 'Century Gothic', Helvetica ,sans-serif;width:700px;margin-top: 10px;margin-bottom: 10px;background: #333333; color: white;">
                                                    <tr>
                                                        <td style="min-width: 50px">&nbsp;</td>
                                                        <td style="font-family : 'Century Gothic', Helvetica ,sans-serif;text-align:left;font-size:10px;" align="left">TEL: 9887546554</td>
                                                        <td style="font-family : 'Century Gothic', Helvetica ,sans-serif;text-align:left;font-size:10px;" align="left">
                                                            <a ABOUT_US_URL TARGET REL  style="color: white; text-decoration: none;">About Us</a>
                                                        </td>
                                                        <td style="font-family : 'Century Gothic', Helvetica ,sans-serif;text-align:left;font-size:10px;" align="left">
                                                            <a COMPANY_T_AND_C_URL TARGET REL style="color: white; text-decoration: none;">Copyright &copy;</a>
                                                        </td>
                                                        <td style="min-width: 50px">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>









