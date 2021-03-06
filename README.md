# WP Docker Integrator
A sample Docker configuration with WordPress and the WordPress CLI for easy and efficient WordPress development.

# Reason
In the past as I've worked through Docker examples and WordPress integrations often it's been setting up projects from the beginning with not a lot of information on integrating current projects already in use. I've tried to go through in detail how to convert sites typically hosted on a local machine and how to move them into this project.

# Setup
This container can be run to generate a fresh WordPress installation, or can generate a container based on a previous website (which seems to more often be the case).

## From Another Site
Ensure that you have a `sql` backup of the database you wish to use, as well as any subset of the WordPress core files from a previous site. In order for the `sql` files to work with the container, they need to create a table called `wordpress` and use it in the configuration. This can be done through most db software, but if not, simply add these lines to the top of the sql dump,

```
CREATE DATABASE  IF NOT EXISTS `wordpress` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `wordpress`;
```

Or if you know what database you wish to create and the `sql` backup is already creating and using a different name you can change the following lines in the `docker-compose` configuration.

```
db:
. . .
   environment:
      MYSQL_DATATBASE: new_db_here
wp:
. . .
    environment:
      WORDPRESS_DB_NAME: new_db_here
```
# WordPress Caveats
When running previously production WordPress sites there are a couple change you will most likely have to make,
* Ensure that you change the `siteurl` and `home` in the database to the local definition, which for this instance is `localhost:8080`
* Some links on the site may be broken if the db refers to the live site in various posts and other content. Use the **WordPress CLI** once the container is up and running, or on your local, to change these using,

```
wp search-replace localhost:8080 production.com
```

Or if you set the recommended alias from below,

```
wpcli-docker search-replace localhost:8080 production.com
```

* A sample `wp-config.php` has been included with the project to ensure the settings for any imported sites remain consistent. Just remember depending on your `sql` database dump and database name those settings will change.
* There is a good chance permalinks will be enabled on any production site you upload, just ensure that the `.htaccess` file for permalinks is in the WP directory, which has be included by default in this project.

# Getting it Running
Getting `docker` and `docker-compose` up and running on your machine, then you can execute it with,

```
bash ./setup.sh
```

From here you can open another terminal window in the same directory and set an alias to,

```
alias wpcli-docker="docker exec eosense-wp wp"
```

And you're set! You can now use WP CLI commands like the following,

```
wpcli-docker user create test test@email.com
wpcli-docker post create --post_type=page --post_title='A Sample post' --post_status=future --post_date='2017-06-01 07:00:00'
```

# Re-using the Container
Once you have the docker image and container built for the first time you can run,

```
docker-compose up
docker-compose down
```
For each successive run. Just make sure that if you wish to update to update or ensure you have to most up to date build, run the setup script again.

# **Site Is Live** 
Your new site instance is now running on `localhost:8080`. If you didn't change the sample `sql` dump then you have a test user of,

**Username**: `test` \
**Password**: `test123`
