import {apiCall} from "./core/ApiCall";
import {CustomResponse} from "./core/models/CustomResponse";

const getStudents = async (filtered: boolean, criteria: string = '', value: string = '') => {
    let response: CustomResponse;

    if (!filtered) {
        response = await apiCall("/api/get-students", {
            method: "GET"
        });
    } else {
        response = await apiCall(`/api/get-filtered-students?${criteria}=${value}`, {
            method: "GET"
        });
    }

    if (!response.ok) {
        return;
    }

    const responseBody = response.getBody as { data: [] };

    if (responseBody.data.length) {
        renderStudentTable(responseBody.data)
    } else {
        renderEmptyStudents(true);
    }
};

const renderStudentTable = (students: []) => {
    renderEmptyStudents(false);
    let entriesPlaceholder: HTMLElement = document.querySelector("#student-entries-placeholder");
    entriesPlaceholder.style.display = 'none';
    let newHtml = '';
    const targets = document.querySelectorAll('tr[student-auto-inserted]');

    targets.forEach(target => {
        target.parentNode.removeChild(target);
    });

    students.forEach((student: {
        first_name: string
        last_name: string
        phone_number: string
        email: string
        personal_id_number: string
    }, index: number) => {
        newHtml += `
            <tr student-auto-inserted>
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
};

const renderEmptyStudents = (show: boolean) => {
    let emptyPlaceholder: HTMLElement = document.querySelector("#student-empty-placeholder");
    let studentTable: HTMLElement = document.querySelector("#student-list");
    emptyPlaceholder.style.width = "100%";
    emptyPlaceholder.style.textAlign = "center";

    if (show) {
        emptyPlaceholder.style.display = "block";
        emptyPlaceholder.innerHTML = "<h3>There are no registered students</h3>";
        studentTable.style.display = 'none';
    } else {
        studentTable.style.display = 'table';
        emptyPlaceholder.style.display = "none";
    }
};

const debounce = (func: () => void, delay: number) => {
    let debounceTimer: any;
    return function () {
        const context = this;
        const args = arguments;
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => func.apply(context, args), delay)
    }
};

const valueInput: HTMLInputElement = document.querySelector("#value");
const criteriaInput: HTMLSelectElement = document.querySelector("#criteria");

valueInput.onkeydown = debounce(async function () {
    await getStudents(true, criteriaInput.value, valueInput.value);
}, 500);

getStudents(false).then();
