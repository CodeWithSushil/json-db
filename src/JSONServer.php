<?php
namespace App;

class JSONServer {
    private $db;

    public function __construct(JSONDatabase $db) {
        $this->db = $db;
    }

    public function handleRequest() {
        // Set secure headers
        $this->setSecurityHeaders();

        // Handle requests
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $this->handleGet();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->handlePost();
            } else {
                $this->sendResponse(['error' => 'Method not allowed'], 405);
            }
        } catch (Exception $e) {
            $this->sendResponse(['error' => $e->getMessage()], 400);
        }
    }

    private function handleGet() {
        $data = $this->db->read();
        $this->sendResponse($data);
    }

    private function handlePost() {
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;

        if (!$name || !$email) {
            throw new Exception("Name and email are required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address.");
        }

        $newUser = $this->db->addUser($name, $email);
        $this->sendResponse(['message' => 'User added successfully!', 'user' => $newUser]);
    }

    private function sendResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    private function setSecurityHeaders() {
        header('Content-Type: application/json');
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
        header('Referrer-Policy: no-referrer');
        header('Permissions-Policy: geolocation=(), camera=(), microphone=()');
    }
}
