# Eosense Docker
A docker configuration for the eosense site. This is also wrapped with the wp-cli to modify the installation and setup imported databases.

# Run It
Getting `docker` and `docker-compose` up and running on your machine, then you can execute it with,

```
bash ./setup.sh
```

From here you can set the alias,

```
alias wpcli-docker="docker exec eosense-wp wp"
```

And you're set!
