E-Local — Gestor de pedidos
Panel de gestión interno y API REST para un pequeño comercio, construido con Laravel como proyecto de aprendizaje.
Funcionalidades
Panel de gestión (web)

Autenticación de usuarios (registro, login, logout) con Laravel Breeze
CRUD completo de categorías, productos y clientes
Gestión de pedidos: creación, detalle y adición de líneas de pedido (producto + cantidad)
Registro del precio unitario histórico en cada línea, preservando el precio del momento de la compra
Interfaz con Tailwind CSS y soporte para modo oscuro

API REST

Endpoints JSON para productos, clientes y pedidos
Transformación de respuestas mediante API Resources (control de los campos expuestos)
Autenticación por tokens con Laravel Sanctum
Login vía API que devuelve un token Bearer

Modelo de datos
Cinco entidades relacionadas: categorías, productos, clientes, pedidos y líneas de pedido. Incluye relaciones uno-a-muchos y una relación muchos-a-muchos con atributos propios a través de la tabla intermedia de líneas de pedido.
Stack
Laravel · Eloquent ORM · Blade · Tailwind CSS · MySQL · Laravel Breeze · Laravel Sanctum
Requisitos

PHP 8.x
Composer
Node.js y npm
MySQL

Instalación
git clone https://github.com/DDevjourney/e-local.git
cd e-local
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve