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
        $student["phone_number"],
        $student["personal_id_number"]
    ]);

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    if (count($result)) {
        $message = '';

        if ($result[0]["phone_number"] === $student["phone_number"]) {
            $message .= "This phone number is already used <br>";
        }

        if ($result[0]["email"] === $student["email"]) {
            $message .= "This email is already used <br>";
        }

        if ($result[0]["personal_id_number"] === $student["personal_id_number"]) {
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
        $student['first_name'],
        $student['last_name'],
        $student['phone_number'],
        $student['email'],
        $student['personal_id_number'],
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

    $criteria = array_key_first($request->queryParams);

    if (!in_array($criteria, [
        "first_name",
        "last_name",
        "phone_number",
        "email",
        "personal_id_number"
    ])) {
        $response = [
            "ok" => false,
            "message" => "Invalid criteria!"
        ];
        return new JsonResponse($response, 400);
    }

    $value = $request->queryParams[$criteria];
    $conn = Container::get("database")->getConnection();
    $column = explode("'", $conn->quote($criteria))[1];
    $value = $conn->quote("%$value%");

    if (!$value) {
        $stm = $conn->prepare("select * from student");
    } else {
        $stm = $conn->prepare("select * from student where $column like $value");
    }

    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    $response = [
        "ok" => true,
        "data" => $result
    ];

    return new JsonResponse($response);
});

Router::post("/api/delete-student", function (Request $request) {
    /* @var $conn PDO */

    $pid = $request->queryParams["pid"];

    $conn = Container::get("database")->getConnection();
    $stm = $conn->prepare("delete from student where student.personal_number_id = ?");
    $stm->execute([$pid]);

    $response = [
        "ok" => true,
        "message" => "Successfully deleted student"
    ];

    return new JsonResponse($response);
});
