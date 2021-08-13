# Email a random XKCD challenge

#### This PHP application accepts a visitor’s email address and then verifies the email address with OTP(One Time Password) sent to the visitor's email and after verification random XKCD comics will be sent in every five minutes including the inline image content as well as attachment. User can also Unsubscribe from the email service at any time. Application also contains the Admin Panel to manage all the users in Graphical Interface.


## 🔗 Links to Website

 - Subscribe Page -- http://xkcd.mayankkhurmai.in/subscribe
 - Unsubscribe Page -- http://xkcd.mayankkhurmai.in/unsubscribe
 - Admin Panel Page -- http://xkcd.mayankkhurmai.in/admin
 - Create all Tables -- http://xkcd.mayankkhurmai.in/admin-configure-db



## Snapshots with description

<details>
<summary>Subscription</summary>
<br>
<p align='justify'>User will enter his/her email address and then verify the email address with OTP(One Time Password) which will be sent to the visitor's email id and after verification with the correct OTP success message will be displayed on the screen and welcome message will be sent to the visitor's email id. If in case OTP entered by the user is incorrect then Invalid OTP warning will be displayed on the screen. After the successful verification of email id user will get random XKCD comics in mail indox in every 5 minutes. To unsubscribe user can click on the unsubscribe button in mail.</p>
<pre>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/subscribe/subscribe-1.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/subscribe/subscribe-2.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/subscribe/subscribe-3.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/subscribe/subscribe-4.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/subscribe/subscribe-5.png)
</pre>

---
</details>


<details>
<summary>Un-subscribe</summary>
<br>
<p align='justify'>User will enter his/her email address and if the email address is not a subscribed email id then Email not found error will be displayed. If the email entered is a subscribed email id, then user will get unsubscribed message on the screen and also an email message to unsubscribe. To subscribe again, user can click on the Subscribe again button link in the email message.</p>
<pre>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/unsubscribe/unsubscribe-1.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/unsubscribe/unsubscribe-2.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/unsubscribe/unsubscribe-3.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/unsubscribe/unsubscribe-4.png)
</pre>

---
</details>


<details>
<summary>Admin Panel</summary>
<br>
<p align='justify'>Admin will have to enter the email id and password to login into admin panel. If the email or password is incorrect, then Invalid Credential error message will get displayed. If the email and password is correct, then email containing the OTP(One Time Password) and link will sent to the admin email. OTP and link will be valid only upto 2 minutes and after that they both will expire. If the OTP entered by the admin is incorrect then Invalid OTP error message will be displayed and if OTP entered is correct then user will be redirected to the Admin Home Page and login session will be created for the admin. If the admin will click on the login thorough link, then if link is not expired it will get redirected to the Admin Home Page otherwise after expire it will redirect the admin to the Admin Login Page.</p>
<p align='justify'>
[<b>Note : </b>Very first admin entry by entering email and password after fresh creation of admin table will be considered as default Admin email and password and then for future login only one and same email and password will be used]
</p>
[<b>Note : </b>For Assignment testing purpose for mentors, I have formatted the admin table and created a fresh table by running the PHP script]
</p>

<p align='justify'>On Admin home page, total mails sent by the server, total registered users and total active user(subscribed users) will get display, below that all the top 5 users who have received maximum mails will be listed in order and in next table all the last 5 recently added users will get listed.</p>

<p align='justify'>On the View users tab, admin can view all the users with their status as Un-verified(OTP sent but not verified), Subscribed or Unsubscribed status.</p>

<p align='justify'>In the Add User tab, admin can add any email id and by default status for that email will be added as a verified/subscribed email. If the email already exists then Email Already exists message will get displayed.</p>

<p align='justify'>In the Remove user tab, admin can remove the user in one click</p>

<p align='justify'>In the Edit Details tab, admin can change any user email, total mail sent count as well as status, if any field is empty or does not meet the requirement of valid data, then red color border will be active which indicates the error in particular input field. Drop down will appear if admin wants to change the status of any user. On clicking on save button all the details of that particular user will get updated.</p>

<p align='justify'>In the Change Password tab, admin has to enter his/her current password, new password and confirm new password, if the current password entry will match with the existing current password then password will get updated otherwise error message will get displayed on the screen.</p>

<p align='justify'>On clicking the logout tab button, admin will get logged out and all the sessions will get destroyed and admin will redirected to the Admin login page</p>

<p align='justify'>If the size of the screen will reduce then tab content will be hidden and only the tab icons will be visible.</p>
<pre>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/admin/admin-1.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/admin/admin-2.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/admin/admin-3.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/admin/admin-4.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/admin/admin-5.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/admin/admin-12.PNG)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/admin/admin-6.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/admin/admin-7.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/admin/admin-8.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/admin/admin-9.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/admin/admin-10.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/admin/admin-11.png)
</pre>

---
</details>


<details>
<summary>Random XKCD comics</summary>
<br>
<p align='justify'>Every verified/subscribed user will get random XKCD comics on his/her email id in every 5 minutes, email will contain an attachment along with the inline image as well as comic content. To fetch the comic data, https://c.xkcd.com/random/comic is used programmatically to return a random comic URL which then further sanitize and then use to get all data for content.</p>
<pre>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/cron/cron-1.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/cron/cron-2.png)
</pre>

---
</details>


<details>
<summary>Database</summary>
<br>
<p align='justify'>By running the table configuration PHP script, both the tables for user and admin with their key constraints will be created automatically. If the table is created successfully then table create message will show otherwise if table is already created then table already created message will be shown and the prerequiste to run this command is that database should exist otherwise script will show the Database connection error.</p>
<pre>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/db/db-1.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/db/db-2.png)
<br>

![App Screenshot](https://github.com/rtlearn/php-Mayank-Khurmai/blob/master/snapshots/db/db-3.png)
</pre>

---
</details>




## Tech Stack

**Frontend Language :** HTML, CSS, JavaScript

**Backend Language :** PHP

**Server :** Apache 

**Hosted On :** AWS Ubuntu Server 20.04

**Programming Style :** Object Oriented Programming Style for Backend

**Mailing Service :** PHP mail() function with help of sendmail integrated with Amazon SES 

  


## Having any Issue???

If you face any problem then please either raise an issue in this repository or drop a mail at mayankkhurmai8@gmail.com