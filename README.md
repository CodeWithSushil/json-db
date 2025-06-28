![JsonDB](/art/jsondb.png)

[![Tests](https://github.com/CodeWithSushil/json-db/actions/workflows/tests.yml/badge.svg)](https://github.com/CodeWithSushil/json-db/actions/workflows/tests.yml)
![Packagist Version](https://img.shields.io/packagist/v/jsondbphp/jsondb?style=flat&logo=composer&logoColor=%23fff)
![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/jsondbphp/jsondb/php?style=flat&logo=php&logoColor=blue&label=PHP&color=lime)
![Packagist License](https://img.shields.io/packagist/l/jsondbphp/Jsondb?style=flat&label=License&color=blue)
![Packagist Downloads](https://img.shields.io/packagist/dt/jsondbphp/Jsondb?style=flat&label=Downloads&color=blue)
![Packagist Stars](https://img.shields.io/packagist/stars/jsondbphp/jsondb?style=flat&logo=packagist&logoColor=%23ffffff&label=%F0%9F%8C%9F%20Stars)


**JsonDB** is a lightweight, document-oriented NoSQL-style database written in PHP. It provides a simple, file-based alternative to traditional databases by storing and managing data as structured JSON files. JsonDB is perfect for lightweight apps, prototyping, local storage, and embedded tools where a full-fledged database system is unnecessary.

---

## 🚀 Features

- ⚡ **Zero-Config:** No database server or setup needed—just PHP and your filesystem.
- 🧩 **Document-Based:** Each collection is a JSON file; each record is a structured JSON document.
- 🧪 **CRUD Operations:** Easy-to-use API for create, read, update, and delete operations.
- 🕵️‍♂️ **Search & Filter:** Built-in query capabilities using associative arrays and conditions.
- [x] Coming soon
- 🔐 **JWT & Session Authentication:** Secure API with optional login/auth guard.
- 🌐 **REST API Wrapper:** JSON RESTful interface for HTTP clients.
- 🗃️ **Transactions & Atomic Writes:** Prevents data corruption with locking mechanisms.
- 🔁 **Replication & Backup Support:** Optional add-ons for syncing and restoring data.
- 🧰 **CLI Tools:** Perform operations via command line using Symfony Console.
- 🧠 **In-memory Caching:** Fast reads with optional caching for large JSON datasets.
- 🧾 **Indexing (Planned):** For quicker lookups and searches on large datasets.

---

## 📦 Why Use JsonDB?

- ✅ **Simple:** No external dependencies, DB servers, or complex setup.
- ✅ **Portable:** Just include it in your project—works anywhere PHP runs.
- ✅ **Human-Readable:** JSON files are easy to read, edit, version-control, and debug.
- ✅ **Great for Prototyping:** Ideal for testing APIs, local apps, and building offline tools.
- ✅ **Customizable:** Built in modern PHP (PHP 8.4+), uses OOP, Traits, Enums, and Interfaces.

---

## 💡 Use Cases

- 🔧 Rapid API Prototyping
- 🗃 Offline Data Storage
- 🧪 Test Mock Databases
- 🛠 Configuration/Settings Store
- 🎮 Game Save/State Files
- 🌐 Lightweight Backend for SPA/JS apps
- 💻 CLI Data Manipulation Tools

---

## 🧑‍💻 How It Works

#### Install

```bash
composer require jsondbphp/jsondb
```

#### Example

```php

// index.php

require("vendor/autoload.php"):

use Json\Database;

// Create DB instance
$db = new JsonDB(__DIR__ . '/data');

// Insert
$id = $db->collection('users')->insert([
    'name' => 'Alice',
    'email' => 'alice@example.com'
]);

// Find
$user = $db->collection('users')->find($id);

// Update
$db->collection('users')->update($id, ['email' => 'new@example.com']);

// Delete
$db->collection('users')->delete($id);
```

---
