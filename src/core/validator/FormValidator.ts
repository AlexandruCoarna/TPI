import {FormControl} from "../models/FormControl";
import {ValidatorInterface} from "./validators/ValidatorInterface";
import {ValidatorList} from "./ValidatorList";

export class FormValidator extends ValidatorList {
    private validStatus: boolean = true;

    constructor(private readonly controls: { [key: string]: FormControl }) {
        super();
        Object.values(this.controls).forEach(control => FormValidator.clearErr(control));
    }

    public get valid(): boolean {
        return this.validStatus;
    }

    private static clearErr(control: FormControl) {
        control.nativeElement.classList.remove("error-highlight");
        const errElements = document.querySelectorAll(`.${control.nativeElement.name}_err_element_234297`);

        if (errElements.length) {
            errElements.forEach(errElement => errElement.parentNode.removeChild(errElement))
        }
    }

    private static addErr(control: FormControl, errMsg: string) {
        const element = `
            <div class="${control.nativeElement.name}_err_element_234297 error-msg"> 
               <small>${errMsg}</small> 
            </div> `;

        control.nativeElement.classList.add("error-highlight");
        control.nativeElement.insertAdjacentHTML("beforebegin", element);
    }

    public validate(control: FormControl, validators: ValidatorInterface[]) {
        const controlValue = control.nativeElement.value;
        FormValidator.clearErr(control);

        validators.forEach(validator => {
            const validated = validator.validate(controlValue);

            if (validated !== true) {
                FormValidator.addErr(control, validated as string);
                this.validStatus = false;
            }
        })
    }

    public exposeControlErr(control: FormControl, errMsg: string) {
        FormValidator.addErr(control, errMsg);
    }
}
