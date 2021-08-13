## Instructions to run on localhost

### Setting up database

- Start xampp server
- Create database in MySQL

### Connecting database

- Create file with name **`db_cred.php`** in root folder of repository.
- Write code as follows in **`db_cred.php`**:

```php
<?php
    $db['db_host'] = "your_host_name";    // localhost
    $db['db_user'] = "your_user_name";    // root
    $db['db_name'] = "your_db_name";
    $db['db_pass'] = "your_db_pass";
>?
```
