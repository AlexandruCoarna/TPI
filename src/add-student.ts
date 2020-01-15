import {Form} from "./core/Form";
import {Validator} from "./core/Validator";
import {emailValidator, minLengthValidator, phoneNumberValidator, required} from "./validators";
import {VanillaToast} from "./core/models/VanillaToast";

declare const vanillaToast: VanillaToast;

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
        const student: { [key: string]: any } = {};

        Object.keys(formControls).forEach(key => {
            student[key] = formControls[key].nativeElement.value;
        });

        const response = await fetch("/api/add-student", {
            body: JSON.stringify(student),
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const responseBody = await response.json() as { message: string };

        if (!response.ok) {
            vanillaToast.error(responseBody.message, {duration: 2000});
            return;
        }

        console.log(vanillaToast);

        vanillaToast.success(responseBody.message, {duration: 2000});

        addStudentForm.getNativeform().reset();
    } catch (e) {
        console.error(e);
    }

};
