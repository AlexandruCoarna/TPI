import {EmailValidator} from "./validators/EmailValidator";
import {NumberValidator} from "./validators/NumberValidator";
import {RequiredValidator} from "./validators/RequiredValidator";
import {PhoneNumberValidator} from "./validators/PhoneNumberValidator";

export class ValidatorList {
    public get email() {
        return new EmailValidator();
    }

    public get number() {
        return new NumberValidator();
    }

    public get required() {
        return new RequiredValidator();
    }

    public get phoneNumber() {
        return new PhoneNumberValidator();
    }
}