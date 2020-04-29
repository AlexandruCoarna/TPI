<?php

use Core\{Container, Request, response\JsonResponse, Router};
use Services\validator\FormValidator;

Router::post("/api/add-student", function (Request $request) {
    /* @var $conn PDO
     * @var $formValidator FormValidator
     */

    $student = $request->body;

    foreach ($student as $key => $value) {
        $student[$key] = htmlspecialchars($value, ENT_NOQUOTES);
    }

    $formValidator = Container::get("formValidator");

    $formValidator->validate("first_name", $student["first_name"], [$formValidator->required()]);
    $formValidator->validate("last_name", $student["last_name"], [$formValidator->required()]);
    $formValidator->validate("phone_number", $student["phone_number"], [$formValidator->required(), $formValidator->phoneNumber()]);
    $formValidator->validate("email", $student["email"], [$formValidator->required(), $formValidator->email()]);
    $formValidator->validate("personal_id_number", $student["personal_id_number"], [$formValidator->required(), $formValidator->number()]);

    $formValidator->checkControlAlreadyExists(
        "student",
        [
            "email",
            "phone_number",
            "personal_id_number"
        ],
        [
            $student["email"],
            $student["phone_number"],
            $student["personal_id_number"]
        ]
    );

    if (count($formValidator->getErrors())) {
        return new JsonResponse([
            "data" => $formValidator->getErrors()
        ], 400);
    }

    $conn = Container::get("database")->getConnection();

    $stm = $conn->prepare(
        "INSERT INTO student (first_name,last_name,phone_number,email,personal_id_number) VALUES (?,?,?,?,?)"
    );

    $stm->execute([
        $student['first_name'],
        $student['last_name'],
        $student['phone_number'],
        $student['email'],
        $student['personal_id_number'],
    ]);

    $response = [
        "message" => "Successfully added!"
    ];

    return new JsonResponse($response);
});

Router::get("/api/get-students", function () {
    /* @var $conn PDO */

    $conn = Container::get("database")->getConnection();
    $stm = $conn->prepare("SELECT * FROM student");
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    $response = [
        "data" => $result
    ];

    return new JsonResponse($response);
});

Router::get("/api/get-filtered-students", function (Request $request) {
    /* @var $conn PDO */

    if (!count($request->queryParams)) {
        throw  new Error("No criteria set");
    }

    $criteria = array_key_first($request->queryParams);

    if (!in_array($criteria, [
        "first_name",
        "last_name",
        "phone_number",
        "email",
        "personal_id_number"
    ])) {
        throw new Error("Invalid criteria");
    }

    $value = $request->queryParams[$criteria];
    $conn = Container::get("database")->getConnection();
    $column = explode("'", $conn->quote($criteria))[1];
    $value = $conn->quote("%$value%");

    if (!$value) {
        $stm = $conn->prepare("SELECT * FROM student");
    } else {
        $stm = $conn->prepare("SELECT * FROM student WHERE $column LIKE $value");
    }

    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    $response = [
        "data" => $result
    ];

    return new JsonResponse($response);
});

Router::delete("/api/delete-student", function (Request $request) {
    /* @var $conn PDO */

    $pid = $request->body["pid"];

    $conn = Container::get("database")->getConnection();
    $stm = $conn->prepare("DELETE FROM student WHERE `personal_id_number` = ?");
    $stm->execute([$pid]);

    $response = [
        "message" => "Successfully deleted student"
    ];

    return new JsonResponse($response);
});
