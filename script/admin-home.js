function nav_selection_dashboard() {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./admin-view-dashboard.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    }
    xhttp.send();
}


function nav_selection_view() {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./admin-view-users.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var output_area = document.getElementById("right-main-output");
            output_area.innerHTML = "";
            var fieldset = document.createElement("fieldset");
            var legend = document.createElement("legend");
            legend.innerHTML = "All Users";
            fieldset.append(legend);

            var table = document.createElement("table");
            table.setAttribute("width", "100%");
            table.setAttribute("margin","30px");
            table.setAttribute("border", "1");
            table.setAttribute("cellspacing", "0px");
            table.setAttribute("cellpadding","10px");

            var tr = document.createElement("tr");
            var th_sr = document.createElement("th");
            th_sr.innerHTML = "Serial";
            tr.append(th_sr);

            var th_id = document.createElement("th");
            th_id.innerHTML = "User Id";
            tr.append(th_id);

            var th_email = document.createElement("th");
            th_email.innerHTML = "EMAIL";
            tr.append(th_email);

            var th_status = document.createElement("th");
            th_status.innerHTML = "Status";
            tr.append(th_status);

            var th_total = document.createElement("th");
            th_total.innerHTML = "Count";
            tr.append(th_total);

            table.append(tr);

            for (var i = 0; i < data.length; i++) {
                var tr = document.createElement("tr");
                var th_sr = document.createElement("td");
                th_sr.innerHTML = i+1;
                tr.append(th_sr);

                var th_id = document.createElement("td");
                th_id.innerHTML = data[i].id;
                tr.append(th_id);

                var th_email = document.createElement("td");
                th_email.innerHTML = data[i].email;
                tr.append(th_email);

                var th_status = document.createElement("td");
                if(data[i].otp==0){
                    th_status.innerHTML = "Unsubscribed";
                }
                else if(data[i].otp==1){
                    th_status.innerHTML = "Subscribed";
                }
                else{
                    th_status.innerHTML = "Un-verified";
                }
                tr.append(th_status);

                var th_total = document.createElement("td");
                th_total.innerHTML = data[i].count;
                tr.append(th_total);
                table.append(tr);
            }
            fieldset.append(table);
            output_area.append(fieldset);

        }
    }
    xhttp.send();
}


function nav_selection_add() {
    document.getElementById("right-main-output").innerHTML = `
        <fieldset>
        <legend>Add User Manually</legend>
        <input type='email' id='user-email-input' style='width:50%; padding:10px'>
        <br>
        <label id="admin-add-user-warn"></label>
        <br><br>
        <input type='button' value='Add User' id='admin-add-user-btn' onclick='admin_add_user()'>
        </fieldset>
    `;
}


function nav_selection_remove() {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./admin-view-users.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var output_area = document.getElementById("right-main-output");
            output_area.innerHTML = "";
            var fieldset = document.createElement("fieldset");
            var legend = document.createElement("legend");
            legend.innerHTML = "All Users";
            fieldset.append(legend);

            var table = document.createElement("table");
            table.setAttribute("width", "100%");
            table.setAttribute("margin","30px");
            table.setAttribute("border", "1");
            table.setAttribute("cellspacing", "0px");
            table.setAttribute("cellpadding","10px");

            var tr = document.createElement("tr");
            var th_sr = document.createElement("th");
            th_sr.innerHTML = "Serial";
            tr.append(th_sr);

            var th_email = document.createElement("th");
            th_email.innerHTML = "EMAIL";
            tr.append(th_email);

            var th_total = document.createElement("th");
            th_total.innerHTML = "Count";
            tr.append(th_total);

            var th_remove = document.createElement("th");
            th_remove.innerHTML = "Action";
            tr.append(th_remove);

            table.append(tr);

            for (var i = 0; i < data.length; i++) {
                var tr = document.createElement("tr");
                var th_sr = document.createElement("td");
                th_sr.innerHTML = data[i].id;
                tr.append(th_sr);

                var th_email = document.createElement("td");
                th_email.innerHTML = data[i].email;
                tr.append(th_email);

                var th_total = document.createElement("td");
                th_total.innerHTML = data[i].count;
                tr.append(th_total);

                var th_remove = document.createElement("td");
                th_remove.innerHTML = "Remove";
                tr.append(th_remove);

                table.append(tr);
            }
            fieldset.append(table);
            output_area.append(fieldset);

        }
    }
    xhttp.send();
}


function nav_selection_edit() {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./admin-view-users.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var output_area = document.getElementById("right-main-output");
            output_area.innerHTML = "";
            var fieldset = document.createElement("fieldset");
            var legend = document.createElement("legend");
            legend.innerHTML = "All Users";
            fieldset.append(legend);

            var table = document.createElement("table");
            table.setAttribute("width", "100%");
            table.setAttribute("margin","30px");
            table.setAttribute("border", "1");
            table.setAttribute("cellspacing", "0px");
            table.setAttribute("cellpadding","10px");

            var tr = document.createElement("tr");
            var th_sr = document.createElement("th");
            th_sr.innerHTML = "Serial";
            tr.append(th_sr);

            var th_email = document.createElement("th");
            th_email.innerHTML = "EMAIL";
            tr.append(th_email);

            var th_total = document.createElement("th");
            th_total.innerHTML = "Count";
            tr.append(th_total);

            var th_edit = document.createElement("th");
            th_edit.innerHTML = "Action";
            tr.append(th_edit);

            table.append(tr);

            for (var i = 0; i < data.length; i++) {
                var tr = document.createElement("tr");
                var th_sr = document.createElement("td");
                th_sr.innerHTML = data[i].id;
                tr.append(th_sr);

                var th_email = document.createElement("td");
                th_email.innerHTML = data[i].email;
                tr.append(th_email);

                var th_total = document.createElement("td");
                th_total.innerHTML = data[i].count;
                tr.append(th_total);

                var th_edit = document.createElement("td");
                th_edit.innerHTML = "Edit";
                tr.append(th_edit);

                table.append(tr);
            }
            fieldset.append(table);
            output_area.append(fieldset);

        }
    }
    xhttp.send();
}

function nav_selection_logout() {
    alert("Log out");
}


function email_validate(user_mail) {
    const validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (validRegex.test(user_mail)) {
        return true;
    }
    else {
        return false;
    }
}


function add_user_request(user_mail) {
    var add_btn = document.getElementById("admin-add-user-btn");
    var email_warn = document.getElementById("admin-add-user-warn");
    email_warn.innerHTML = "";
    add_btn.value = "Adding...";
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./admin-add-user.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText.trim() == "Email is Already Added") {
                email_warn.innerHTML = "Email is Already Added !";
                add_btn.value = "Add User";
            }
            else if (this.responseText.trim() == "Added Successfully") {
                email_warn.innerHTML = "";
                add_btn.value = "Added";
                setTimeout(
                    () => {
                        nav_selection_add()
                    },4000);
            }
            else if (this.responseText.trim() == "Invalid Email") {
                email_warn.innerHTML = "Invalid Email !";
                add_btn.value = "Add User";
            }
            else {
                email_warn.innerHTML = "Please try Again !";
                add_btn.value = "Add User";
            }
        }
    }
    xhttp.send("email=" + user_mail);
}


function admin_add_user() {
    var email_warn = document.getElementById("admin-add-user-warn");
    var user_mail = document.getElementById("user-email-input").value;
    if (user_mail != "" & email_validate(user_mail)) {
        add_user_request(user_mail);
    }
    else {
        email_warn.innerHTML = "Invalid Email !";
    }
}