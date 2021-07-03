function email_validate(user_mail) {
    const validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (validRegex.test(user_mail)) {
        return true;
    }
    else {
        return false;
    }
}

function final_step(){
    document.getElementById("form-style-div").style.display = "none";
    document.getElementById("tick-icon-div").style.display = "block";
}

function unsuscribe_request(user_mail){
    document.getElementById("s-otp-button").value = "Unsubscribing...";
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../php/verify-unsubscribe.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText.trim() == "Email Unsuscribed"){
                final_step();
            }
            else if(this.responseText.trim() == "Invalid Email"){
                document.getElementById("s-otp-button").value = "Unsubscribe";
                document.getElementById("email-warn").innerHTML = "Invalid Email !";
            }
            else if(this.responseText.trim() == "Email not Found"){
                document.getElementById("s-otp-button").value = "Unsubscribe";
                document.getElementById("email-warn").innerHTML = "Email not Found !";
            }
            else{
                document.getElementById("s-otp-button").value = "Unsubscribe";
                document.getElementById("email-warn").innerHTML = "Please try Again !";
            }            
        }
    }
    xhttp.send("email="+user_mail);
}

function unsuscribe(){
    var email_warn = document.getElementById("email-warn");
    var user_mail = document.getElementById("user_mail").value;
    if (user_mail != "" & email_validate(user_mail)) {
        email_warn.innerHTML = "";
        unsuscribe_request(user_mail);
    }
    else {
        email_warn.innerHTML = "Invalid Email !";
    }
}