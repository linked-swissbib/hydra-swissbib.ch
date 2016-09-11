# Development

## Deployment

The following steps have to be taken when deploying this application:

1. Checkout the desired revision using git

2. Install / Update all composer dependencies: `composer install`

3. Clear the symfony cache: `bin/console cache:clear --env=prod`

4. Warm up the class autoloader: `composer dump-autoload --optimize`

## Performance tuning

- Activate APC caching in config_prod.yml
- Warm up the composer class autoloader
- Deactivate unnecessary PHP modules, especially xdebug
- Use PHP FPM or even PPM ([PHP-PM](https://github.com/php-pm/php-pm))
