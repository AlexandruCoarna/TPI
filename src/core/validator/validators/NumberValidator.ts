import {ValidatorInterface} from "./ValidatorInterface";

export class NumberValidator implements ValidatorInterface {
    public validate(value: any): string | boolean {
        const v = value.toString();
        const pattern = /^[0-9]+$/;

        if (!v.match(pattern)) {
            return "This field must contain only digits";
        }

        return true;
    }
}
