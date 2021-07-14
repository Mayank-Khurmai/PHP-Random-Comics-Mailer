function email_validate(user_mail) {
    const validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (validRegex.test(user_mail)) {
        return true;
    }
    else {
        return false;
    }
}

function step_two(){
    document.getElementById("step-2").style.display = "block";
    document.getElementById("user_mail").disabled = true;
    document.getElementById("s-otp-button").value = "Submit";
    document.getElementById("s-otp-button").setAttribute("flag", "flag-2");
    document.getElementById("email-warn").innerHTML = "";
}

function final_step(){
    document.getElementById("form-style-div").style.display = "none";
    document.getElementById("tick-icon-div").style.display = "block";
}

function ajax_send_otp(user_mail) {
    var email_warn = document.getElementById("email-warn");
    var s_otp_btn = document.getElementById("s-otp-button");
    s_otp_btn.value = "Sending...";
    email_warn.innerHTML = "";
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./users/php/send_otp.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText.trim() == "OTP Sent Successfully"){
                step_two();
            }
            else if(this.responseText.trim() == "Email is Already Verified"){
                s_otp_btn.value = "Send OTP";
                email_warn.innerHTML = "Email is Already Verified !";
            }
            else if(this.responseText.trim() == "Invalid Email"){
                s_otp_btn.value = "Send OTP";
                email_warn.innerHTML = "Invalid Email !";
            }
            else{
                s_otp_btn.value = "Send OTP";
                email_warn = "Please try Again !";
            }            
        }
    }
    xhttp.send("email="+user_mail);
}

function verify_otp(user_mail,otp){
    var otp_warn = document.getElementById("otp-warn");
    var s_otp_btn = document.getElementById("s-otp-button");
    s_otp_btn.value = "Verifying...";
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./users/php/verify_otp.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText.trim() == "Email Verified"){
                final_step();
            }
            else if(this.responseText.trim() == "Invalid OTP"){
                s_otp_btn.value = "Submit";
                otp_warn.innerHTML = "Invalid OTP !";
            }
            else{
                s_otp_btn.value = "Submit";
                otp_warn.innerHTML = "Please try Again !";
            }           
        }
    }
    xhttp.send("email="+user_mail+"&otp="+otp);
}

function send_otp() {
    var email_warn = document.getElementById("email-warn");
    var otp_warn = document.getElementById("otp-warn");
    var user_mail = document.getElementById("user_mail").value;
    var otp = document.getElementById("otp").value;
    var s_otp_btn = document.getElementById("s-otp-button");
    if (s_otp_btn.getAttribute("flag") == "step-1") {
        if (user_mail != "" & email_validate(user_mail)) {
            ajax_send_otp(user_mail);
        }
        else {
            s_otp_btn.value = "Send OTP";
            email_warn.innerHTML = "Invalid Email !";
        }
    }
    else {
        email_warn.innerHTML = "";
        if(otp != "" & otp.length==6){
            otp_warn.innerHTML = "";
            verify_otp(user_mail,otp);
        }
        else {
            s_otp_btn.value = "Submit";
            otp_warn.innerHTML = "Invalid OTP !";
        }        
    }
}