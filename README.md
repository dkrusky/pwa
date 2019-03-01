# pwa
Minimal Progressive Web Application with AngularJS, Bootstrap, Smarty, Flight and custom PDO connector.

## Configuration

After cloning the project, you will need to run the following commands :

### Get dependencies from shared repos (smarty and flight)
```git submodule update --init```

### Download tools required to compile and minify scripts/scss
```npm install```

This project uses Grunt CLI so you will need to install that as well if it is not already installed on your system. The default task is configured to do all the heavy lifting for the build and cleanup process.

To compile and minify the scripts and scss as well as cleanup, simply run the following command :

```grunt```


### Route configuration

To configure routes, please see the file `/settings/routes.php` as well as the documentation for Flight .  This project uses class based route destinations which are located in `/models/`. Smarty and a DB class (PDO wrapper) are already injected and accessible in any new classes that inherit from `Core` (located in `/lib/core.php`).

### Database configuration

This system supports toggling between a 'live' and 'test' database by changing the `LIVE` constant in `/settings/configuration.php`. Setting this to `true` is in effect "LIVE".

Additionally, all database settings are located in `/settings/` as  'database-<mode>.ini' where <mode> is `live` or `test` for the respective modes. The first line in the ini files is the ODBC connection string, where the second and third line is the username and password respectively. Samples are provided which connect to MySQL.

The database prefix is also a constant in `/settings/configuration.php` named `DB_PREFIX`.

When using `$this->db->query()` you can use the `#` symbol in place of typing your database prefix or concatenating the `DB_PREFIX` constant everywhere it's needed. This means you can do a query like the following :

```
$sql = "SELECT * FROM #users"
```

instead of 

```
$sql = "SELECT * FROM myprefix_users"
```

and also instead of
```
$sql = "SELECT * FROM " . DB_PREFIX . "_users"
```

It also allows for line breaks and indentation so you can have pretty SQL in your code (much easier to make changes quickly in the future)


### Progressive Web App

Configuration for manifest and colors are in `/settings/configuration.php`.  Since the icons need to be perfect squares with a minimum of 192px, you only need to define the icons in the following format :

```'192' => 'images/icons/my192pxicon.png'```

Color is defined once and used for the bar and loading screen, and by default all manifests are generated with standalone (runs as a standalone app) defined.
