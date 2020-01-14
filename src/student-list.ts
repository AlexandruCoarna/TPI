const getStudents = async () => {
    const repsonse = await fetch("/api/get-students", {
        method: "GET"
    });

    const responseBody = await repsonse.json();

    if (!repsonse.ok) {
        return;
    }

    console.log(responseBody);
};

getStudents().then();
