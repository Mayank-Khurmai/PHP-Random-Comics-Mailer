# php-starter

This is a Github [template repo](https://help.github.com/en/github/creating-cloning-and-archiving-repositories/creating-a-template-repository) with just a readme file that you are reading right now and a magical `.github` folder which contains [Github Actions](https://github.com/features/actions) that automatically check your PHP codes against some common mistakes.

This starter repo does NOT check complete [WordPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/). For that you can try [wp-starter](https://github.com/rtlearn/wp-starter).

As you are here, you are most likely a student who is working on a PHP programming challenge as part of [rtCamp's Campus hiring](https://learn.rtcamp.com/campus/).

In that case you must (generate a Github Classroom Private Repo using this special link)(https://classroom.github.com/a/EX2nMnPK).

You can find details about assignment here — https://learn.rtcamp.com/campus/php-assignments/

## ⚠️ Important Guidelines ⚠️

Please read following carefully. If you miss any of below, rtCamp won't be able evalaute your assignment further.

### 1. README.md file

If you are reading this line in [your private repo](https://classroom.github.com/a/EX2nMnPK), then please replace content of this README.md file with your project details. If you do not do this, your submission will NOT be considered.

### 2. `.github` folder

Please Do NOT delete `.github` folder. The folder has codes that starts automated code review.
One way to ensure that you do not delete this folder accidentally is to avoid `git push --force`.

### 3. `phpcs.xml` file

Please Do NOT delete `.phpcs.xml` file. The file tells automated system to do less stringent review of your code. If you delete that file, the automated system will do in-depth code review.

### 4. `feedback` branch

Please do NOT delete `feedback`branch. The codes in `.github` folder works on `feedback` git branch.

### 5. Pull Requests

Please do NOT merge any pull request on your repo. Pull-requests are automatically created to provide you inline feedback during code-review.

### 6. Live Demo Link

Each PHP web-development assignment requires a live demo. Please use [your private Github repo's](https://classroom.github.com/a/EX2nMnPK). website field to specify your live demo URL.
Also, include the same live demo URL in your Readme.md content.

### 7. Watch out for common mistakes

Please check the entire section added below to avoid common mistakes. They are serious and lead to rejection.

### 8. Readme.md reminder

After you are done reading this, please replace content of this README.md with your project details.

## Common Mistakes / PHP Errors

* Beware of SQL injection vulnerabilities. See [BobbyTables.com](https://bobby-tables.com/) and [BobbyTables.com/php](https://bobby-tables.com/php). (Sanitize input.) See `filter_input()` or MySQL sanitize strings or `prepare()` & `bind()` values.
* Beware of Cross-Site-Scripting vulnerabilities (XSS). (Escape output and validate input). This means don't `echo` or `print` anything that might come from `$_POST` or `$_GET` (user input) without first stripping tags or sanitizing the value.
* Validate any email subscribe and unsubscribe actions with a verification token.
* Any Cron scripts or SQL dumps should be stored in non-public directories (outside of web root).
* Don't commit database credentials to the repository. Use examples. Use a configuration file for common / repeating settings such as DB credentials, email credentials, or "From" addresses.
* Use `__DIR__`, `basename()`, or both when using `require` or `include`. Starting from current directory scans all folders in `include_path`.
* `require` and `include` are language constructs, not functions. Don't use parenthesis.
* Use single-quotes if not parsing variables in strings in PHP.

## Screenshots

Github repos' website field to enter your live demo URL.

![rtlearn_php-starter__Starter_repo_for_PHP_assignments](https://user-images.githubusercontent.com/4115/118948676-200e0000-b976-11eb-9425-7db122da29e8.jpg)
