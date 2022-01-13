## UniverseLauncher

UniverseLauncher is a a PHP based CMS to go along with a LUNI database. It can manage the database, approve names, unlock accounts, register new ones,
and has 5 color themes.

This fork is has been updated to work with the database structure of  https://github.com/DarkflameUniverse/DarkflameServer.

### Features:

- A general dashboard with instructions on how to register and info about the running server(s)
- A page which lets users change their password and enter a Play Key
- A page to see info about a selected minifig (WIP)
- A page to see all the non-mission mail for a selected minifig
- An Administrator section for Mythrans
  - An Accounts page to see every account and modify name, password, etc
  - A Characters page to see all minifigs and approve names
  - A Pets page to see all pets with a toggleable filter to show unapproved names (which you can then approve)
- A Help page which functions as a bug report tool.


### Some things have been removed from the original:

- Forums page
  - Code was messy, our group uses Discord
- Sessions/Instances pages
  - DLU doesn't have a database or other interface to easily see running sessions/instances and do actions such as shutting them down or launching new ones.



### What can be improved?
- Using modern sql techniques such as "prepared staements" to improve site stability and security
- Everything else

### Credits:
Uses an adapted version of
http://www.php-login.net / MINIMAL VERSION
A simple, clean and secure PHP Login Script
* @author Panique
* @link https://github.com/panique/php-login-minimal/
* @license http://opensource.org/licenses/MIT MIT License
