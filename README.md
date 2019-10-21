# Overview

This repository contains the code for [jewmich.com](http://www.jewmich.com), which is powered by Wordpress. There's a full development environment powered by Docker Compose in the `docker/` subdirectory. Dependencies are managed using [Composer](https://getcomposer.org/).  

The theme at `html/wp-content/themes/jewmich` contains all the custom code for jewmich.com. We
have one custom plugin, [jewmich_sidebar](https://github.com/jewmich/jewmich_sidebar).

# Development

You will need to install both Docker and Docker Compose.  See [Install Docker Compose](https://docs.docker.com/compose/install/) for instructions.

Once you have that installed, run `UID=$UID docker-compose up` inside the `docker/` subdirectory. When it finishes starting the containers, you will be able to access the site at [http://127.0.0.1](http://127.0.0.1). You can access the [MailerCatcher](https://mailcatcher.me/) instance for testing e-mails at [http://127.0.0.1:1080](http://127.0.0.1:1080).

Use the `scripts/import_sql.sh` script to import the https://www.jewmich.com database into your Docker MySQL container.

# Deployment

Run the following command to deploy code to the jewmich.com server:

```
ssh -A jewmich_com@jewmich.com 'cd jewmich.com && git pull && php composer.phar install'
```

If you changed the `secrets/secrets-production.php` file, you will need to manually upload it with:

```
scp secrets/secrets-production.php alterga2@jewmich.com:~/jewmich.com/secrets/
```
