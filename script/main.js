function email_validate(user_mail) {
    const validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (validRegex.test(user_mail)) {
        return true;
    }
    else {
        return false;
    }
}

function ajax_send_otp(user_mail) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./php/send_otp.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
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
            document.getElementById("step-2").style.display = "block";
            document.getElementById("user_mail").disabled = true;
            document.getElementById("s-otp-button").value = "Submit";
            document.getElementById("s-otp-button").setAttribute("flag", "flag-2");
            ajax_send_otp(user_mail);
        }
        else {
            email_warn.style.display = "block";
        }
    }
    else {
        email_warn.style.display = "none";
        if (document.getElementById("otp").value == 123) {
            otp_warn.style.display = "none";
            console.log("Success");
        }
        else {
            otp_warn.style.display = "block";
        }
    }

}