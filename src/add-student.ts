import {Form} from "./core/Form";
import {Validator} from "./core/Validator";
import {emailValidator, minLengthValidator, number, phoneNumberValidator, required} from "./validators";
import {apiCall} from "./core/ApiCall";
import {Student} from "./core/models/Student";

const addStudentForm = new Form(document.querySelector("#add-student"));

addStudentForm.getNativeform().onsubmit = async (event: Event) => {
    event.preventDefault();
    const formControls = addStudentForm.getControls();
    try {
        new Validator([
            {
                control: formControls.first_name,
                validators: [required, minLengthValidator]
            },
            {
                control: formControls.last_name,
                validators: [required, minLengthValidator]
            },
            {
                control: formControls.phone_number,
                validators: [required, phoneNumberValidator]
            },
            {
                control: formControls.email,
                validators: [required, emailValidator]
            },
            {
                control: formControls.personal_id_number,
                validators: [required, number]
            }
        ]);

        const student: Student = new Student();

        student.first_name = formControls.first_name.nativeElement.value;
        student.last_name = formControls.last_name.nativeElement.value;
        student.phone_number = formControls.phone_number.nativeElement.value;
        student.email = formControls.email.nativeElement.value;
        student.personal_id_number = formControls.personal_id_number.nativeElement.value;

        const response = await apiCall("/api/add-student", {
            body: JSON.stringify(student),
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            return;
        }

        addStudentForm.getNativeform().reset();
    } catch (e) {
        console.error(e);
    }
};
