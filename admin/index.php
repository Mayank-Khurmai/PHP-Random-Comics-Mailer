<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>XKCD Challenge</title>
    <link rel="icon" href="https://avatars.githubusercontent.com/u/65281650?s=200&v=4" type="image/icon type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/admin-login.css">
</head>

<body>



<div class="form-style">

<div id="form-style-div">
    <h1>Admin Login!<span>Sign in to visit the Admin Panel Dashboard</span></h1>
    <form>

        <div id="step-1">
            <div class="section"><span>1</span>Enter Login Credentials</div>
            <div class="inner-wrap">
                <label>Email Address <input type="email" name="admin_mail" id="admin_mail" placeholder="Eg- abc@xkcd.com" autocomplete="off" /></label>
                <label>Password <input type="password" name="admin_mail" id="admin_pass" placeholder="********" autocomplete="off" /></label>
                <label id="credential-warn"></label>
            </div>
        </div>

        <div id="step-2">
            <div class="section"><span>2</span>Enter OTP</div>
            <div class="inner-wrap">
                <label>Enter OTP sent to your Email <input type="number" name="otp" id="otp" value="123456" autocomplete="off" /></label>
                <label id="otp-warn"></label>
            </div>
        </div>

        <div class="button-section">
            <input type="button" value="Send OTP" onclick="send_otp();" flag="step-1" id="s-otp-button" />
        </div>

    </form>
</div>
</div>
    <script src="./script/admin-login.js"></script>

</body>

</html>