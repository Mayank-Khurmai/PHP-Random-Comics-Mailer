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
            x = JSON.parse(this.responseText);
            console.log(x);
            var output_area = document.getElementById("right-main-output");

            var table_data;
            for(var i=0;i<x.length;i++){
                table_data += `
                    <tr>
                        <td class="text-center">`+ x[i].id +`</td>
                        <td>`+ x[i].email +`</td>
                        <td class="text-center">`+ x[i].count +`</td>
                    </tr>
                `;
            }
            output_area.innerHTML = `
                <fieldset>
                <legend>Top Users</legend>
                <table border='1px solid black' cellspacing='0px' cellpadding='10px' width='100%'>
                    <tr>
                        <th class="text-center">Sr.</th>
                        <th>Email</th>
                        <th class="text-center">Total</th>
                    </tr>
                   `+ 
                    table_data
                   +`
                </table>
                </fieldset>
            `;
            
        }
    }
    xhttp.send();
}


function nav_selection_add(){
    document.getElementById("right-main-output").innerHTML = `
        <fieldset>
        <legend>Add User Manually</legend>
        <input type='email' id='add-email' style='width:100%; padding:10px'>
        <br><br>
        <input type='button' value='Add User'>
        </fieldset>
    `;
}