# API Documentation


####  ⚠️ **REGISTER USER WITH ADMIN ROLE:**

## Generate user from migration using seeder

`php artisan migrate --seed`

## alternative

## Create an Admin User with Tinker
### Step 1: Open Tinker
Open your terminal and navigate to your Laravel project directory. Then, run the following command to open Tinker:

> bash
`php artisan tinker`

    // Crear el usuario
    $user = \App\Models\User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => \Illuminate\Support\Facades\Hash::make('password123'),
    ]);
    
    // Obtener el rol 'admin'
    $adminRole = \App\Models\Role::where('name', 'admin')->first();
    
    // Asignar el rol 'admin' al usuario
    $user->roles()->attach($adminRole->id);


## Base URL
`http://localhost/api`
## Example
`http://127.0.0.1:8000/api/`
## Authentication

### Register a New User
- **Endpoint:** `/register`
- **Method:** `POST`
- **Request Body:**

      "name": "string",
      "email": "string",
      "password": "string"

- **Response:**
  1. 201 Created: User registered successfully.
  2. 400 Bad Request: Validation errors.

### Login
- **Endpoint:** `/login`
- **Method:** `POST`
- **Request Body:**

      "email": "string",
      "password": "string"

- **Response:**
  1. 200 OK: Login successful, returns token.
  2. 401 Unauthorized: Invalid credentials.

---

## User Management

### Get Authenticated User
- **Endpoint:** `/user`
- **Method:** `GET`
- **Headers:**

      Authorization: Bearer <token>

- **Response:**
  1. 200 OK: Returns authenticated user details.
  2. 401 Unauthorized: Invalid or missing token.

### Get a Specific User
- **Endpoint:** `/users/{user}`
- **Method:** `GET`
- **Headers:**

      Authorization: Bearer <token>

- **Response:**
  1. 200 OK: Returns user details.
  2. 403 Forbidden: Unauthorized access.
  3. 404 Not Found: User not found.

### Update a User
- **Endpoint:** `/users/{user}`
- **Method:** `PUT`
- **Headers:**

      Authorization: Bearer <token>

- **Request Body:**

      "name": "string",
      "email": "string",
      "password": "string"

- **Response:**
  1. 200 OK: User updated successfully.
  2. 403 Forbidden: Unauthorized access.
  3. 404 Not Found: User not found.
  4. 400 Bad Request: Validation errors.

---

## Roles Management (Admin Only)

### Get All Roles
- **Endpoint:** `/roles`
- **Method:** `GET`
- **Headers:**

      Authorization: Bearer <token>

- **Response:**
  1. 200 OK: Returns list of roles.
  2. 403 Forbidden: Unauthorized access.
  3. 401 Unauthorized: Invalid or missing token.

### Create a New Role
- **Endpoint:** `/roles`
- **Method:** `POST`
- **Headers:**

      Authorization: Bearer <token>

- **Request Body:**

      "name": "string"

- **Response:**
  1. 201 Created: Role created successfully.
  2. 403 Forbidden: Unauthorized access.
  3. 400 Bad Request: Validation errors.

### Update a Role
- **Endpoint:** `/roles/{role}`
- **Method:** `PUT`
- **Headers:**

      Authorization: Bearer <token>

- **Request Body:**

      "name": "string"

- **Response:**
  1. 200 OK: Role updated successfully.
  2. 403 Forbidden: Unauthorized access.
  3. 404 Not Found: Role not found.
  4. 400 Bad Request: Validation errors.

### Delete a Role
- **Endpoint:** `/roles/{role}`
- **Method:** `DELETE`
- **Headers:**

      Authorization: Bearer <token>

- **Response:**
  1. 200 OK: Role deleted successfully.
  2. 403 Forbidden: Unauthorized access.
  3. 404 Not Found: Role not found.

---

## User Statistics (Admin Only)

### Run Command to Generate User Statistics 

    php artisan generate:user-statistics

### Get User Statistics
- **Endpoint:** `/user-statistics`
- **Method:** `GET`
- **Headers:**

      Authorization: Bearer <token>

- **Response:**
  1. 200 OK: Returns user statistics.
  2. 403 Forbidden: Unauthorized access.
  3. 401 Unauthorized: Invalid or missing token.
