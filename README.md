# Proyecto Inicial Sumski-Tiradani

### Idea a implementar

#### ⚽TuCasaca.com⚽

Nuestra idea es implementar un sitio web de venta de camisetas de futbol donde los usuarios podrán explorar una tienda donde las camisetas estarán separadas por distintas categorías (como puede ser paises, ligas, clubes) y tendrán la posibilidad de comprarlas y personalizarlas agregando un nombre y número a estampar.

## ⚽Información a utilizar

### Diagrama ER

![Diagrama entidad-relacion inicial](https://i.imgur.com/NAQeRRM.png)

-   **Categoría**

    -   Entidades que organizan camisetas, tienen un _identificador_ y un _nombre_.

-   **Camiseta**

    -   El producto a vender, caracterizado por un _identificador_, un _nombre_ y _descripción_, un _precio_ y los _talles existentes_.
    -   Además contiene una **imágen** del _frente_ y el _dorso_ de la camiseta.
    -   Pertenece a **una o varias** _categorías_.
    -   Puede estar **Activa o no**, esto simplifica la idea de stock, que debería ser manejado a mano por el dueño de la tienda.

-   **Pedido**

    -   Un pedido está asociado a **una** camiseta en específico.
    -   Pertenece a **una** compra.
    -   Tiene como atributos un _talle elegido_ y una posible personalización con un _número y nombre a estampar_.
    -   Además tiene _precio_ para conservar el valor pagado a pesar de modificaciones del precio del producto.

-   **Compra**

    -   Una compra está compuesta por **varios** pedidos de camisetas.
    -   Tiene asociado **un** cliente que realizó la compra.
    -   Posee información sobre _medio de pago_, el _valor total_ de la compra, la _dirección de entrega_, el _estado_ de la misma y la _fecha_ y _hora_ de realizacion de la compra.

-   **Cliente**
    -   Un cliente se identifica por un _email_.
    -   A este están asociados **todos** sus pedidos de compra.

## ⚽Respecto al proyecto PHP - Laravel

### Web

#### Entidades actualizables

-   Se pueden crear/eliminar a través de la web de los admin las siguientes entidades:

    -   **Camisetas**
    -   **Categorias**

-   y se pueden modificar:
    -   **Camisetas**: cambiando los atributos de las como la descripción, los talles o las imágenes.
    -   **Categorias**: cambiando el nombre de alguna categoría.
    -   Actualizar el estado de las **Compras** de los clientes, informando por ejemplo si la misma está "En proceso" o "Pago Realizado", etc.

#### Reportes

-   Se podrá visualizar

    -   **Camisetas** existentes, con sus categorías.
    -   **Compras** hechas con todos sus **Pedidos** detallados.
    -   **Clientes** que hayan comprado, pudiendo también ver todas las compras de los mismos.

### API

#### Entidades obtenibles por API

-   Por API se podrá obtener:

    -   **Categorías** existentes.
    -   **Camisetas** existentes, todas o por **Categorías**.
    -   Historial de **Compras** con sus **Pedidos** por usuario.

#### Entidades modificables por API

-   Por API se podrá:
    -   Crear entidades **Compra** con varios **Pedidos**.
    -   Al crear una Compra a través de esta API, como se necesita un email, se crea un **Cliente** para asociar la compra, si es que este no existía antes.

#### Aclaracion

-   Toda esta información solicitada a través de la API por la web es para que el sitio web de los clientes muestre la información correspondiente. Y la información envíada es para que se almacenen las compras.

## ⚽Respecto al proyecto en JS - React

### Informacion que verá el cliente

-   El usuario podrá ver:
    -   **Camisetas** por **categoría**.
    -   Si ingresa su mail, sus **Compras** antes realizadas con todos sus **Pedidos**.

### Acciones disponibles para el cliente

-   El cliente podrá **ver camisetas**, **organizarlas por categoría**, elegir **comprarlas**, **elegir talle** para cada una, elegir si la quiere **personalizar con un nombre y número** en específico y mandar cuáles son estas personalizaciones, y luego a la hora de efectuar la compra **elegir un medio de pago** y agregar **información de entrega**.

<br/>

-   El usuario la primera vez que ingrese a la página, la única diferencia es que no va a poder **ver compras realizadas** porque no tiene.
    Luego si podría, usando el mail con el que realizó las compras ver las mismas, con el propósito de **ver en qué estado se encuentran** (ej: esperando pago, en viaje, entregado..)

---

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
