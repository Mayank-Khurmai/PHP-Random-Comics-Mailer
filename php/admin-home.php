<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>XKCD Challenge</title>
    <link rel="icon" href="https://avatars.githubusercontent.com/u/65281650?s=200&v=4" type="image/icon type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/admin-home.css">
</head>

<body>
    <div class="body-container">

        <div id="side-menu-nav">
            <div class="side-menu-logo">
                <img src="https://avatars.githubusercontent.com/u/65281650?s=200&v=4">
            </div>
            <hr width="70%">
            <div>
                <ul id="side-menu-nav-ul">
                    <li class="active" onclick="nav_selection_dashboard()"><img src="https://img.icons8.com/ios-filled/20/000000/dashboard.png"/> <span class="nav-menu-desc">Dashboard</span></li>
                    <li onclick="nav_selection_view()"><img src="https://img.icons8.com/ios-glyphs/20/000000/user.png"/> <span class="nav-menu-desc">View Users</span></li>
                    <li onclick="nav_selection_add()"><img src="https://img.icons8.com/ios-filled/20/000000/add--v1.png"/> <span class="nav-menu-desc">Add User</span></li>
                    <li onclick="nav_selection_remove()"><img src="https://img.icons8.com/ios-glyphs/20/000000/minus.png"/> <span class="nav-menu-desc">Remove User</span></li>
                    <li onclick="nav_selection_edit()"><img src="https://img.icons8.com/material-sharp/20/000000/edit--v1.png"/> <span class="nav-menu-desc">Edit User</span></li>
                    <li onclick="nav_selection_logout()"><img src="https://img.icons8.com/ios-filled/20/000000/logout-rounded-up.png"/> <span class="nav-menu-desc">Logout</span></li>
                </ul>
            </div>
        </div>

        <div id="right-main-div">
            <div id="right-main-div-header">
                <div>
                    Hi, Admin
                </div>
            </div>
            <div id="right-main-output">

            </div>
        </div>
    </div>


    <script src="../script/admin-home.js"></script>

</body>

</html>