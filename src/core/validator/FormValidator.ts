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
        control.nativeElement.style.border = control.initialElementState.style.border;
        const errElements = document.querySelectorAll(`.${control.nativeElement.name}_err_element`);
        if (errElements.length) {
            errElements.forEach(errElement => errElement.parentNode.removeChild(errElement))
        }
    }

    private static addErr(control: FormControl, errMsg: string) {
        const element = `
            <div class="${control.nativeElement.name}_err_element" style="color: #ff4c4c; padding: 0 5px 5px 5px;"> 
               <small>${errMsg}</small> 
            </div> `;

        control.nativeElement.style.border = "1px solid red";

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
