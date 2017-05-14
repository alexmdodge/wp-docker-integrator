# Eosense Docker
A docker configuration for the eosense site. This is also wrapped with the wp-cli to modify the installation and setup imported databases.

# Run It
Getting `docker` and `docker-compose` up and running on your machine, then you can execute it with,

```
bash ./setup.sh
```

From here you can open another terminal window in the same directory and set an alias to,

```
alias wpcli-docker="docker exec eosense-wp wp"
```

And you're set! You can now use WP Cli commands with,

```
wpcli-docker user create test test@email.com
wpcli-docker post create --post_type=page --post_title='A Sample post' --post_status=future --post_date='2017-06-01 07:00:00'
```
