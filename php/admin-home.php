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
                <img src="https://avatars.githubusercontent.com/u/65281650?s=200&v=4" height="120px">
            </div>
            <hr width="70%">
            <div>
                <ul id="side-menu-nav-ul">
                    <li class="active" onclick="nav_selection_dashboard()"><img src="https://img.icons8.com/ios-filled/20/000000/dashboard.png"/> Dashboard</li>
                    <li onclick="nav_selection_view()"><img src="https://img.icons8.com/ios-glyphs/20/000000/user.png"/> View Users</li>
                    <li onclick="nav_selection_add()"><img src="https://img.icons8.com/ios-filled/20/000000/add--v1.png"/> Add User</li>
                    <li onclick="nav_selection_remove()"><img src="https://img.icons8.com/ios-glyphs/20/000000/minus.png"/> Remove User</li>
                    <li onclick="nav_selection_edit()"><img src="https://img.icons8.com/material-sharp/20/000000/edit--v1.png"/> Edit User</li>
                    <li onclick="nav_selection_logout()"><img src="https://img.icons8.com/ios-filled/20/000000/logout-rounded-up.png"/> Logout</li>
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

                <div class="dashboard-top">
                    <div class="dashboard-top-box-1">
                        <img src="https://img.icons8.com/office/100/000000/secured-letter--v4.png" />
                        <div>Total Mail Sent</div>
                        <div class="dashboard-top-title">2800</div>
                    </div>
                    <div class="dashboard-top-box-2">
                        <img src="https://img.icons8.com/dusk/100/000000/conference.png" />
                        <div>Total Registered Users</div>
                        <div class="dashboard-top-title">1540</div>
                    </div>
                    <div class="dashboard-top-box-3">
                        <img src="https://img.icons8.com/dusk/100/000000/reading-ebook.png" />
                        <div>Total Active Users</div>
                        <div class="dashboard-top-title">1245</div>
                    </div>
                </div>

                <div class="dashboard-table">
                    <div>
                    <fieldset class="fieldset-50">
                            <legend>Top Users</legend>
                            <table border='1px solid black' cellspacing='0px' cellpadding='10px' width='100%'>
                                <tr>
                                    <th class="text-center">Sr.</th>
                                    <th>Email</th>
                                    <th class="text-center">Total</th>
                                </tr>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>mayankkhuirmai8@gmail.com</td>
                                    <td class="text-center">25</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>tehnicalkhurmai8@gmail.com</td>
                                    <td class="text-center">55</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>mayankkhuirmai8@gmail.com</td>
                                    <td class="text-center">45</td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>tehnicalkhurmai8@gmail.com</td>
                                    <td class="text-center">34</td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>mayankkhuirmai8@gmail.com</td>
                                    <td class="text-center">14</td>
                                </tr>
                            </table>
                        </fieldset>
                    </div>

                    <div>
                        <fieldset class="fieldset-50">
                            <legend>Recently Added Users</legend>
                            <table border='1px solid black' cellspacing='0px' cellpadding='10px' width='100%'>
                                <tr>
                                    <th class="text-center">Sr.</th>
                                    <th>Email</th>
                                    <th class="text-center">Total</th>
                                </tr>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>mayankkhuirmai8@gmail.com</td>
                                    <td class="text-center">25</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>tehnicalkhurmai8@gmail.com</td>
                                    <td class="text-center">55</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>mayankkhuirmai8@gmail.com</td>
                                    <td class="text-center">45</td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>tehnicalkhurmai8@gmail.com</td>
                                    <td class="text-center">34</td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>mayankkhuirmai8@gmail.com</td>
                                    <td class="text-center">14</td>
                                </tr>
                            </table>
                        </fieldset>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <script src="../script/admin-home.js"></script>

</body>

</html>