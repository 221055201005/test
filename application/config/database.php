<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['dsn']      The full DSN string describe a connection to the database.
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database driver. e.g.: mysqli.
|			Currently supported:
|				 cubrid, ibase, mssql, mysql, mysqli, oci8,
|				 odbc, pdo, postgre, sqlite, sqlite3, sqlsrv
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Query Builder class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['encrypt']  Whether or not to use an encrypted connection.
|
|			'mysql' (deprecated), 'sqlsrv' and 'pdo/sqlsrv' drivers accept TRUE/FALSE
|			'mysqli' and 'pdo/mysql' drivers accept an array with the following options:
|
|				'ssl_key'    - Path to the private key file
|				'ssl_cert'   - Path to the public key certificate file
|				'ssl_ca'     - Path to the certificate authority file
|				'ssl_capath' - Path to a directory containing trusted CA certificates in PEM format
|				'ssl_cipher' - List of *allowed* ciphers to be used for the encryption, separated by colons (':')
|				'ssl_verify' - TRUE/FALSE; Whether verify the server certificate or not
|
|	['compress'] Whether or not to use client compression (MySQL only)
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|	['ssl_options']	Used to set various SSL options that can be used when making SSL connections.
|	['failover'] array - A array with 0 or more data for connections if the main should fail.
|	['save_queries'] TRUE/FALSE - Whether to "save" all executed queries.
| 				NOTE: Disabling this will also effectively disable both
| 				$this->db->last_query() and profiling of DB queries.
| 				When you run a query, with this setting set to TRUE (default),
| 				CodeIgniter will store the SQL statement for debugging purposes.
| 				However, this may cause high memory usage, especially if you run
| 				a lot of SQL queries ... disable this to avoid that problem.
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $query_builder variables lets you determine whether or not to load
| the query builder class.
*/
require_once BASEPATH . 'dotenv/autoloader.php';
$dotenv = new Dotenv\Dotenv(FCPATH);
$dotenv->load();

$active_group = 'default';
$query_builder = TRUE;

//116======================================================================================
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => getenv('PCMSV2_DB_HOST'),
	'username' => getenv('PCMSV2_DB_USERNAME'),
	'password' => getenv('PCMSV2_DB_PASSWORD'),
	'database' => getenv('PCMSV2_DB_DATABASE'),
	'dbdriver' => 'postgre',
	'port'     => 5432,
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt'  => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['db_mdr'] = array( 
	'dsn'	   => '', 
	'hostname' => getenv('MDR_DB_HOST'),
	'username' => getenv('MDR_DB_USERNAME'),
	'password' => getenv('MDR_DB_PASSWORD'),
	'database' => getenv('MDR_DB_DATABASE'),
	'dbdriver' => 'postgre',
	'port'     => 5432,
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt'  => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['db_punchlist'] = array(
	'dsn'	   => '',
	'hostname' => getenv('PUNCHLIST_DB_HOST'),
	'username' => getenv('PUNCHLIST_DB_USERNAME'),
	'password' => getenv('PUNCHLIST_DB_PASSWORD'),
	'database' => getenv('PUNCHLIST_DB_DATABASE'),
	'dbdriver' => 'postgre',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt'  => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['warehouse'] = array(
	'hostname' => getenv('WH_DB_HOST'),
	'username' => getenv('WH_DB_USERNAME'),
	'password' => getenv('WH_DB_PASSWORD'),
	'database' => getenv('WH_DB_DATABASE'),
	'dbdriver' => 'postgre',
	'port' 	   => 5432,
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt'  => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['db_wareh'] = array(
	'hostname' => getenv('WH_DB_HOST'),
	'username' => getenv('WH_DB_USERNAME'),
	'password' => getenv('WH_DB_PASSWORD'),
	'database' => getenv('WH_DB_DATABASE'),
	'dbdriver' => 'postgre',
	'port' 	   => 5432,
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt'  => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['db_eng'] = array(
	'dsn'	=> '',

	'hostname' => getenv('ENG_DB_HOST'),
	'username' => getenv('ENG_DB_USERNAME'),
	'password' => getenv('ENG_DB_PASSWORD'),
	'database' => getenv('ENG_DB_DATABASE'),
	'dbdriver' => 'postgre',

	'port' => 5432,
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['db_eng_mysql'] = array(
	'dsn'	=> '',
	'hostname' => getenv('ENG_DB_HOST'),
	'username' => getenv('ENG_DB_USERNAME'),
	'password' => getenv('ENG_DB_PASSWORD'),
	'database' => getenv('ENG_DB_DATABASE'),
	'dbdriver' => 'postgre', 
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['db_qcs'] = array(
	'dsn'	   => '', 
	'hostname' => getenv('PORTAL_DB_HOST'),
	'username' => getenv('PORTAL_DB_USERNAME'),
	'password' => getenv('PORTAL_DB_PASSWORD'),
	'database' => getenv('PORTAL_DB_DATABASE'),
	'dbdriver' => 'postgre', 
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['db_portal'] = array(
	'dsn'	=> '',
	'hostname' => getenv('PORTAL_DB_HOST'),
	'username' => getenv('PORTAL_DB_USERNAME'),
	'password' => getenv('PORTAL_DB_PASSWORD'),
	'database' => getenv('PORTAL_DB_DATABASE'),
	'dbdriver' => 'postgre',
	'port' 	   => 5432,
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['db_notif'] = array(
	'dsn'	=> '',
	'hostname' => getenv('NOTIF_DB_HOST'),
	'username' => getenv('NOTIF_DB_USERNAME'),
	'password' => getenv('NOTIF_DB_PASSWORD'),
	'database' => getenv('NOTIF_DB_DATABASE'),
	'dbdriver' => 'postgre',
	'port' 	   => 5432,
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['db_iss'] = array(
	'dsn'	=> '',
	'hostname' => getenv('ISS_DB_HOST'),
	'username' => getenv('ISS_DB_USERNAME'),
	'password' => getenv('ISS_DB_PASSWORD'),
	'database' => getenv('ISS_DB_DATABASE'),
	'dbdriver' => 'postgre',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['quality'] = array(
	'dsn'	=> '',
	'hostname' => getenv('QUALITY_DB_HOST'),
	'username' => getenv('QUALITY_DB_USERNAME'),
	'password' => getenv('QUALITY_DB_PASSWORD'),
	'database' => getenv('QUALITY_DB_DATABASE'),
	'dbdriver' => 'postgre',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['ingress'] = array(
	'dsn'	=> '',
	'hostname' => getenv('INGRESS_DB_HOST'),
	'username' => getenv('INGRESS_DB_USERNAME'),
	'password' => getenv('INGRESS_DB_PASSWORD'),
	'database' => getenv('INGRESS_DB_DATABASE'),
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);