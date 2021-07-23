# Email a random XKCD challenge

#### This is simple PHP application that accepts a visitor’s email address and then verify the email address with OTP(One Time Password) send to the visitor's email and after verification random XKCD comics will be send in every five minutes including the inline image content and attachment. User can also Unsubscribe from the email service at any time 


## 🔗 Links to Website

 - Subscribe Page -- http://xkcd.mayankkhurmai.in/subscribe
 - Unsubscribe Page -- http://xkcd.mayankkhurmai.in/unsubscribe
 - Admin Panel Page -- http://xkcd.mayankkhurmai.in/admin
 - Create all Tables -- http://xkcd.mayankkhurmai.in/admin-configure-db



## Snapshots with description

<details>
<summary>Subscription</summary>
<br>
<p align='justify'>User will enter his/her email address and then verify the email address with OTP(One Time Password) which will send to the visitor's email id and after verification with the correct OTP success message will display on the screen and welcome email message will send to the visitor's email id, if in case OTP entered by the user is incorrect then Invalid OTP warning will get display on the screen. After the successful verification of email id user will get random XKCD comics in mail indox in every 5 minutes. To unsubscribe user can click on the unsubscribe button in email.</p>
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
<p align='justify'>User will enter his/her email address if the email address is not a subscribed email id then Email not found error will display, if the email entered is a subscribed email id, then user will get unsubscribed message on the screen and also an email message for the unsubscribe. To subscribe again, user can click on the SUbscribe again button link in the email message for unsubscribe.</p>
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
<p align='justify'>Admin will have to enter the email id and password to login into admin panel. If the email or password is incorrect, then Invalid Credential error message will get displayed. If the email and password is correct, then email containing the OTP(One Time Password) and link will send to the admin email. OTP and link will be valid only upto the 2 minutes and after that they will both expire. If the OTP entered by the admin is incorrect then Invalid OTP error message will get display and if OTP entered is correct then user will redirect to the admin Home Page and login session will create for the admin. If the admin will click on the login thorough link, then if link is not expired it will redirect to the admin home page otherwise after expire it will redirect the admin to the admin login page.</p>
<p align='justify'>
[<b>Note : </b>very first admin entry by entering email and password after fresh creation of admin table will consider as default admin mail and password and then for future login only one and same email and password will be use]
</p>

<p align='justify'>On Admin home page, total mails sent by the server, total registered users and total active user(subscribed users) will get display, below that all the top 5 users who have received maximum mails will be listed in order and in next table all the last 5 recently added users will get listed.</p>

<p align='justify'>On the View users tab, admin can view all the users with their status as Un-verified(OTP sent but not verified), Subsuscribed or Subscribed status.</p>

<p align='justify'>In the Add User tab, admin can add any email id and bydefault status for that email will be as a verified/subscribed email. If the email is already exists then Email Already exists message will get display.</p>

<p align='justify'>In the Remove user tab, admin can remove the user in one click</p>

<p align='justify'>In the Edit Details tab, admin can change the any user email, total mail sent as well as status, if any field is empty or does not meet the requirement of valid data, then red color border will active which indicates the error in particular input field. Drop down will appear if user want to change the status of any user. on clicking on save button all the details of that particular user will get update.</p>

<p align='justify'>In the Change Password tab, admin have to enter his/her current password, new password and confirm new password, if the current password entry will match with the existing current password then password will get update otherwise error message will get display on the screen.</p>

<p align='justify'>On click on the logout tab button, admin will get logout and all the sessions will get destroy and admin will redirect to the admin login page</p>

<p align='justify'>If the size of the screen will reduce then tab content will get hide and only tab icon will show</p>
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
<p align='justify'>Every verified/subscribed user will get random XKCD comics on his/her email id in every 5 minutes, email will conduct an attachment along with the inline image as well as comic content. To fetch the comic data, https://c.xkcd.com/random/comic is used programmatically to return a random comic URL which then further sanitize and then use to get all data for content</p>
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
<p align='justify'>By running the table configuration php script, both the tables for user and admin with their key constraints will create automatically if the table is created successfully then table create message will show otherwise if table is alredy created then table already created message will be shown and prerequiste to run this command is that database should exists otherwise script will show the Database connection error</p>
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

**Mailing Service :** PHP mail() function with help of sendmail integrated with Amazon SES 

  


## Having any Issue???

If you face any problem then please either raise an issue in this repository or send me an email at mayankkhurmai8@gmail.com