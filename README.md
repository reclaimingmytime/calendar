# calendar
A basic PHP script that embeds a page based on the current calendar week.

The script has been kept extremely simple by design.

## Functionality

More specifically, the script creates an iframe in the following format:

`[$baseURL][WEEKNO][$suffixURL]`, e.g. `https://www.example.com/01/calendar.htm`

By the default, the script points to the *current* calendar week. The user can navigate to the next or previous week, or go back to the current week.

The links "Previous Week", "Current Week" or "Next Week" are disabled dynamically. For example, if you are on week one, you cannot go back a week, so the link "Previous Week" is disabled.

### Input validation
The script trusts that the variables in the configuration file are defined and valid. Configuration files are *not* considered "user input".

There are checks on the week number:
1. Only valid calendar weeks are accepted, that is a number from 1 to 53. Decimals get converted to integers, so `3.14` becomes `3`.
2. The calendar week gets formatted to two digits, so `1` becomes `01` and `0010` becomes `10`.

### Limitations
The script comes with all limitations limitations of an iframe, including not being able to auto-login and having a fixed size - i.e. not being "responsive".

## Command-line installation
As an alternative to downloading the files manually from GitHub, you can use the command-line.

In the desired directory, type the following: `git clone https://github.com/reclaimingmytime/calendar.git`

Note: This will create a new directory called `calendar`.

## Configuration
1. Copy `config.default.php` to `config.php`.
2. Open `config.php` and change the required variables. `$baseURL` is the part *before* the week number. Logically, `$suffixURL` is the part after that number. Make sure that `$baseURL` is a *valid URL*, and that both variables *end with a slash*.
3. Test the page. If it does not display properly, make sure you are logged in to the service. You might want to view the source code, that usually tells you how the script interpreted your input.

## Command-line updates
As an alternative to downloading the new files manually, if you have installed the script through git, you can simply update your local repository by typing the following in that directory.

`git fetch --all
 git reset --hard origin/master`

Note that your configuration file `config.php` will be **kept** in any case, as that file is ignored by git.
