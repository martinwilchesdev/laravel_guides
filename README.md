# Laravel

## Introduccion a Laravel

### Inicializar un nuevo proyecto

```bash
composer global require laravel/installer
laravel new <app_name>
```

con Composer

```bash
composer create-project laravel/laravel MiProyecto
```

### Estructura del proyecto

- app/
    - Contiene los modelos y controladores (logica del negocio)
- routes/
    - Define las rutas de la aplicacion
- resources/views
    - Contiene las vistas Blade (interfaz del usuario)
- database/migratios
    - Gestiona las migraciones de la base de datos.
- config/
    - Configuracion del sistema (base de datos, cache, etc.)

### Configuracion de Laravel

Laravel usa un archivo de configuracion `.env` que define variables de entorno.

#### Conexion a la base de datos (MySQL)

```sh
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=mi_base_de_datos
DB_USERNAME=root
DB_PASSWORD=secret
```

> Despues de modificar `.env` es recomendable ejecutar el comando `php artisan config:clear` para aplicar los cambios

### Crear controlador

```bash
php artisan make:controller ProductoController
```

### Crear modelos y migraciones

```bash
php artisan make:model Producto -m
```

> La bandera -m permite crear la migracion asociada al modelo

- `app/Models/Producto.php` - Define el modelo
- `database/migrations/xxxx_xx_xx_create_productos_table.php` - Define la estructura de la tabla en la base de datos

### Ejecutar una o varias migraciones

```bash
php artisan migrate
```

> El comando anterior unicamente ejecuta las migraciones que aun no han sido ejecutadas en la base de datos

### Crear seeders

```bash
php artisan make:seeder ProductoSeeder
```

> Los seeders permiten insertar datos de prueba en la base de datos automaticamente

#### Editar el seeder

```php
class ProductoSeeder extends Seeder {
    Producto::create([
        'nombre' => 'Smartphone',
        'precio' => 800,
        'descripcion' => 'Celular de ultima generacion'
    ]);
}
```

#### Ejecutar el seeder

```bash
php artisan db:seed --class=ProductoSeeder
```

> Esto insertara los datos en la base de datos

Si el Seeder es registrado en `DatabaseSeeder.php`

```php
public function run() {
    $this->call(ProductoSeeder::class);
}
```

Al ejecutar el siguiente comando se ejecutaran todos los Seeders registrados.

```bash
php artisan db:seed
```

### Crear factories

```bash
php artisan make:factory ProductoFactory --model=Producto
```

> Las factories permite generar grandes volumenes de datos falsos facilmente

#### Editar la factory

```php
public function definition() {
    return[
        'nombre' => $this->faker->word(),
        'precio' => $this->faker->randomFloat(2, 100, 2000),
        'descripcion' => $this->faker->sentence();
    ];
}
```

> Laravel usa `Faker` para generar datos aleatorios

#### Usar la factory en el seeder

```php
Producto::factory(10)->create();
```

> Los datos falsos seran insertados en la base de datos cuando se ejecute el seeder donde se utiliza la factory

### Tinker

#### Ejecutar tinker para insertar productos manualmente

```bash
php artisan tinker
```

Para hacer uso del modelo `Producto` con tinker, este debe ser importado.

```bash
use App\Models\Producto;
```

Una vez se realice la importacion del modelo, se podran realizar consultas para modificar la tabla asociada a dicho modelo.

```bash
Producto::create(['nombre' => 'laptop']);
```

## Patron MVC en Laravel

MVC es un patron de arquitectura que separa la aplicacion en 3 capas.

1. __Modelo:__ Representa los datos y la logica de negocio (Ejemplo: `Producto.php`)
2. __Vista:__ Muestra la interfaz de usuario (Ejemplo: `index.blade.php`)
3. __Controlador:__ Gestiona la logica y conecta el modelo con la vista (Ejemplo: `ProductoController.php`)

> De forma predeterminada Laravel implementa MVC

## Eloquent ORM

Eloquent es el ORM __(Object-Relational Mapping)__ de Laravel, el cual permite trabajar con la base de datos usando objetos en lugar de escribir consultas SQL manualmente.

```php
Product::create([
    'nombre' => 'Laptop',
    'precio' => 1000,
    'descripcion' => 'Laptop de alta gama'
]);
```

> En el ejemplo anterior Laravel internamente realiza una consulta similar a `INSERT INTO productos (nombre, precio, descripcion) VALUES ('Laptop', 1000, 'Laptop de alta gama')`.

## laravel-lang

```bash
composer require laravel-lang/common
```
