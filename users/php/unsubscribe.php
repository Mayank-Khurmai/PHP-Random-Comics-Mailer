<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>XKCD Challenge</title>
    <link rel="icon" href="https://avatars.githubusercontent.com/u/65281650?s=200&v=4" type="image/icon type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../style/main.css">
</head>

<body>

<div class="form-style">

        <div id="tick-icon-div">
            <img src="https://img.icons8.com/color/96/000000/approval--v3.gif" />
            <div>
                <span>Congratulations! You has been Unsubscribed successfully .</span>
            </div>
            <a href="../../index.php">Click to Subscribe</a>
        </div>


        <div id="form-style-div">
            <h1>Unsubscribe Now!<span>By Unsubscribing, you will not receive any XKCD comics mails!</span></h1>
            <form>

                <div class="section"><span>#</span>Enter your Email Address</div>
                <div class="inner-wrap">
                    <label>Email Address <input type="email" name="user_mail" id="user_mail" placeholder="Eg- abc@xkcd.com" /></label>
                    <label id="email-warn"></label>
                </div>

                <div class="button-section">
                    <input type="button" value="Unsubscribe" onclick="unsubscribe();" id="s-otp-button"/>
                </div>

            </form>
        </div>


        <script src="./../script/unsubscribe.js"></script>

</body>

</html>