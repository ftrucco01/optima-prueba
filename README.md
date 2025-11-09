# Examen Óptima Cultura

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


#### 6. Test de Aplicación

**Archivo:**  
`tests/OptimaCultura/Company/Application/CreateANewCompanyTest.php`

Se ajustó el test para reflejar los nuevos campos `email` y `address`, así como el orden correcto de los parámetros esperados por el caso de uso `CompanyCreator`.

```php
$testCompany = [
    'id'      => Str::uuid(),
    'name'    => $faker->name,
    'status'  => 'inactive',
    'email'   => $faker->email,
    'address' => $faker->address
];

$creator = new CompanyCreator(new CompanyRepositoryFake());
$company = $creator->handle(
    $testCompany['id'],
    $testCompany['name'],
    $testCompany['email'],
    $testCompany['address']
);

---

## Actualización del estado de una compañía

### Requisito

> Crear un nuevo caso de uso para actualizar el estado de una compañía de `inactive` a `active`.  
> Crear un nuevo endpoint de API que actualice el estado utilizando el caso de uso anterior.

---

### Cambios realizados

#### 1. Caso de uso

Se agregó la clase `OptimaCultura\Company\Application\UpdateCompanyStatus`:

```php
class UpdateCompanyStatus
{
    private CompanyRepositoryInterface $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CompanyId $id, CompanyStatus $newStatus): void
    {
        $this->repository->updateStatus($id, $newStatus);
    }
}
```

---

#### 2. Modificación del Dominio

- Se agregó el método `updateStatus` a la interfaz `CompanyRepositoryInterface`.

```php
public function updateStatus(CompanyId $id, CompanyStatus $status): void;
```

---

#### 3. Implementación en Infraestructura

El método `updateStatus` fue implementado en `CompanyRepositoryEloquent`:

```php
public function updateStatus(CompanyId $id, CompanyStatus $status): void
{
    $company = EloquentCompany::findOrFail($id->get());
    $company->status = $status->name();
    $company->save();
}
```

---

#### 4. Modelo de Dominio

Se actualizó la entidad `Company` para exponer un método que permita modificar su estado internamente si fuera necesario:

```php
public function changeStatus(CompanyStatus $status): void
{
    $this->status = $status;
}
```

---

#### 5. Form Request

Se agregó `App\Http\Requests\Company\UpdateCompanyStatusRequest` para validar los datos de entrada:

```php
public function rules(): array
{
    return [
        'status' => 'required|string|in:active,inactive',
    ];
}
```

---

#### 6. Controlador

Se creó el controlador `UpdateCompanyStatusController`:

```php
public function __invoke(UpdateCompanyStatusRequest $request, string $id): JsonResponse
{
    ($this->service)(
        new CompanyId($id),
        CompanyStatus::fromName($request->input('status'))
    );

    return response()->json(['message' => 'Company status updated']);
}
```

---

#### 7. Ruta

Se registró el nuevo endpoint en `routes/api.php`:

```php
Route::put('/company/{id}/status', [UpdateCompanyStatusController::class, '__invoke']);
```

---

## Listado de todas las compañías

### Requisito

> Crear un nuevo caso de uso que liste todas las compañías.  
> Crear un nuevo endpoint de API que liste las compañías basado en el caso de uso del punto anterior.

---

### Cambios realizados

#### 1. Caso de uso

Se creó la clase `OptimaCultura\Company\Application\GetAllCompanies`:

```php
class GetAllCompanies
{
    private CompanyRepositoryInterface $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(): array
    {
        return $this->repository->all();
    }
}
```

---

#### 2. Interfaz de repositorio

Se agregó la siguiente firma al contrato `CompanyRepositoryInterface`:

```php
public function all(): array;
```

---

#### 3. Implementación en infraestructura

El método `all()` fue implementado en `CompanyRepositoryEloquent`:

```php
public function all(): array
{
    return EloquentCompany::all()->toArray();
}
```

---

#### 4. Controlador

Se agregó el controlador `App\Http\Controllers\Api\Company\GetAllCompaniesController`:

```php
public function __invoke(): JsonResponse
{
    $companies = ($this->service)();
    return response()->json($companies);
}
```

---

#### 5. Ruta

Se registró el endpoint en `routes/api.php`:

```php
Route::get('/companies', [GetAllCompaniesController::class, '__invoke']);
```