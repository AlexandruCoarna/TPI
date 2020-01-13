const onAddStudentsubmit = (event: Event) => {
    event.preventDefault();
    const formControls = new Form(event.target as HTMLFormElement).getControls();
    const minLengthValidator = (value: any) => {
        if (value.length < 5) {
            return "Minimum length is 5 characrers";
        }
        return true;
    };
    new Validator(formControls.firstName, [minLengthValidator])
};


class Form {
    private form: HTMLFormElement;
    private controls: { [key: string]: HTMLInputElement } = {};

    constructor(form: HTMLFormElement) {
        this.form = form;
        this.generateControls();
    }

    private generateControls() {
        const formElements: HTMLFormControlsCollection = this.form.elements;
        for (let i = 0; i < formElements.length; i++) {
            let input: HTMLInputElement = formElements[i] as HTMLInputElement;
            if (input.type !== 'submit') {
                console.log(input.validity);
                this.controls[input.name] = input;
                this.removeErrElement(input);
            }
        }
    }

    private removeErrElement(input: HTMLInputElement) {
        const errElement = document.querySelector(`#${input.name}_err_element`);
        if (errElement) {
            errElement.parentNode.removeChild(errElement);
        }
    }

    public getControls() {
        return this.controls;
    }
}

class Validator {
    private readonly iniput: HTMLInputElement;
    private readonly validators: ((value: any) => boolean | string)[];

    constructor(input: HTMLInputElement, validators: ((value: any) => boolean | string)[]) {
        this.iniput = input;
        this.validators = validators;
        this.validate();
    }

    private validate() {
        this.validators.forEach(validator => {
            const validated = validator(this.iniput.value);
            const initialBorderStyle = this.iniput.style.border;
            if (validated !== true) {
                this.iniput.style.border = "1px solid red";
                this.iniput.insertAdjacentHTML("afterend", "<div id='" + this.iniput.name + "_err_element' style='color: red'>" + validated + "</div>");
                throw new Error(validated as string);
            } else {
                this.iniput.style.border = initialBorderStyle;
            }
        });
    }
}
