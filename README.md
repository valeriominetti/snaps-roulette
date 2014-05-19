snaps-roulette
==============

snapchat roulette bot made in php using php-snapchat library.
It parses snaps from users and save them. For each snap it sends back a random snap from archive directory.
Every 30 mins it publish a random snap on bot story.

php-snapchat has been taken from:
https://github.com/JorgenPhi/php-snapchat

* index-cli.php  
bot script: takes care of all work

* index.php 
work in progress of a web interface. at the moment just print out a table with filename and img of all uploaded snaps.

Install
-------

_requirements_
* php5_curl
* wget
* php5_mcrypt

_ installation steps_
* Unzip archive in a published folder
* set appropriate username and password in index.cli.php
* add this command to crontab to have bot runned every 2 minutes:
 "*/2 * * * * /usr/bin/wget -q  http://localhost/roulette/index-cli.php"

Donation
--------

Feel free to drop some uBTC to this address ;)   1CgtHL3LpTBacZGnrsGjkdWoozk3cE4mhy
