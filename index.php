<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>XKCD Challenge</title>
    <link rel="icon" href="https://avatars.githubusercontent.com/u/65281650?s=200&v=4" type="image/icon type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./users/style/main.css">
</head>

<body>



    <div class="form-style">

        <div id="tick-icon-div">
            <img src="https://img.icons8.com/color/96/000000/approval--v3.gif" />
            <div>
                <span>Congratulations! your Email has been successfully verified.</span>
            </div>
            <a href="./users/php/unsubscribe.php">Click to Unsubscribe</a>
        </div>


        <div id="form-style-div">
            <h1>Sign Up Now!<span>Sign up to get random XKCD comics every five minutes!</span></h1>
            <form>

                <div id="step-1">
                    <div class="section"><span>1</span>Enter your Email Address</div>
                    <div class="inner-wrap">
                        <label>Email Address <input type="email" name="user_mail" id="user_mail" placeholder="Eg- abc@xkcd.com" /></label>
                        <label id="email-warn"></label>
                    </div>
                </div>

                <div id="step-2">
                    <div class="section"><span>2</span>Enter OTP</div>
                    <div class="inner-wrap">
                        <label>Enter OTP sent to your Email <input type="number" name="otp" id="otp" /></label>
                        <label id="otp-warn"></label>
                    </div>
                </div>

                <div class="button-section">
                    <input type="button" value="Send OTP" onclick="send_otp();" flag="step-1" id="s-otp-button" />
                </div>

            </form>
        </div>
    </div>

    <script src="./users/script/subscribe.js"></script>

</body>

</html>