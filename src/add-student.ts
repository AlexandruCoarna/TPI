import {Form} from "./core/Form";
import {Validator} from "./core/Validator";


const addStudentForm = new Form(document.querySelector("#add-student"));

addStudentForm.getNativeform().onsubmit = (event: Event) => {
    event.preventDefault();
    const formControls = addStudentForm.getControls();
    const minLengthValidator = (value: any) => {
        if (value.length < 5) {
            return "This field must be at least 5 characters long";
        }
        return true;
    };

    const required = (value: any) => {
        if (!value) {
            return "This field is required";
        }
        return true;
    };
    new Validator(formControls.firstName, [required, minLengthValidator]);
    new Validator(formControls.lastName, [required, minLengthValidator]);
    new Validator(formControls.phoneNumber, [required]);
    new Validator(formControls.email, [required, minLengthValidator]);
    new Validator(formControls.country, [required]);
    new Validator(formControls.city, [required]);

    addStudentForm.getNativeform().reset();
};
