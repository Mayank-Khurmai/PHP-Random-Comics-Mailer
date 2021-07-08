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
            table.setAttribute("margin", "30px");
            table.setAttribute("border", "1");
            table.setAttribute("cellspacing", "0px");
            table.setAttribute("cellpadding", "10px");

            var tr = document.createElement("tr");
            var th_sr = document.createElement("th");
            th_sr.innerHTML = "Sr.";
            tr.append(th_sr);

            var th_id = document.createElement("th");
            th_id.innerHTML = "User Id";
            tr.append(th_id);

            var th_email = document.createElement("th");
            th_email.innerHTML = "EMAIL";
            tr.append(th_email);

            var th_total = document.createElement("th");
            th_total.innerHTML = "Count";
            tr.append(th_total);

            var th_status = document.createElement("th");
            th_status.innerHTML = "Status";
            tr.append(th_status);

            table.append(tr);

            for (var i = 0; i < data.length; i++) {
                var tr = document.createElement("tr");
                var th_sr = document.createElement("td");
                th_sr.innerHTML = i + 1;
                tr.append(th_sr);

                var th_id = document.createElement("td");
                th_id.innerHTML = data[i].id;
                tr.append(th_id);

                var th_email = document.createElement("td");
                th_email.innerHTML = data[i].email;
                tr.append(th_email);

                var th_total = document.createElement("td");
                th_total.innerHTML = data[i].count;
                tr.append(th_total);

                var th_status = document.createElement("td");
                if (data[i].otp == 0) {
                    th_status.innerHTML = "Unsubscribed";
                }
                else if (data[i].otp == 1) {
                    th_status.innerHTML = "Subscribed";
                }
                else {
                    th_status.innerHTML = "Un-verified";
                }
                tr.append(th_status);
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
            table.setAttribute("margin", "30px");
            table.setAttribute("border", "1");
            table.setAttribute("cellspacing", "0px");
            table.setAttribute("cellpadding", "10px");

            var tr = document.createElement("tr");
            var th_sr = document.createElement("th");
            th_sr.innerHTML = "Sr.";
            tr.append(th_sr);

            var th_id = document.createElement("th");
            th_id.innerHTML = "User Id";
            tr.append(th_id);

            var th_email = document.createElement("th");
            th_email.innerHTML = "EMAIL";
            tr.append(th_email);

            var th_total = document.createElement("th");
            th_total.innerHTML = "Count";
            tr.append(th_total);

            var th_status = document.createElement("th");
            th_status.innerHTML = "Status";
            tr.append(th_status);

            var th_action = document.createElement("th");
            th_action.innerHTML = "Action";
            tr.append(th_action);

            table.append(tr);

            for (var i = 0; i < data.length; i++) {
                var tr = document.createElement("tr");
                var th_sr = document.createElement("td");
                th_sr.innerHTML = i + 1;
                tr.append(th_sr);

                var th_id = document.createElement("td");
                th_id.innerHTML = data[i].id;
                tr.append(th_id);

                var th_email = document.createElement("td");
                th_email.innerHTML = data[i].email;
                tr.append(th_email);

                var th_total = document.createElement("td");
                th_total.innerHTML = data[i].count;
                tr.append(th_total);

                var th_status = document.createElement("td");
                if (data[i].otp == 0) {
                    th_status.innerHTML = "Unsubscribed";
                }
                else if (data[i].otp == 1) {
                    th_status.innerHTML = "Subscribed";
                }
                else {
                    th_status.innerHTML = "Un-verified";
                }
                tr.append(th_status);

                var th_action = document.createElement("td");
                th_action.innerHTML = "<span class='link' onclick='admin_remove_user(" + data[i].id + ")'>Remove</span>";
                tr.append(th_action);
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
            table.setAttribute("margin", "30px");
            table.setAttribute("border", "1");
            table.setAttribute("cellspacing", "0px");
            table.setAttribute("cellpadding", "10px");

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

            var th_total = document.createElement("th");
            th_total.innerHTML = "Count";
            tr.append(th_total);

            var th_status = document.createElement("th");
            th_status.innerHTML = "Status";
            tr.append(th_status);


            var th_edit = document.createElement("th");
            th_edit.innerHTML = "Action";
            tr.append(th_edit);

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
                th_email.setAttribute("edit_email_id",data[i].id);
                tr.append(th_email);

                var th_total = document.createElement("td");
                th_total.innerHTML = data[i].count;
                th_total.setAttribute("edit_count_id",data[i].id);
                tr.append(th_total);

                var th_status = document.createElement("td");
                if (data[i].otp == 0) {
                    th_status.innerHTML = "Unsubscribed";
                }
                else if (data[i].otp == 1) {
                    th_status.innerHTML = "Subscribed";
                }
                else {
                    th_status.innerHTML = "Un-verified";
                }
                th_status.setAttribute("edit_status_id",data[i].id);
                tr.append(th_status);

                var th_edit = document.createElement("td");
                th_edit.innerHTML = "<span class='link' user_edit_id='" + data[i].id + "' onclick='admin_edit_details(" + data[i].id + ")'>Edit</span>";;
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
                    }, 2500);
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

function admin_remove_user(id) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./admin-remove-user.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText.trim() == "Success") {
                nav_selection_remove();
            }
            else {
                nav_selection_remove();
            }
        }
    }
    xhttp.send("id=" + id);
}

nav_selection_edit();

function admin_edit_details(id){
    var action = document.querySelector("[user_edit_id='"+id+"']");
    if(action.innerHTML.trim()=="Edit"){
        action.innerHTML="Save";
        action.style.color = "green";

        var edit_email = document.querySelector("[edit_email_id='"+id+"']");
        var edit_count = document.querySelector("[edit_count_id='"+id+"']");
        var edit_status = document.querySelector("[edit_status_id='"+id+"']");

        edit_email.style.border = "2px solid red";
        edit_count.style.border = "2px solid red";
        edit_status.style.border = "2px solid red";

        edit_email.setAttribute("contenteditable",true);
        edit_count.setAttribute("contenteditable",true);
        edit_status.setAttribute("contenteditable",true);
    }




    console.log(edit_email.innerHTML + edit_count.innerHTML + edit_status.innerHTML);
}