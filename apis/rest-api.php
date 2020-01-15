<?php

use Core\{Container, Request, Response\JsonResponse, Router};

Router::post("/api/add-student", function (Request $request) {
    /* @var $conn PDO */

    $student = $request->body;

    foreach ($student as $key => $value) {
        $student[$key] = htmlspecialchars($value, ENT_NOQUOTES);
    }

    $conn = Container::get("database")->getConnection();

    $stm = $conn->prepare(
        "select * from student where email = ? or phone_number = ? or personal_id_number = ? limit 1"
    );

    $stm->execute([
        $student["email"],
        $student["phoneNumber"],
        $student["personalIdNumber"]
    ]);

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    if (count($result)) {
        $message = '';

        if ($result[0]["phone_number"] === $student["phoneNumber"]) {
            $message .= "This phone number is already used <br>";
        }

        if ($result[0]["email"] === $student["email"]) {
            $message .= "This email is already used <br>";
        }

        if ($result[0]["personal_id_number"] === $student["personalIdNumber"]) {
            $message .= "This personal id number is already used <br>";
        }

        return new JsonResponse([
            "message" => $message,
            "ok" => false
        ], 400);
    }

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
        "ok" => true,
        "message" => "Successfully added!"
    ];

    return new JsonResponse($response);
});

Router::get("/api/get-students", function () {
    /* @var $conn PDO */

    $conn = Container::get("database")->getConnection();
    $stm = $conn->prepare("select * from student");
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    $response = [
        "ok" => true,
        "data" => $result
    ];

    return new JsonResponse($response);
});

Router::get("/api/get-filtered-students", function (Request $request) {
    /* @var $conn PDO */

    $acceptedTables = [
        "first_name",
        "last_name",
        "phone_number",
        "email",
        "personal_id_number"
    ];

    $criteria = array_key_first($request->queryParams);

    if (!in_array($criteria, $acceptedTables)) {
        $response = [
            "ok" => false,
            "message" => "Invalid criteria!"
        ];
        return new JsonResponse($response, 400);
    }

    $value = $request->queryParams[$criteria];
    $conn = Container::get("database")->getConnection();
    $column = $conn->quote($criteria);
    $value = $conn->quote("%$value%");
    $c = '';

    for ($i = 1; $i < strlen($column) - 1; $i++) {
        $c .= $column[$i];
    }

    if (!$value) {
        $stm = $conn->prepare("select * from student");
    } else {
        $stm = $conn->prepare("select * from student where $c like {$value}");
    }

    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    $response = [
        "ok" => true,
        "data" => $result
    ];

    return new JsonResponse($response);
});
