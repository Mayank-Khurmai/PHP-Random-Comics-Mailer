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

function ajax_send_otp(user_mail, user_pass) {
    document.getElementById("s-otp-button").value = "Validating...";
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./php/validate-admin.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if(this.responseText.trim() == "OTP Sent Successfully"){
                step_two();
            }
            else if(this.responseText.trim() == "Email is Already Verified"){
                document.getElementById("s-otp-button").value = "Send OTP";
                document.getElementById("email-warn").innerHTML = "Email is Already Verified !";
            }
            else if(this.responseText.trim() == "Invalid Email"){
                document.getElementById("s-otp-button").value = "Send OTP";
                document.getElementById("email-warn").innerHTML = "Invalid Email !";
            }
            else{
                document.getElementById("s-otp-button").value = "Send OTP";
                document.getElementById("email-warn").innerHTML = "Please try Again !";
            }            
        }
    }
    xhttp.send("email="+user_mail+"&pass="+user_pass);
}

function verify_otp(user_mail,otp){
    document.getElementById("s-otp-button").value = "Verifying...";
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./php/verify_otp.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText.trim() == "Email Verified"){
                final_step();
            }
            else if(this.responseText.trim() == "Invalid OTP"){
                document.getElementById("s-otp-button").value = "Submit";
                document.getElementById("otp-warn").innerHTML = "Invalid OTP !";
            }
            else{
                document.getElementById("s-otp-button").value = "Submit";
                document.getElementById("otp-warn").innerHTML = "Please try Again !";
            }           
        }
    }
    xhttp.send("email="+user_mail+"&otp="+otp);
}

function send_otp() {
    var credential_warn = document.getElementById("credential-warn");
    var otp_warn = document.getElementById("otp-warn");
    var user_mail = document.getElementById("user_mail").value;
    var user_pass = document.getElementById("user_pass").value;
    var otp = document.getElementById("otp").value;
    if (document.getElementById("s-otp-button").getAttribute("flag") == "step-1") {
        if (user_mail != "" & user_pass !="" & email_validate(user_mail)) {
            ajax_send_otp(user_mail, user_pass);
        }
        else {
            document.getElementById("s-otp-button").value = "Send OTP";
            credential_warn.innerHTML = "Invalid Credentials !";
        }
    }
    else {
        email_warn.innerHTML = "";
        if(otp != "" & otp.length==6){
            otp_warn.innerHTML = "";
            verify_otp(user_mail,otp);
        }
        else {
            document.getElementById("s-otp-button").value = "Submit";
            otp_warn.innerHTML = "Invalid OTP !";
        }        
    }
}