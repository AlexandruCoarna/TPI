import {Form} from "./core/Form";
import {FormValidator} from "./core/validator/FormValidator";
import {apiCall} from "./core/ApiCall";
import {Student} from "./core/models/Student";

const addStudentForm = new Form(document.querySelector("#add-student"));

addStudentForm.getNativeform().onsubmit = async (event: Event) => {
    event.preventDefault();

    const formControls = addStudentForm.getControls();
    const formValidator = new FormValidator(formControls);

    formValidator.validate(formControls.first_name, [formValidator.required]);
    formValidator.validate(formControls.last_name, [formValidator.required]);
    formValidator.validate(formControls.phone_number, [formValidator.required, formValidator.phoneNumber]);
    formValidator.validate(formControls.email, [formValidator.required, formValidator.email]);
    formValidator.validate(formControls.personal_id_number, [formValidator.required, formValidator.number]);

    if (!formValidator.valid) {
        return;
    }

    const student: Student = new Student(
        formControls.first_name.nativeElement.value,
        formControls.last_name.nativeElement.value,
        formControls.phone_number.nativeElement.value,
        formControls.email.nativeElement.value,
        formControls.personal_id_number.nativeElement.value,
    );

    const response = await apiCall("/api/add-student", {
        body: JSON.stringify(student),
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        }
    });

    if (!response.ok) {
        const responseBody = response.getBody as { data: { [key: string]: string[] } };
        Object.keys(responseBody.data).forEach(control => {
            responseBody.data[control].forEach(errMsg => {
                formValidator.exposeControlErr(formControls[control], errMsg);
            });
        });

        return;
    }

    addStudentForm.getNativeform().reset();
};
