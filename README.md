# Documentación Técnica — Examen Óptima Cultura

Este repositorio contiene la resolución progresiva del examen técnico propuesto por la empresa Óptima Cultura.  
La solución se desarrolló utilizando **arquitectura hexagonal**, priorizando la separación de responsabilidades y el diseño orientado al dominio.

> Enunciado original del ejercicio: [gitlab.com/optima-cultura/prueba-backend-09-2025](https://gitlab.com/optima-cultura/prueba-backend-09-2025)


---

## Actualización del modelo `Company` con `email` y `address`

### Requisito

> Agregar las propiedades `email` y `address` al modelo de dominio de compañías (`Company`).

---

### Cambios realizados

#### 1. Modelo de Dominio

Se crearon los siguientes Value Objects:

- `OptimaCultura\Company\Domain\ValueObject\CompanyEmail`
- `OptimaCultura\Company\Domain\ValueObject\CompanyAddress`

El constructor de la entidad `Company` fue actualizado para recibir ambos objetos de valor:

```php
public function __construct(
    CompanyId $id,
    CompanyName $name,
    CompanyEmail $email,
    CompanyAddress $address,
    CompanyStatus $status
) {
    // ...
}
```

---

#### 2. Modelo Eloquent (`App\Models\Company`)

Se actualizaron los atributos `$fillable` para incluir los nuevos campos:

```php
protected $fillable = [
    'id',
    'name',
    'email',
    'address',
    'status',
];
```

---

#### 3. Migración

Se creó y aplicó una migración que agrega las columnas `email` y `address` a la tabla `companies`:

```php
$table->string('email')->nullable();
$table->string('address')->nullable();
```

---

#### 4. Repositorio de Infraestructura

El método `create` del repositorio `OptimaCultura\Company\Infrastructure\CompanyRepositoryEloquent` fue actualizado para persistir los nuevos atributos:

```php
'email'   => $company->email()->value(),
'address' => $company->address()->value(),
```

---

#### 5. Controlador

El controlador `App\Http\Controllers\Api\Company\PostCreateCompanyController` fue modificado para:

- Validar los nuevos campos
- Pasar los valores a la capa de aplicación

```php
$request->validate([
    'id'      => 'required|uuid',
    'name'    => 'required|string',
    'email'   => 'required|email',
    'address' => 'required|string',
]);
```