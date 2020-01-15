const getStudents = async () => {
    const repsonse = await fetch("/api/get-students", {
        method: "GET"
    });

    const responseBody = await repsonse.json() as { data: [] };

    if (!repsonse.ok) {
        return;
    }

    let entriesPlaceholder: HTMLElement = document.querySelector("#student-entries-placeholder");
    entriesPlaceholder.style.display = 'none';
    let newHtml = '';

    if (responseBody.data.length) {
        responseBody.data.forEach((student: any, index: number) => {
            newHtml += `
            <tr>
                <td>${index + 1}</td>
                <td>${student.first_name}</td>
                <td>${student.last_name}</td>
                <td>${student.phone_number}</td>
                <td>${student.email}</td>
                <td>${student.personal_id_number}</td>
             </tr>
        `;
        });
        entriesPlaceholder.insertAdjacentHTML('afterend', newHtml);
    }
};

getStudents().then();
