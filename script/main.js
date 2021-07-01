function email_validate(user_mail) {
    const validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (validRegex.test(user_mail)) {
        return true;
    }
    else {
        return false;
    }
}

function send_otp() {
    var user_mail = document.getElementById("user_mail").value;
    if (user_mail != "" & email_validate(user_mail)) {
        document.getElementById("step-2").style.display = "block";
        document.getElementById("user_mail").disabled = true;
    }
}