# CWP API, by @puerari

[![Maintainer](http://img.shields.io/badge/maintainer-@leandropuerari-blue.svg?style=flat-square)](https://www.linkedin.com/in/leandropuerari)
[![Source Code](http://img.shields.io/badge/source-puerari/cwp_api-blue.svg?style=flat-square)](https://github.com/puerari/cwp_api)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/puerari/cwp_api.svg?style=flat-square)](https://packagist.org/packages/puerari/cwp_api)
[![Latest Version](https://img.shields.io/github/release/puerari/cwp_api.svg?style=flat-square)](https://github.com/puerari/cwp_api/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/puerari/cwp_api.svg?style=flat-square)](https://scrutinizer-ci.com/g/puerari/cwp_api)
[![Quality Score](https://img.shields.io/scrutinizer/g/puerari/cwp_api.svg?style=flat-square)](https://scrutinizer-ci.com/g/puerari/cwp_api)
[![Total Downloads](https://img.shields.io/packagist/dt/puerari/cwp_api.svg?style=flat-square)](https://packagist.org/packages/puerari/cwp_api)

## About CWP API

###### CWP API is a PHP package that abstracts the interaction with CentOS Web Panel through its API

CWP API é um pacote PHP que abstrai a interação com o Painel de Controle de Hospedagens Web CentOS através de sua API.

## About CWP

###### [CentOS Web Panel](https://centos-webpanel.com/) is a Free Web Hosting control panel designed for quick and easy management of (Dedicated & VPS) servers minus the chore and effort to use ssh console for every time you want to do something, offers a huge number of options and features for server management in its control panel package.

[CentOS Web Panel](https://centos-webpanel.com/) é um Painel de Controle de Hospedagens Web, Gratuito, projetado para gerenciamento rápido e fácil de
 servidores (dedicados e VPS), que reduz tarefa e o esforço de usar o console ssh sempre que você precisar fazer algo, oferece um grande número de opções e
  recursos
  para gerenciamento de servidores em seu pacote do painel de controle.

### Highlights

- Easy to set up (Fácil de configurar)
- Composer ready (Pronto para o composer)
- PSR-2 compliant (Compatível com PSR-2)

## Installation

CWP_API is available via Composer:

add the following line on your composer.json file

```bash
"puerari/cwp_api": "^1.0"
```

or run

```bash
composer require puerari/cwp_api
```

## Usage

Follow the CWP documentation to enable API on your server:

[https://docs.control-webpanel.com/docs/developer-tools/api-manager/configuration](https://docs.control-webpanel.com/docs/developer-tools/api-manager/configuration)

Include the Composer autoloader file;

```bash
require_once 'vendor/autoload.php';
```

Instantiate the Cwpapi class

```bash
$cwpApi = new Cwpapi('https://yourcwpdomain.com', 'ApiKeyGenetedOnYouCwpAdminPanel');
```

Call the methods that solve your necessities.
Each method is documented in its definition.

See the official documentation on 
[https://docs.control-webpanel.com/docs/developer-tools/api-manager](https://docs.control-webpanel.com/docs/developer-tools/api-manager)

Example: how to create a new user account and a database associated with the created account.

```bash
$status = $cwpApi->createAccount('userdomain.com', 'username', 'userPassword', 'contact@userdomain.com', '123.456.789.0');
if ((json_decode($status))->status != 'OK') {
    exit((json_decode($status))->msj);
}
$status = $cwpApi->createMysqlDatabase('username', 'dbname');
if ((json_decode($status))->status != 'OK') {
    $cwpApi->deleteAccount('username', 'contact@userdomain.com');
    exit((json_decode($status))->msj . ' The account was created, but due to this error we deleted it.');
}
// User account and database successfully created
```

## Support

###### Security: If you discover any security related issues, please use the issue tracker on [GitHub](https://github.com/puerari/cwp_api/issues).

Se você descobrir algum problema relacionado à segurança, por favor utilize o rastreador de problemas do [GitHub](https://github.com/puerari/cwp_api/issues).

## Credits

- [Leandro Puerari](https://github.com/puerari) (Developer)
- [Contributors](https://github.com/puerari/cwp_api/contributors)
- [CentOS Web Panel](https://centos-webpanel.com/)

## License

The MIT License (MIT). Please see [License File](https://github.com/puerari/cwp_api/blob/master/LICENSE) for more information.

## Contributing

Please see [contributing page](https://github.com/puerari/cwp_api/blob/master/CONTRIBUTING.md) for details.

## Thank You

**Let's Code...**
