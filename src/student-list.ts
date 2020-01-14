const getStudents = async () => {
    const repsonse = await fetch("/api/get-students", {
        method: "GET"
    });

    const responseBody = await repsonse.json() as { data: [] };

    if (!repsonse.ok) {
        return;
    }

    const table = document.querySelector("#student-list");
    const initialTableHtml = table.innerHTML;
    let newHtml = '';

    console.log(responseBody);
    responseBody.data.forEach((student: any, index: number) => {
        newHtml += `
            <tr>
                <td>${index + 1}</td>
                <td>${student.first_name}</td>
                <td>${student.last_name}</td>
                <td>${student.phone_number}</td>
                <td>${student.email}</td>
                <td>${student.country}</td>
                <td>${student.city}</td>
             </tr>
        `;
    });
    table.innerHTML = initialTableHtml + newHtml;
};

getStudents().then();
