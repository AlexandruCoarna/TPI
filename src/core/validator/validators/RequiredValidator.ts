import {ValidatorInterface} from "./ValidatorInterface";

export class RequiredValidator implements ValidatorInterface {
    validate(value: any) {
        if (!value || value === '' || value === undefined || value === null) {
            return "This field is required";
        }
        return true;
    }
}