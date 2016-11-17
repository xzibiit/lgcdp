<?php
// $app->get('/', function($request, $response, $args){
// 	$response->write("Hello World");
// 	return $response;
// });

// $app->get('/sm', function($request, $response, $args){
// 	$dbhandler = $this->db;
// 	$stmt = $dbhandler->prepare('SELECT * FROM tbl_sm WHERE district_id = 102');
// 	$stmt->execute();
// 	$response->withJson($stmt->fetchAll(),  201)->withHeader('Content-Type', 'application/json');
// 	return $response;
// });

$app->group('/api/db/schema', function () {
    $this->get('/table', function ($request, $response, $args) {
    	$dbhandler = $this->db;
		$stmt = $dbhandler->prepare('SHOW TABLES');
		$stmt->execute();
		$response->withJson($stmt->fetchAll(),  201)->withHeader('Content-Type', 'application/json');
		return $response;
        
    });

    $this->get('/{tblName}', function ($request, $response, $args) {
    	$tblName = $request->getAttribute('tblName');
    	$dbhandler = $this->db;
		$stmt = $dbhandler->prepare("DESCRIBE $tblName");
		$stmt->execute();
		$response->withJson($stmt->fetchAll(),  201)->withHeader('Content-Type', 'application/json');
		return $response;
        
    });
});
