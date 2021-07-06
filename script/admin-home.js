function nav_selection(nav_option) {
    if (nav_option == "dashboard") {
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "./admin-view-users.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.onload = function () {
            if (this.readyState == 4 && this.status == 200) {
               console.log(this.responseText);
            }
        }
        xhttp.send();
    }
    else if (nav_option == "view") {
        alert("view");
    }
    else if (nav_option == "add") {
        alert("add");
    }
    else if (nav_option == "remove") {
        alert("remove");
    }
    else if (nav_option == "edit") {
        alert("edit");
    }
    else {
        alert("logout");
    }
}