## json-db
- JSON DB for APIs Testing for Your Minimalist Project

## Installation

```bash
git clone https://github.com/codewithsushil/json-db.git
cd json-db
php -S localhost:8888
curl http://localhost:8888
```

## setup
```php
$db = new jsondb(__dir__);

```

## Post
```php
$db->post("users", [
   'id' => 1,
   'name' => 'jhon',
   'email' => 'jhon@example.com',
   'create_at' => '20:34:05:05:2025'
]);
```

## Get
```php
$db->get("users", true); // all data
$db->get("users", $id); // single data
```

## update
```php
$db->update("users",$id, [
    'name' => 'lily'
])
```

## delete
```php
$db->delete("users", $id);
```

## search or like?
```
$db->search('users','jhon');
```
