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
    document.getElementById("admin_mail").disabled = true;
    document.getElementById("admin_pass").disabled = true;
    document.getElementById("s-otp-button").value = "Submit";
    document.getElementById("s-otp-button").setAttribute("flag", "flag-2");
    document.getElementById("credential-warn").innerHTML = "";
}


function ajax_send_otp(admin_mail, admin_pass) {
    var s_otp_btn = document.getElementById("s-otp-button");
    var c_warn = document.getElementById("credential-warn");
    s_otp_btn.value = "Sending...";
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./php/validate-admin.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText.trim() == "OTP Sent Successfully"){
                step_two();
            }
            else if(this.responseText.trim() == "Invalid Credentials"){
                s_otp_btn.value = "Send OTP";
                c_warn.innerHTML = "Invalid Credentials !";
            }
            else{
                s_otp_btn.value = "Send OTP";
                c_warn.innerHTML = "Please try Again !";
            }            
        }
    }
    xhttp.send("email="+btoa(admin_mail)+"&pass="+btoa(admin_pass));
}

function verify_otp(admin_mail,admin_pass,otp){
    var s_otp_btn = document.getElementById("s-otp-button");
    var otp_warn = document.getElementById("otp-warn");
    s_otp_btn.value = "Verifying...";
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./php/validate-admin-otp.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText.trim() == "OTP Verified"){
                location.href = "./php/admin-home.php";
            }
            else if(this.responseText.trim() == "OTP Expired"){
                s_otp_btn.value = "Send Again";
                otp_warn.innerHTML = "OTP Expired !";
                s_otp_btn.setAttribute("flag","step-1");
            }
            else if(this.responseText.trim() == "Failed"){
                s_otp_btn.value = "Submit";
                otp_warn.innerHTML = "Invalid OTP !";
            }
            else{
                s_otp_btn.value = "Submit";
                otp_warn.innerHTML = "Please try Again !";
            }           
        }
    }
    xhttp.send("email="+btoa(admin_mail)+"&pass="+btoa(admin_pass)+"&otp="+btoa(otp));
}

function send_otp() {
    var credential_warn = document.getElementById("credential-warn");
    var otp_warn = document.getElementById("otp-warn");
    var admin_mail = document.getElementById("admin_mail").value;
    var admin_pass = document.getElementById("admin_pass").value;
    var otp = document.getElementById("otp").value;
    var s_otp_btn = document.getElementById("s-otp-button");
    otp_warn.innerHTML = "";
    document.getElementById("otp").value ="";
    if (s_otp_btn.getAttribute("flag") == "step-1") {
        if (admin_mail != "" & admin_pass !="" & email_validate(admin_mail)) {
            ajax_send_otp(admin_mail, admin_pass);
        }
        else {
            s_otp_btn.value = "Send OTP";
            credential_warn.innerHTML = "Invalid Credentials !";
        }
    }
    else {
        credential_warn.innerHTML = "";
        if(otp != "" & otp.length==6){
            otp_warn.innerHTML = "";
            verify_otp(admin_mail,admin_pass,otp);
        }
        else {
            s_otp_btn.value = "Submit";
            otp_warn.innerHTML = "Invalid OTP !";
        }        
    }
}