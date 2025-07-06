
## Instalación y Puesta en Marcha

> **Requisitos previos:**  
> - PHP 8.3 o superior  
> - Composer  
> - Node.js y npm  
> - MySQL o MariaDB  
> - (Opcional) Docker para entorno containerizado

#### 1. Clonar el repositorio

```bash
git clone https://github.com/Netzcream/PropFlex.git
cd PropFlex
```

#### 2. Instalar dependencias de backend

```bash
composer install
```

#### 3. Instalar dependencias de frontend

```bash
npm install
```

#### 4. Configurar variables de entorno

```bash
cp .env.example .env
```
Luego editar `.env` y configurar conexión a la base de datos y otras variables (`APP_URL`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, etc).

#### 5. Generar la clave de la aplicación

```bash
php artisan key:generate
```

#### 6. Ejecutar migraciones y seeders

```bash
php artisan migrate
# Existen varias propiedades con sus imágenes:
php artisan db:seed
```

#### 7. Compilar los assets front-end

```bash
npm run build
# O para desarrollo:
npm run dev
```

#### 8. Levantar el servidor de desarrollo

```bash
php artisan serve
```

El sitio estará disponible por defecto en [http://localhost:8000](http://localhost:8000).

---

### Usuarios de prueba

Se crean automáticamente los siguientes usuarios al ejecutar el seeder `RoleAndPermissionSeeder`:

| Rol           | Email                                 | Contraseña    | Nombre                  |
|---------------|---------------------------------------|---------------|-------------------------|
| Administrador | admin@propflex.netzcream.com.ar       | flexpropZYXW  | Ricardo Admin           |
| Agente        | agente@propflex.netzcream.com.ar      | flexpropZYXW  | Roberto Gomez Agente    |
| Editor        | editor@propflex.netzcream.com.ar      | flexpropZYXW  | Juan Carlos Editor      |
| Visitante     | user@propflex.netzcream.com.ar        | flexpropZYXW  | Usuario                 |

> **Importante:**
> - Los roles ya están asignados a cada usuario.
> - Todos los usuarios tienen la contraseña `flexpropZYXW` y pueden ser usados para probar los diferentes permisos y vistas del sistema.

---

