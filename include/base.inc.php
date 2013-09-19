<?php
    
    define('DATABASE_HOST', 'localhost');           // Database host
    define('DATABASE_NAME', 'apphp');           // Name of the database to be used
    define('DATABASE_USERNAME', 'pi');       // User name for access to database
    define('DATABASE_PASSWORD', 'raspberry');   // Password for access to database
    
    define('DB_PREFIX', '');		          // Unique prefix of all tables in the database

    define('INSTALLATION_KEY', '9pvic60qxa'); // Unique key for installation
    
    define('PASSWORDS_ENCRYPTION_TYPE',  'AES');  // AES|MD5
    define('PASSWORDS_ENCRYPTION',  true);              // true|false
    define('PASSWORDS_ENCRYPT_KEY', 'apphp_micro_cms');
    
?>