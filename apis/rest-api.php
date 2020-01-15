<?php

use Core\{Container, Request, Response\JsonResponse, Router};

Router::post("/api/add-student", function (Request $request) {
    /* @var $conn PDO */;

    $student = $request->body;

    $conn = Container::get("database")->getConnection();

    $stm = $conn->prepare(
        "insert into student (first_name,last_name,phone_number,email,personal_id_number)values(?,?,?,?,?)"
    );

    $stm->execute([
        $student['firstName'],
        $student['lastName'],
        $student['phoneNumber'],
        $student['email'],
        $student['personalIdNumber'],
    ]);

    $response = [
        "success" => true,
        "message" => "Successfully added!"
    ];

    return new JsonResponse($response);
});

Router::get("/api/get-students", function (Request $request) {
    /* @var $conn PDO */;

    $conn = Container::get("database")->getConnection();
    $stm = $conn->prepare("select * from student");
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    $response = [
        "success" => true,
        "data" => $result
    ];

    return new JsonResponse($response);
});
