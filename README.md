![JsonDB](/art/jsondb.png)

[![Tests](https://github.com/CodeWithSushil/json-db/actions/workflows/tests.yml/badge.svg)](https://github.com/CodeWithSushil/json-db/actions/workflows/tests.yml)

JsonDB: Lightweight document container.

___

### Example
Full example of json db
```php
<?

require "vendor/autoload.php";

use App\JSONDatabase;

$path = 'data/users.json';

$db = new JSONDatabase($path);

$data = [
   'id' => 1,
   'name' => 'Sushil',
   'age' => 23,
   'dev' => true,
   'lang' => ['php','javascript','sql']
];

// post data
$db->write($data);

// fetch data
$result = $db->read();

echo "<pre>";
print_r($result);
echo "</pre>";

```

