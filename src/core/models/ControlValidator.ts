import {FormControl} from "./FormControl";

export class ControlValidator {
    control: FormControl;
    validators: ((value: any) => boolean | string)[]
}
