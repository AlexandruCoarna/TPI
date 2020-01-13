import {FormControl} from "./models/FormControl";

export class Validator {
    private readonly formControl: FormControl;
    private readonly validators: ((value: any) => boolean | string)[];

    constructor(formControl: FormControl, validators: ((value: any) => boolean | string)[]) {
        this.formControl = formControl;
        this.validators = validators;
        try {
            this.validate();
        } catch (e) {
            console.error(e.stack);
        }
    }

    private validate() {
        this.validators.forEach(validator => {
            const validated = validator(this.formControl.nativeElement.value);
            if (validated !== true) {
                this.formControl.nativeElement.style.border = "1px solid red";
                this.formControl
                    .nativeElement
                    .insertAdjacentHTML(
                        "afterend",
                        `
                        <div id="${this.formControl.nativeElement.name}_err_element" 
                            style="color: red; padding: 0 5px 5px 5px;">
                            ${validated}
                        </div>`
                    );
                throw new Error(validated as string);
            } else {
                const errElement = document.querySelector(`#${this.formControl.nativeElement.name}_err_element`);
                if (errElement) {
                    this.formControl.nativeElement.style.border = this.formControl.initialElementState.style.border;
                    errElement.parentNode.removeChild(errElement);
                }
            }
        });
    }
}
