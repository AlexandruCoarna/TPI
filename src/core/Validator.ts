import {ControlValidator} from "./models/ControlValidator";

export class Validator {
    private readonly controlValidators: ControlValidator[];

    constructor(controlValidators: ControlValidator[]) {
        this.controlValidators = controlValidators;
        this.validate();
    }

    private validate() {
        this.cleanErr();
        let valid = true;
        this.controlValidators.forEach((controlValidator: ControlValidator) => {
            const controlValue = controlValidator.control.nativeElement.value;
            const control = controlValidator.control;

            controlValidator.validators.forEach(validator => {
                const validated = validator(controlValue);
                if (validated !== true) {
                    control.nativeElement.style.border = "1px solid red";
                    control
                        .nativeElement
                        .insertAdjacentHTML(
                            "afterend",
                            `
                        <div class="${control.nativeElement.name}_err_element" 
                            style="color: red; padding: 0 5px 5px 5px;">
                            ${validated}
                        </div>`
                        );
                    valid = false;
                }
            });
        });

        if (!valid) {
            throw new Error("Validation Failed");
        } else {
            this.cleanErr();
        }
    }

    private cleanErr() {
        this.controlValidators.forEach((controlValidator: ControlValidator) => {
            controlValidator.control.nativeElement.style.border = controlValidator.control.initialElementState.style.border;
            const errElements = document.querySelectorAll(`.${controlValidator.control.nativeElement.name}_err_element`);
            if (errElements.length) {
                errElements.forEach(errElement => errElement.parentNode.removeChild(errElement))
            }
        });

    }
}
