import {FormControl} from "./models/FormControl";

export class Form {
    private readonly form: HTMLFormElement;
    private controls: { [key: string]: FormControl } = {};

    constructor(form: HTMLFormElement) {
        this.form = form;
        this.generateControls();
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

    private generateControls() {
        const formElements: HTMLFormControlsCollection = this.form.elements;
        for (let i = 0; i < formElements.length; i++) {
            let input: HTMLInputElement = formElements[i] as HTMLInputElement;

            if (input.type === 'submit') {
                continue;
            }

            this.controls[input.name] = new FormControl;
            this.controls[input.name]["nativeElement"] = input;
        }
    }
}
