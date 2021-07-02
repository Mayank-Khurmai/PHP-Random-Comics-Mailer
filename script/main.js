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

function ajax_send_otp(user_mail) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./php/send_otp.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText.trim() == "OTP Sent Successfully"){
                step_two();
            }
            else if(this.responseText.trim() == "Email is Already Verified"){
                document.getElementById("email-warn").innerHTML = "Email is Already Verified !";
            }
            else if(this.responseText.trim() == "Invalid Email"){
                document.getElementById("email-warn").innerHTML = "Invalid Email !";
            }
            else{
                document.getElementById("email-warn").innerHTML = "Please try Again !";
            }            
        }
    }
    xhttp.send("email="+user_mail);
}

function send_otp() {
    var email_warn = document.getElementById("email-warn");
    var otp_warn = document.getElementById("otp-warn");
    var user_mail = document.getElementById("user_mail").value;
    if (document.getElementById("s-otp-button").getAttribute("flag") == "step-1") {
        if (user_mail != "" & email_validate(user_mail)) {
            ajax_send_otp(user_mail);
        }
        else {
            email_warn.innerHTML = "Invalid Email !";
        }
    }
    else {
        email_warn.innerHTML = "";
        if (document.getElementById("otp").value == 123) {
            otp_warn.innerHTML = "";
            console.log("Success");
        }
        else {
            otp_warn.innerHTML = "Invalid OTP";
        }
    }

}