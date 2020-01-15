import {Form} from "./core/Form";
import {Validator} from "./core/Validator";
import {emailValidator, minLengthValidator, phoneNumberValidator, required} from "./validators";
import {apiCall} from "./core/ApiCall";
import {Student} from "./core/models/Student";

const addStudentForm = new Form(document.querySelector("#add-student"));

addStudentForm.getNativeform().onsubmit = async (event: Event) => {
    event.preventDefault();
    const formControls = addStudentForm.getControls();
    try {
        new Validator([
            {
                control: formControls.firstName,
                validators: [required, minLengthValidator]
            },
            {
                control: formControls.lastName,
                validators: [required, minLengthValidator]
            },
            {
                control: formControls.phoneNumber,
                validators: [required, phoneNumberValidator]
            },
            {
                control: formControls.email,
                validators: [required, emailValidator]
            },
            {
                control: formControls.personalIdNumber,
                validators: [required]
            }
        ]);

        const student: Student = new Student();

        student.first_name = formControls.firstName.nativeElement.value;
        student.last_name = formControls.lastName.nativeElement.value;
        student.phone_number = formControls.phoneNumber.nativeElement.value;
        student.email = formControls.email.nativeElement.value;
        student.personal_id_number = formControls.personalIdNumber.nativeElement.value;

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
