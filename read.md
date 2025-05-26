# 📋 ToDo Correlativo PropFlex (Laravel 12)

## 1. Configuración inicial del proyecto
- [ ] Crear proyecto Laravel 12: `laravel new propflex`
- [ ] Configurar base de datos en `.env`
- [ ] Setear `APP_LOCALE=es` y `APP_TIMEZONE=America/Argentina/Buenos_Aires`
- [ ] Instalar Breeze: `composer require laravel/breeze --dev`
- [ ] Instalar Breeze: `php artisan breeze:install`
- [ ] Instalar npm y compilar assets: `npm install && npm run dev`
- [ ] Ejecutar migraciones iniciales: `php artisan migrate`

## 2. Instalación de componentes adicionales
- [ ] Instalar Livewire: `composer require livewire/livewire`  
  [Livewire Docs](https://livewire.laravel.com/)
- [ ] Instalar Spatie Permissions: `composer require spatie/laravel-permission`  
  [Spatie Permissions Docs](https://spatie.be/docs/laravel-permission)
- [ ] Instalar Spatie Media Library: `composer require spatie/laravel-medialibrary`  
  [Spatie Media Library Docs](https://spatie.be/docs/laravel-medialibrary)
- [ ] Instalar Laravel Excel: `composer require maatwebsite/excel`  
  [Laravel Excel Docs](https://laravel-excel.com/)
- [ ] Instalar Laravel DomPDF: `composer require barryvdh/laravel-dompdf`  
  [Laravel DomPDF Docs](https://github.com/barryvdh/laravel-dompdf)

## 3. Roles y permisos
- [ ] Publicar archivos de Spatie Permissions:  
  `php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"`
- [ ] Ejecutar migraciones: `php artisan migrate`
- [ ] Modificar `User.php` para usar `HasRoles`
- [ ] Crear seeders para roles: Admin, Agente

## 4. Usuarios iniciales
- [ ] Crear seeders de usuario Admin y Agente
- [ ] Asignar roles en los seeders
- [ ] Probar login

## 5. Modelo Property
- [ ] Crear modelo, migración y factory de Property
- [ ] Definir constantes de estado (disponible, reservada, vendida/alquilada)
- [ ] Relacionar User -> Property (hasMany) y Property -> User (belongsTo)
- [ ] Implementar MediaLibrary en Property

## 6. Panel CRUD de propiedades
- [ ] Crear rutas protegidas
- [ ] Crear componentes Livewire:
  - [ ] `PropertyForm`
  - [ ] `PropertyList`
- [ ] Agente:
  - Crear propiedades propias
  - Editar propiedades propias
  - Cambiar estado
- [ ] Admin:
  - Gestionar todas las propiedades
  - Eliminar propiedades

## 7. Landing pública y catálogo
- [ ] Crear landing pública
- [ ] Filtros de búsqueda: precio, tipo, operación, ubicación
- [ ] Propiedades destacadas y vistas recientemente
- [ ] Detalle de propiedad
- [ ] Formulario de contacto

## 8. Gestión de usuarios (admin)
- [ ] Listado de usuarios
- [ ] Crear, editar y eliminar agentes
- [ ] Asignación de roles

## 9. Gestión de contenidos institucionales
- [ ] Modelo/migración de Content
- [ ] CRUD de contenidos (quienes somos, contacto, banners)

## 10. Subida de archivos multimedia
- [ ] Subida de imágenes, videos, planos con MediaLibrary
- [ ] Validación de formatos y tamaño

## 11. Exportaciones
- [ ] Crear exportador de propiedades a Excel  
  `php artisan make:export PropertiesExport --model=Property`
- [ ] Crear exportación de propiedades a PDF usando DomPDF

## 12. Mejoras opcionales
- [ ] Contador de vistas
- [ ] Estadísticas por propiedad y usuario
- [ ] Validaciones fuertes
- [ ] Mejoras estéticas con Tailwind

## 13. Preparar entrega
- [ ] Comprimir proyecto en `TP1_PropFlex`
- [ ] Incluir carpeta Laravel + documentos de entrega

---

# 🛠️ Laravel Cheat Sheet Comandos Útiles

## Crear estructura
```bash
php artisan make:model Property -m
php artisan make:controller PropertyController
php artisan make:seeder UserSeeder
php artisan make:factory PropertyFactory --model=Property
php artisan make:migration create_properties_table
php artisan make:policy PropertyPolicy --model=Property
php artisan make:request StorePropertyRequest
php artisan make:livewire PropertyForm
php artisan make:livewire PropertyList
php artisan make:export PropertiesExport --model=Property
```

## Migraciones y Seeders
```bash
php artisan migrate
php artisan migrate:rollback
php artisan migrate:fresh --seed
php artisan db:seed --class=UserSeeder
```

## Rutas y controladores
```bash
php artisan route:list
php artisan make:controller PropertyController --resource
```

## Storage y archivos
```bash
php artisan storage:link
```

## General
```bash
php artisan optimize:clear
php artisan serve
```

## Exportaciones
```php
use Barryvdh\DomPDF\Facade\Pdf;

$pdf = Pdf::loadView('exports.properties', ['properties' => $properties]);
return $pdf->download('propiedades.pdf');
```
