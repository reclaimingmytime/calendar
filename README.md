# calendar
A basic PHP script that embeds a page based on the current week number.

The script has been kept extremely simple by design.

## Command-line installation
As an alternative to downloading the files manually from GitHub, you can use the command-line.

In the desired directory, type the following: `git clone https://github.com/reclaimingmytime/calendar.git`

## Configuration
1. Copy `config.default.php` to `config.php`.
2. Open `config.php` and change the required variables. `$baseURL` is the part *before* the week number. Logically, `$suffixURL` is the part after that number.
