import {ValidatorInterface} from "./ValidatorInterface";

export class EmailValidator implements ValidatorInterface {
    validate(value: any) {
        if (/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
            return true;
        }
        return "Invalid email address";
    }
}