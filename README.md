# `TaskManager Laravel API` 🚀

Este proyecto es una API CRUD de tareas construida con **Laravel** y **Eloquent ORM**, conectada a una base de datos **MariaDB/MySQL**. Permite gestionar tareas a través de endpoints RESTful, pruebas desde Postman y también mediante **GraphQL** y filtros dinámicos similares a **OData**.

## `🔧 Tecnologías usadas`

- PHP 8.4.x
- Laravel 12.x
- Eloquent ORM
- GraphQL
- MariaDB / MySQL
- Postman (para pruebas de API y pruebas de filtros con GraphQL)


## `🚀 Instalación y configuración`

1. Clona el repositorio:

```bash
git clone https://github.com/CamiloHernandez0910/Taskmanager-Laravel-Api.git
cd Taskmanager-Laravel-Api
```

2. Instala las dependencias:

```bash
composer install
```

3. Configura el archivo `.env`:

Copia el archivo de ejemplo y edita con tus datos de base de datos:

```bash
cp .env.example .env
```

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_bd
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

4. Genera la key de aplicación:

```bash
php artisan key:generate
```

5. Ejecuta las migraciones:

```bash
php artisan migrate
```

6. Inicia el servidor:

```bash
php artisan serve
```

La API estará disponible en: `http://127.0.0.1:8000`

## `🧪 Pruebas`

### `📬 API REST`

Puedes probar los endpoints básicos del CRUD de tareas usando herramientas como Postman o directamente desde el navegador (si tienes rutas de prueba habilitadas en la vista). Ejemplo de ruta:
```bash
GET http://localhost:8000/api/tareas
```

### `🔎 Filtros dinámicos tipo OData`

Ejemplo de uso en URL:

```
GET http://127.0.0.1:8000/api/odata/tareas?sort=created_at,asc
```

### `🚀 GraphQL`

Accede a la interfaz en:

```
http://127.0.0.1:8000/graphql
```

Ejemplo de consulta:

```graphql
{
  tasks {
    id
    title
    status
  }
}
```

## 👨‍💻 Contribuciones
¡Las contribuciones son bienvenidas! Por favor, sigue estos pasos:
1. Haz un **fork** del repositorio
2. Crea una nueva rama (`git checkout -b feature-nueva`)
3. Realiza los cambios y haz **commit** (`git commit -m 'Agrega nueva funcionalidad'`)
4. Haz **push** a tu rama (`git push origin feature-nueva`)
5. Abre un **Pull Request**

---
**Desarrollado con ❤️ por [HERTUQ](https://github.com/CamiloHernandez0910)** 🚀

