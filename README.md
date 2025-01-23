## json-db
- JSON DB for APIs Testing for Your Minimalist Project

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

