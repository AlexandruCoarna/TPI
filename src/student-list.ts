import {apiCall} from "./core/ApiCall";
import {Student} from "./core/models/Student";

const getStudents = async (filtered: boolean, criteria: string = '', value: string = '') => {

    const url = filtered ? `/api/get-filtered-students?${criteria}=${value}` : "/api/get-students";
    const response = await apiCall(url, {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        }
    });

    if (!response.ok) {
        return;
    }

    const responseBody = response.getBody as { data: Student[] };
    responseBody.data.length ? renderStudentTable(responseBody.data) : renderEmptyStudents(true);
};

const renderStudentTable = (students: Student[]) => {
    renderEmptyStudents(false);
    let entriesPlaceholder: HTMLElement = document.querySelector("#student-entries-placeholder");
    let newHtml = '';
    const targets = document.querySelectorAll('tr[student-auto-inserted]');

    targets.forEach(target => {
        target.parentNode.removeChild(target);
    });

    students.forEach((student: Student, index: number) => {
        newHtml += `
            <tr student-auto-inserted>
                <td>${index + 1}</td>
                <td>${student.first_name}</td>
                <td>${student.last_name}</td>
                <td>${student.phone_number}</td>
                <td>${student.email}</td>
                <td>${student.personal_id_number}</td>
                <td>
                    <button class="delete-button" onclick="deleteStudent(${student.personal_id_number});">
                        Delete
                    </button>
                </td>
             </tr>
        `;
    });
    entriesPlaceholder.insertAdjacentHTML('afterend', newHtml);
};

const renderEmptyStudents = (show: boolean) => {
    let emptyPlaceholder: HTMLElement = document.querySelector("#student-empty-placeholder");
    let studentTable: HTMLElement = document.querySelector("#student-list");

    if (show) {
        studentTable.style.display = 'none';
        emptyPlaceholder.style.display = "block";
    } else {
        emptyPlaceholder.style.display = "none";
        studentTable.style.display = 'table';
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

criteriaInput.onchange = async () => {
    valueInput.value = '';
    await getStudents(true, criteriaInput.value);
};

const deleteStudent = async (studentPid: number) => {
    if (confirm(`Are you sure you want to delete the student with Personal Number Id: ${studentPid}?`)) {
        const response = await apiCall(`/api/delete-student`, {
            method: "DELETE",
            body: JSON.stringify({pid: studentPid}),
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            return;
        }

        const valueInput: HTMLInputElement = document.querySelector("#value");
        const criteriaInput: HTMLSelectElement = document.querySelector("#criteria");
        await getStudents(true, criteriaInput.value, valueInput.value);
    }
};

(<any>window).deleteStudent = deleteStudent;

getStudents(false).then();
