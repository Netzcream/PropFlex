
## Guía de Uso del Sitio

### Acceso y roles

El sitio PropFlex gestiona el acceso y las funcionalidades según el rol del usuario. Hay cuatro tipos de usuarios principales:

- **Visitante**
- **Editor**
- **Agente**
- **Administrador**

---

### 1. Visitante

**¿Qué puede hacer?**

- Navegar y explorar el catálogo completo de propiedades sin necesidad de registrarse.
- Usar filtros para buscar propiedades por precio, ubicación, tipo y operación (venta/alquiler).
- Ver el detalle de cada propiedad, incluyendo fotos, videos y recorridos 360° (si están disponibles).
- Enviar consultas a los agentes mediante el formulario de contacto presente en cada propiedad.
- Agregar propiedades a favoritos.

**¿Qué NO puede hacer?**

- Cargar, modificar o eliminar propiedades.
- Acceder al panel de administración.
- Ver estadísticas internas o datos de otros usuarios.

---

### 2. Editor

**¿Qué puede hacer?**

- Registrarse o iniciar sesión para acceder a su panel privado.
- Gestionar todos los recursos estáticos de la web, como provincias, tipos de propiedad, etc.
- Acceder a estadísticas globales o administración general del sistema.

**¿Qué NO puede hacer?**

- Editar o eliminar propiedades publicadas por otros agentes.
- Gestionar usuarios (crear, modificar o eliminar cuentas).
- Publicar o editar propiedades.
- Visualizar o responder consultas.

---

### 3. Agente

**¿Qué puede hacer?**

- Registrarse o iniciar sesión para acceder a su panel privado.
- Publicar nuevas propiedades: cargar título, descripción, precio, ubicación, imágenes, videos y recorridos 360°.
- Modificar propiedades propias y actualizar su estado (disponible, reservada, vendida, etc.).
- Visualizar y responder consultas de potenciales clientes relacionadas con sus propiedades.
- Consultar estadísticas básicas de sus publicaciones (por ejemplo, cantidad de vistas o contactos recibidos).
- Gestionar todos los recursos estáticos de la web, como provincias, tipos de propiedad, etc.
- Acceder a estadísticas globales o administración general del sistema.

**¿Qué NO puede hacer?**

- Editar o eliminar propiedades publicadas por otros agentes.
- Gestionar usuarios (crear, modificar o eliminar cuentas).

---

### 4. Administrador

**¿Qué puede hacer?**

- Iniciar sesión para acceder al panel de administración completo.
- Crear, editar y eliminar cuentas de agentes.
- Crear, modificar y eliminar cualquier propiedad, sin importar el autor.
- Editar el contenido general del sitio (landing page, textos institucionales, banners).
- Gestionar todas las consultas recibidas y redirigirlas a los agentes correspondientes.
- Acceder a estadísticas completas del sistema (vistas, propiedades más visitadas, consultas, desempeño de agentes).
- Gestionar categorías, etiquetas o filtros para búsquedas.
- Modificar o eliminar contenido multimedia (imágenes, videos, recorridos 360°).
- Configurar parámetros básicos del sistema (por ejemplo, tasa de comisión).

**¿Qué NO puede hacer?**

- El Administrador tiene acceso completo al sistema y no tiene restricciones funcionales.

---

## Resumen de Acciones Permitidas según Rol

| Acción                            | Visitante | Editor | Agente | Administrador |
|------------------------------------|:---------:|:------:|:------:|:-------------:|
| Ver propiedades                    |     ✔️    |   ✔️   |   ✔️   |      ✔️       |
| Usar filtros de búsqueda           |     ✔️    |   ✔️   |   ✔️   |      ✔️       |
| Enviar consultas                   |     ✔️    |   ❌   |   ✔️   |      ✔️       |
| Crear nuevas propiedades           |     ❌    |   ❌   |   ✔️   |      ✔️       |
| Editar propiedades propias         |     ❌    |   ❌   |   ✔️   |      ✔️       |
| Editar propiedades de otros        |     ❌    |   ❌   |   ❌   |      ✔️       |
| Gestionar usuarios                 |     ❌    |   ❌   |   ❌   |      ✔️       |
| Gestionar recursos estáticos       |     ❌    |   ✔️   |   ✔️   |      ✔️       |
| Ver estadísticas globales          |     ✔️    |   ✔️   |   ✔️   |      ✔️       |
| Acceder al panel de administración |     ❌    |   ✔️   |   ✔️   |      ✔️       |

---

### Ejemplo de Flujo de Uso

1. **Visitante** explora propiedades y consulta por una vivienda de interés.
2. **Editor** gestiona los recursos estáticos del sistema (provincias, tipos, etc).
3. **Agente** recibe la consulta, responde y carga una nueva propiedad.
4. **Administrador** revisa las publicaciones y gestiona el contenido global del sitio.

---

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

