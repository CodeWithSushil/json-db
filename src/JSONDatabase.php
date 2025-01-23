<?php
namespace App;
use Exception;

class JSONDatabase {
    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;

        // Create the JSON file if it doesn't exist
        if (!file_exists($filePath)) {
            file_put_contents($filePath, json_encode(['users' => []], JSON_PRETTY_PRINT));
        }
    }

    // Read JSON data
    public function read() {
        $content = file_get_contents($this->filePath);
        if ($content === false) {
            throw new Exception("Unable to read JSON file.");
        }

        $data = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Invalid JSON format: " . json_last_error_msg());
        }

        return $data;
    }

    // Write JSON data with file locking
    public function write(array $data) {
        $json = json_encode($data, JSON_PRETTY_PRINT);
        if ($json === false) {
            throw new Exception("Failed to encode data to JSON: " . json_last_error_msg());
        }

        $file = fopen($this->filePath, 'c+');
        if (!$file) {
            throw new Exception("Failed to open file: {$this->filePath}");
        }

        // Acquire an exclusive lock
        if (!flock($file, LOCK_EX)) {
            fclose($file);
            throw new Exception("Could not lock file: {$this->filePath}");
        }

        // Truncate the file before writing new content
        ftruncate($file, 0);
        if (fwrite($file, $json) === false) {
            flock($file, LOCK_UN);
            fclose($file);
            throw new Exception("Failed to write to file: {$this->filePath}");
        }

        // Release the lock and close the file
        flock($file, LOCK_UN);
        fclose($file);
    }

    // Add a user to the JSON database
    public function addUser(string $name, string $email) {
        $data = $this->read();

        // Check for duplicate emails
        foreach ($data['users'] as $user) {
            if ($user['email'] === $email) {
                throw new Exception("Email already exists.");
            }
        }

        // Sanitize inputs
        $newUser = [
            'id' => count($data['users']) + 1,
            'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            'email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8')
        ];

        $data['users'][] = $newUser;
        $this->write($data);

        return $newUser;
    }
}
