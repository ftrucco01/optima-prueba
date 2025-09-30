# Prueba Técnica Backend - Laravel con Arquitectura Hexagonal para Óptima Cultura

## Descripción

Esta es una prueba técnica para evaluar habilidades en el desarrollo backend utilizando PHP y el framework Laravel, implementando una arquitectura hexagonal (Hexagonal Architecture). El proyecto incluye la entidad de dominio `Company` como ejemplo, separando claramente las capas de aplicación, dominio e infraestructura. Se espera que el candidato complete los ejercicios propuestos, implemente funcionalidades adicionales y valide los cambios mediante pruebas unitarias y de integración.

## Tecnologías Utilizadas

- **PHP 8.4**: Lenguaje de programación principal.
- **Laravel**: Framework PHP para desarrollo web.
- **Arquitectura Hexagonal**: Patrón de diseño que separa la lógica de negocio de las interfaces externas.
- **MySQL/MariaDB**: Base de datos relacional.
- **Composer**: Gestor de dependencias para PHP.
- **PHPUnit**: Framework para pruebas unitarias.

## Requisitos

- PHP 8.4 o superior.
- MySQL o MariaDB.
- Composer.
- Git para control de versiones.

## Instalación

Sigue estos pasos para configurar el proyecto en tu entorno local:

1. **Crea el archivo de configuración de entorno:**
   Copia el archivo `.env.example` a `.env` y configura las variables necesarias (como la conexión a la base de datos).
   ```bash
   cp .env.example .env
   ```

2. **Instala las dependencias:**
   ```bash
   composer install
   ```

3. **Ejecuta las migraciones de la base de datos:**
   ```bash
   php artisan migrate
   ```

4. **Genera la clave de aplicación:**
   ```bash
   php artisan key:generate
   ```

5. **Valida la instalación ejecutando las pruebas:**
   ```bash
   php artisan test
   ```

## Ejercicios

Completa los siguientes ejercicios para demostrar tus habilidades:

- Agregar las propiedades `email` y `address` al modelo de dominio de compañías (`Company`).
- Crear un nuevo caso de uso para actualizar el estado de una compañía de `inactive` a `active`.
- Crear un nuevo endpoint de API que actualice el estado utilizando el caso de uso del punto anterior.
- Crear un nuevo caso de uso que liste todas las compañías.
- Crear un nuevo endpoint de API que liste las compañías basado en el caso de uso del punto anterior.
- Crear los tests necesarios para validar los cambios realizados.
- Asegurarse de que todos los tests pasen después de realizar los cambios.
- **Opcional:** Implementa cualquier otra entidad de dominio que consideres relevante.

## Notas y recomendaciones

- Revisa el código existente para entender la estructura y las convenciones utilizadas.
- Mantén la coherencia con el estilo de codificación y las convenciones del proyecto.
- Aplica los principios SOLID y las mejores prácticas de diseño de software.
- Aplica API RESTful para la creación de endpoints.
- Utiliza inyección de dependencias.
- El proyecto no incluye vistas de frontend, es solo una API.
- Si deseas añadir alguna vista, puedes hacerlo, pero no es obligatorio, no se evaluará el diseño frontend.
- Si deseas añadir alguna funcionalidad adicional que consideres relevante, puedes hacerlo, siéntete libre de hacerlo.
- Revisa los tests antes y después de realizar los cambios.
- El proyecto incluye un archivo `docker-compose.yml` para facilitar la configuración del entorno de desarrollo utilizando contenedores Docker, puedes usarlo si lo deseas.
- Si tienes alguna duda, contacta a Óptima Cultura a través del email proporcionado.

## Pruebas

Ejecuta las pruebas para validar tu implementación:

```bash
php artisan test
```

Asegúrate de que todas las pruebas pasen antes de enviar tu solución.

## Entrega de la Prueba

Para entregar la prueba técnica, sigue estos pasos:

1. **Haz un fork del repositorio** original.
2. **Antes de realizar cambios:** Sube el código inicial a un repositorio público de tu propiedad con un commit titulado "Initial commit".
3. **Realiza los ejercicios:** Implementa los cambios solicitados y sube los commits a tu repositorio.
4. **Envía tu solución:** Una vez finalizada, envía un email a `jasanchez@vocces.com` (o la persona que te envió la prueba) con el enlace a tu repositorio público y una breve descripción de los cambios realizados.

## Contacto

Si tienes alguna duda sobre la prueba técnica, contacta a Óptima Cultura a través del email proporcionado.

---

¡Buena suerte en la prueba técnica!
