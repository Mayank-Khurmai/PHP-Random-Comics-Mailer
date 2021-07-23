function admin_total_mails_users_active() {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./admin-total-mails-users-active.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);

            var dashboard_top_div = document.createElement("div");
            dashboard_top_div.setAttribute("class", "dashboard-top-div");

            var div_in1 = document.createElement("div");
            div_in1.setAttribute("class", "dashboard-top-box-1 dashboard-top-3");
            var div_in_img = document.createElement("img");
            div_in_img.setAttribute("src", "https://img.icons8.com/office/100/000000/secured-letter--v4.png");
            div_in1.append(div_in_img);
            var div_in_div = document.createElement("div");
            div_in_div.innerHTML = "Total Mails Sent";
            div_in1.append(div_in_div);
            var div_in_div = document.createElement("div");
            div_in_div.setAttribute("class", "dashboard-top-title");
            div_in_div.innerHTML = data[0].sum;
            div_in1.append(div_in_div);
            div_in1.style.float = "left";
            dashboard_top_div.append(div_in1);

            var div_in2 = document.createElement("div");
            div_in2.setAttribute("class", "dashboard-top-box-2 dashboard-top-3");
            var div_in_img = document.createElement("img");
            div_in_img.setAttribute("src", "https://img.icons8.com/dusk/100/000000/conference.png");
            div_in2.append(div_in_img);
            var div_in_div = document.createElement("div");
            div_in_div.innerHTML = "Total Registered Users";
            div_in2.append(div_in_div);
            var div_in_div = document.createElement("div");
            div_in_div.setAttribute("class", "dashboard-top-title");
            div_in_div.innerHTML = data[0].count;
            div_in2.append(div_in_div);
            div_in2.style.float = "left";
            dashboard_top_div.append(div_in2);

            var div_in3 = document.createElement("div");
            div_in3.setAttribute("class", "dashboard-top-box-3 dashboard-top-3");
            var div_in_img = document.createElement("img");
            div_in_img.setAttribute("src", "https://img.icons8.com/dusk/100/000000/reading-ebook.png");
            div_in3.append(div_in_img);
            var div_in_div = document.createElement("div");
            div_in_div.innerHTML = "Total Active Users";
            div_in3.append(div_in_div);
            var div_in_div = document.createElement("div");
            div_in_div.setAttribute("class", "dashboard-top-title");
            div_in_div.innerHTML = data[1].active;
            div_in3.append(div_in_div);
            div_in3.style.float = "left";
            dashboard_top_div.append(div_in3);

            var output_area = document.getElementById("right-main-output");
            output_area.append(dashboard_top_div);

            admin_top_recently_users();
        }
    }
    xhttp.send();
}

function admin_top_recently_users() {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./admin-top-recently-users.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var output_area = document.getElementById("right-main-output");
            var dash_table_div = document.createElement("div");
            var d_array = [
                { "legend": "Top Users", "th": "Total" },
                { "legend": "Recently Added Users", "th": "Date" }
            ];

            for (var i = 0; i < data.length; i++) {
                var dash_table_div_in = document.createElement("div");
                dash_table_div_in.setAttribute("class", "dash_table_div_in");
                var fieldset = document.createElement("fieldset");
                fieldset.setAttribute("class", "fieldset-50");

                var legend = document.createElement("legend");
                legend.innerHTML = d_array[i].legend;
                fieldset.append(legend);

                var table = document.createElement("table");
                table.setAttribute("border", "1px solid black");
                table.setAttribute("cellspacing", "0px");
                table.setAttribute("cellpadding", "10px");
                table.setAttribute("width", "100%");

                var tr = document.createElement("tr");
                var th_sr = document.createElement("th");
                th_sr.setAttribute("class", "text-center");
                th_sr.innerHTML = "Sr.";
                tr.append(th_sr);

                var th_email = document.createElement("th");
                th_email.innerHTML = "Email";
                tr.append(th_email);

                var th_total = document.createElement("th");
                th_total.setAttribute("class", "text-center");
                th_total.innerHTML = d_array[i].th;
                tr.append(th_total);
                table.append(tr);

                for (var j = 0; j < data[0].length; j++) {
                    var tr = document.createElement("tr");
                    var th_sr = document.createElement("th");
                    th_sr.setAttribute("class", "text-center");
                    th_sr.innerHTML = j + 1;
                    tr.append(th_sr);

                    var td_email = document.createElement("td");
                    td_email.innerHTML = data[i][j].email;
                    tr.append(td_email);

                    var th_total = document.createElement("td");
                    th_total.setAttribute("class", "text-center");
                    var temp;
                    if (i == 0) { temp = data[i][j].count }
                    else { temp = data[i][j].date }
                    th_total.innerHTML = temp;
                    tr.append(th_total);
                    table.append(tr);
                }


                fieldset.append(table);
                dash_table_div_in.append(fieldset);
                dash_table_div.append(dash_table_div_in);
            }

            dash_table_div.setAttribute("class", "dashboard-table");
            dash_table_div.style.float = "left";
            output_area.append(dash_table_div);
        }
    }
    xhttp.send();
}

function nav_selection_dashboard() {
    document.querySelector(".sm-li").removeAttribute("class");
    document.querySelector("#sm-li-1").setAttribute("class", "sm-li active");
    document.getElementById("right-main-output").innerHTML = "";
    admin_total_mails_users_active();
}


window.onload = function () {
    nav_selection_dashboard();
};

function nav_selection_view(e) {
    document.querySelector(".sm-li").removeAttribute("class");
    document.querySelector("#sm-li-2").setAttribute("class", "sm-li active");

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
                var th_sr = document.createElement("th");
                th_sr.innerHTML = i + 1;
                tr.append(th_sr);

                var th_id = document.createElement("td");
                th_id.innerHTML = data[i].id;
                th_id.setAttribute("class", "text-center");
                tr.append(th_id);

                var th_email = document.createElement("td");
                th_email.innerHTML = data[i].email;
                tr.append(th_email);

                var th_total = document.createElement("td");
                th_total.innerHTML = data[i].count;
                th_total.setAttribute("class", "text-center");
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
    document.querySelector(".sm-li").removeAttribute("class");
    document.querySelector("#sm-li-3").setAttribute("class", "sm-li active");
    document.getElementById("right-main-output").innerHTML = `
        <fieldset>
        <legend>Add User Manually</legend>
        <input type='email' id='user-email-input' style='width:50%; padding:10px' placeholder='Enter user Email'>
        <br>
        <label id="admin-add-user-warn"></label>
        <br><br>
        <input type='button' value='Add User' id='admin-add-user-btn' onclick='admin_add_user()'>
        </fieldset>
    `;
}


function nav_selection_remove() {
    document.querySelector(".sm-li").removeAttribute("class");
    document.querySelector("#sm-li-4").setAttribute("class", "sm-li active");
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
                var th_sr = document.createElement("th");
                th_sr.innerHTML = i + 1;
                tr.append(th_sr);

                var th_id = document.createElement("td");
                th_id.innerHTML = data[i].id;
                th_id.setAttribute("class", "text-center");
                tr.append(th_id);

                var th_email = document.createElement("td");
                th_email.innerHTML = data[i].email;
                tr.append(th_email);

                var th_total = document.createElement("td");
                th_total.innerHTML = data[i].count;
                th_total.setAttribute("class", "text-center");
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
                th_action.setAttribute("class", "text-center");
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
    document.querySelector(".sm-li").removeAttribute("class");
    document.querySelector("#sm-li-5").setAttribute("class", "sm-li active");
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
                var th_sr = document.createElement("th");
                th_sr.innerHTML = i + 1;
                tr.append(th_sr);

                var th_id = document.createElement("td");
                th_id.innerHTML = data[i].id;
                th_id.setAttribute("class", "text-center");
                tr.append(th_id);

                var th_email = document.createElement("td");
                th_email.innerHTML = data[i].email;
                th_email.setAttribute("edit_email_id", data[i].id);
                tr.append(th_email);

                var th_total = document.createElement("td");
                th_total.innerHTML = data[i].count;
                th_total.setAttribute("edit_count_id", data[i].id);
                th_total.setAttribute("class", "text-center");
                tr.append(th_total);

                var th_status = document.createElement("td");
                if (data[i].otp == 0) {
                    th_status.innerHTML = "Unsubscribed";
                    th_status.setAttribute("edit_status", "Unsubscribed");
                }
                else if (data[i].otp == 1) {
                    th_status.innerHTML = "Subscribed";
                    th_status.setAttribute("edit_status", "Subscribed");
                }
                else {
                    th_status.innerHTML = "Un-verified";
                    th_status.setAttribute("edit_status", "Un-verified");
                }
                th_status.setAttribute("edit_status_id", data[i].id);
                tr.append(th_status);

                var th_edit = document.createElement("td");
                th_edit.innerHTML = "<span class='link' user_edit_id='" + data[i].id + "' onclick='admin_edit_details(" + data[i].id + ")'>Edit</span>";
                th_edit.setAttribute("class", "text-center");
                tr.append(th_edit);

                table.append(tr);
            }
            fieldset.append(table);
            output_area.append(fieldset);

        }
    }
    xhttp.send();
}


function nav_selection_pass(){
    document.querySelector(".sm-li").removeAttribute("class");
    document.querySelector("#sm-li-6").setAttribute("class", "sm-li active");
    document.getElementById("right-main-output").innerHTML = `
        <fieldset>
        <legend>Change Password</legend>
        <br>
        <input type='password' id='admin-c-pass' style='width:50%; padding:10px' placeholder='Current Password'>
        <br><br><hr width='50%' align='left'><br>
        <input type='password' id='admin-n1-pass' style='width:50%; padding:10px' placeholder='New Password'>
        <br><br>
        <input type='password' id='admin-n2-pass' style='width:50%; padding:10px' placeholder='Confirm Password'>
        <br>
        <span id="admin-pass-warn"></span>
        <br><br>
        <input type='button' value='Change Password' id='admin-change-pass-btn' onclick='admin_change_pass()'>
        </fieldset>
    `;
}


function nav_selection_logout() {
    document.querySelector(".sm-li").removeAttribute("class");
    document.querySelector("#sm-li-7").setAttribute("class", "sm-li active");
    document.getElementById("right-main-output").innerHTML = "Logging you out......";
    location.href = "./admin-logout.php";
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


function admin_change_pass(){
    var pass_warn = document.getElementById("admin-pass-warn");
    var c_pass = document.getElementById("admin-c-pass").value;
    var n1_pass = document.getElementById("admin-n1-pass").value;
    var n2_pass = document.getElementById("admin-n2-pass").value;
    var c_pass_btn = document.getElementById("admin-change-pass-btn");
    if(c_pass!="" & n1_pass!="" & n2_pass!=""){
        if(n1_pass!=n2_pass){
            pass_warn.innerHTML = "Password do not Match !";
        }
        else{
            pass_warn.innerHTML="";
            c_pass_btn.value="Changing...";
            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "./admin-update-pass.php", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.onload = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText.trim() == "Password Changed") {
                        c_pass_btn.value="Password Updated";
                        setTimeout(
                            () => {
                                nav_selection_pass();
                            }, 2500);
                    }
                    else if (this.responseText.trim() == "Incorrect Password") {
                        c_pass_btn.value="Change Password";
                        pass_warn.innerHTML="Incorrect Password !";
                    }
                    else {
                        pass_warn.innerHTML = "Please try Again !";
                        c_pass_btn.value="Change Password";
                    }    
                }
            }
            xhttp.send("cpass=" + btoa(c_pass) + "&npass=" + btoa(n1_pass));
        }
    }
    else{
        pass_warn.innerHTML="Cannot be Empty !";
    }
}


function admin_edit_details(id) {
    var action = document.querySelector("[user_edit_id='" + id + "']");
    var edit_email = document.querySelector("[edit_email_id='" + id + "']");
    var edit_count = document.querySelector("[edit_count_id='" + id + "']");
    var edit_status = document.querySelector("[edit_status_id='" + id + "']");

    if (action.innerHTML.trim() == "Edit") {
        action.innerHTML = "Save";
        action.style.color = "green";

        edit_email.style.border = "2px solid red";
        edit_count.style.border = "2px solid red";
        edit_status.style.border = "2px solid red";

        edit_email.setAttribute("contenteditable", true);
        edit_count.setAttribute("contenteditable", true);
        edit_status.setAttribute("contenteditable", true);

        edit_status.style.padding = "0px";
        var select = document.createElement("select");
        select.setAttribute("select_option_status_id", id);
        select.style.width = "100%";
        select.style.height = "100%";
        select.style.margin = "0px";
        select.style.padding = "10px";

        var optgroup = document.createElement("optgroup");
        optgroup.setAttribute("label", "*" + edit_status.getAttribute("edit_status") + "*");
        select.append(optgroup);

        var option_1 = document.createElement("option");
        option_1.innerHTML = "Subscribed";
        option_1.setAttribute("value", 1);
        optgroup.append(option_1);

        var option_2 = document.createElement("option");
        option_2.innerHTML = "Unsubscribed";
        option_2.setAttribute("value", 0);
        optgroup.append(option_2);

        var option_3 = document.createElement("option");
        option_3.innerHTML = "Un-verified";
        option_3.setAttribute("value", Math.floor(100000 + Math.random() * 900000));
        optgroup.append(option_3);

        edit_status.innerHTML = "";
        edit_status.append(select);
    }
    else {
        var flag = 0;
        if (edit_email.innerHTML != "" && email_validate(edit_email.innerHTML)) {
            edit_email.style.border = "2px solid red";
            flag += 1;
        }
        else {
            edit_email.style.border = "2px dashed red";
        }
        if (edit_count.innerHTML != "" && isNaN(parseInt(edit_count.innerHTML)) == false) {
            edit_count.style.border = "2px solid red";
            flag += 1;
        }
        else {
            edit_count.style.border = "2px dashed red";
        }

        if (flag == 2) {
            action.innerHTML = "Wait...";
            var final_status = document.querySelector("[select_option_status_id='" + id + "']");
            final_status = final_status.options[final_status.selectedIndex];

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "./admin-update-user-details.php", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.onload = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText.trim() == "Success") {
                        action.innerHTML = "Success";
                        edit_status.style.padding = "";
                        edit_status.innerHTML = final_status.innerHTML;
                        edit_status.setAttribute("edit_status", final_status.innerHTML);

                        edit_email.style.border = "";
                        edit_count.style.border = "";
                        edit_status.style.border = "";

                        edit_email.setAttribute("contenteditable", false);
                        edit_count.setAttribute("contenteditable", false);
                        edit_status.setAttribute("contenteditable", false);

                        setTimeout(
                            () => {
                                action.innerHTML = "Edit";
                                action.style.color = "red";
                            }, 2000);
                    }
                    else {
                        action.innerHTML = "Failed";
                        setTimeout(
                            () => {
                                action.innerHTML = "Save";
                            }, 2000);
                    }
                }
            }
            xhttp.send("id=" + id + "&email=" + edit_email.innerHTML + "&count=" + edit_count.innerHTML + "&status=" + final_status.value);
        }
    }
}