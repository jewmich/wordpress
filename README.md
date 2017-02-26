# Overview

This repository contains the code for [jewmich.com](http://www.jewmich.com), which is powered by Wordpress. There's a full development environment powered by Docker Compose in the `docker/` subdirectory. Dependencies are managed using [Composer](https://getcomposer.org/).  

# Development

You will need to install both Docker and Docker Compose.  See [Install Docker Compose](https://docs.docker.com/compose/install/) for instructions.

Once you have that installed, run `docker-compose up` inside the `docker/` subdirectory. When it finishes starting the containers, you will be able to access the site at [http://127.0.0.1](http://127.0.0.1). You can access the [MailerCatcher](https://mailcatcher.me/) instance for testing e-mails at [http://127.0.0.1:1080](http://127.0.0.1:1080).

# Deployment

Run the following command to deploy code to the jewmich.com server:

```
ssh alterga2@jewmich.com 'cd jewmich.com && git pull && php composer.phar install`
```

If you changed the `secrets/secrets-production.php` file, you will need to manually upload it with:

```
scp secrets/secrets-production.php alterga2@jewmich.com:~/jewmich.com/secrets/
```
