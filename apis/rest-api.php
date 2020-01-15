<?php

use Core\{Container, Request, Response\JsonResponse, Router};

Router::post("/api/add-student", function (Request $request) {
    /* @var $conn PDO */

    $student = $request->body;

    $empty = false;

    foreach ($student as $key => $value) {
        if (!$value) {
            $empty = true;
        }

        $student[$key] = htmlspecialchars($value, ENT_NOQUOTES);
    }

    if ($empty) {
        return new JsonResponse([
            "message" => "All fields are required, no empty fields allowed!",
            "ok" => false
        ], 400);
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
