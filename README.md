# technical_support_assignment

## Instructions
1. Make sure PHP is installed on your server
- If your server has activated support for PHP you do not need to do anything.
- If your server does not support PHP, you must:
    1. install a web server
    2. install PHP
    
2. Install MySQL if its not already installed

3. Create a new MySQL database and import the schema in the included file Technical_Support_Engineer_Assignment.sql

4. Clone this repo by running the following command in your Command Line Shell:

git clone https://github.com/njpowers7915/technical_support_engineer_assignment

5. Navigate into the repo, open the file assignment.php in a text editor, and enter your servername, MySQL username, MYSQL password, and database name in the corresponding quotation marks on lines 3 through 6.

6. After saving this information, run the following command to see the results of the below queries:

php assignment.php

## Queries

1. Find users that are not assigned to any company
2. Find active (not deleted) users who are assigned to inactive (deleted) companies
3. Find out how many active (not deleted) users are assigned to each active (not deleted)
company. Display the list of company names and the number of active users in
descending order.
4. Find users that are assigned to a non-existent company.
5. Create a new user, Leto, assigned to ‘A-Corp’ .
6. Change Leto’s name to Leo.
7. Delete user Bob
