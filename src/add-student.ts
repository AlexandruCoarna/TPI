class Form {
    private readonly form: HTMLFormElement;
    private controls: { [key: string]: FormControl } = {};

    constructor(form: HTMLFormElement) {
        this.form = form;
        this.generateControls();
    }

    private generateControls() {
        const formElements: HTMLFormControlsCollection = this.form.elements;
        for (let i = 0; i < formElements.length; i++) {
            let input: HTMLInputElement = formElements[i] as HTMLInputElement;
            if (input.type !== 'submit') {
                this.controls[input.name] = new FormControl;
                this.controls[input.name]["nativeElement"] = input;
                this.controls[input.name]["initialElementState"] = input.cloneNode(true) as HTMLInputElement;
            }
        }
    }

    public getControls() {
        return this.controls;
    }

    public getNativeform(): HTMLFormElement {
        return this.form;
    }

    public getControl(name: string) {
        return this.controls[name];
    }
}

class Validator {
    private readonly formControl: FormControl;
    private readonly validators: ((value: any) => boolean | string)[];

    constructor(formControl: FormControl, validators: ((value: any) => boolean | string)[]) {
        this.formControl = formControl;
        this.validators = validators;
        this.validate();
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
                this.formControl.nativeElement.style.border = this.formControl.initialElementState.style.border;
                const errElement = document.querySelector(`#${this.formControl.nativeElement.name}_err_element`);
                errElement.parentNode.removeChild(errElement);
            }
        });
    }
}

class FormControl {
    nativeElement: HTMLInputElement;
    initialElementState: HTMLInputElement
}

const addStudentForm = new Form(document.querySelector("#add-student"));

addStudentForm.getNativeform().onsubmit = (event: Event) => {
    event.preventDefault();
    const formControls = addStudentForm.getControls();
    const minLengthValidator = (value: any) => {
        if (value.length < 5) {
            return "Minimum length is 5 characrers";
        }
        return true;
    };
    new Validator(formControls.firstName, [minLengthValidator]);
    console.log(1);
};
