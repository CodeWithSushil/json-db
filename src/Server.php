<?php
namespace App;

 use App\JSONServer;
 use App\JSONDatabas;

class Server
{
  public function __construct()
  {
    $dataFile = 'data.json';
    
    try {
      $db = new JSONDatabase($dataFile);
      $server = new JSONServer($db);
      $server->handleRequest();
    } catch (Exception $e) {
      http_response_code(500);
      echo json_encode(['error' => 'Internal Server Error', 'message' => $e->getMessage()]);
    }
  }
}
