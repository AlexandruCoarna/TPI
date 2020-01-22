export interface ValidatorInterface {
    validate: (value: any) => string | boolean;
}