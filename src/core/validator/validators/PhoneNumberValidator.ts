import {ValidatorInterface} from "./ValidatorInterface";

export class PhoneNumberValidator implements ValidatorInterface {
    validate(value: any) {
        const v = value.toString();
        const pattern = /^\d{10}$/;

        if (!v.match(pattern)) {
            return "Phone number must be a 10 digit long string with no spaces or any other characters";
        }

        return true;
    }
}