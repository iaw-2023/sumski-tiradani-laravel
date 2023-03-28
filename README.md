# Proyecto Inicial Sumski-Tiradani

### Idea a implementar

Nuestra idea es implementar un sitio web de venta de camisetas de futbol donde los usuarios podrán explorar una tienda donde las camisetas estarán separadas por distintas categorías (como puede ser paises, ligas, clubes) y tendrán la posibilidad de comprarlas y personalizarlas modificando su nombre y número a estampar.

## Información a utilizar

### Diagrama ER

![Diagrama entidad-relacion inicial](https://i.imgur.com/owH6qjB.png)

-   **Camiseta**

    -   El producto a vender, caracterizado por un _identificador_, un _precio_ y los _talles disponibles_.
    -   Pertenece a **una o varias** _categorías_.

-   **Categoría**

    -   Entidades que organizan camisetas, tienen un _identificador_ y un _nombre_.

-   **Pedido**

    -   Un pedido está asociado a **una** camiseta en específico.
    -   Pertenece a **una** compra.
    -   Tiene como atributos un _talle elegido_ y una posible personalización con un _número y nombre a estampar_.

-   **Compra**

    -   Una compra está compuesta por **varios** pedidos de camisetas.
    -   Tiene asociado **un** cliente que realizó la compra.
    -   Posee información sobre _medio de pago_, el _valor total_ de la compra, la _dirección de entrega_, el _estado_ de la misma y las _fecha_ y _hora_ de        realizacion de la compra. 

-   **Cliente**
    -   Un cliente se identifica por un _email_, _nombre_ y _apellido_. 
    -   A este están asociados **todos** sus pedidos de compra.

## Respecto al proyecto PHP - Laravel

### Entidades actualizables

### Reportes

### Entidades obtenibles por API

### Entidades modificables por API

## Respecto al proyecto en JS - React

### Informacion que verá el cliente

### Acciones disponibles para el cliente

## Pasos

-   clonar el repo https://github.com/iaw-2023/laravel-template y mantener como owner la organización de la materia.

## parados en el directorio del repositorio recientemente clonado, ejecutar:

-   `composer install`
-   `cp .env.example .env`
-   `php artisan key:generate`
-   `php artisan serve`

Con el último comando, pueden acceder a http://127.0.0.1:8000/ y ver la cáscara de la aplicación Laravel

### Requisitos

-   tener [composer](https://getcomposer.org/) instalado
-   tener [php](https://www.php.net/) instalado

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Cubet Techno Labs](https://cubettech.com)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[Many](https://www.many.co.uk)**
-   **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
-   **[DevSquad](https://devsquad.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[OP.GG](https://op.gg)**
-   **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
-   **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
