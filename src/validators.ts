export const minLengthValidator = (value: any) => {
    if (value.length < 3) {
        return "This field must be at least 3 characters long";
    }
    return true;
};

export const required = (value: any) => {
    if (!value || value === '' || value === undefined || value === null) {
        return "This field is required";
    }
    return true;
};

export const phoneNumberValidator = (value: any) => {
    const v = value as string;
    const pattern = /^\d{10}$/;

    if (!v.match(pattern)) {
        return "Phone number must be a 10 digit long string with no spaces or any other characters";
    }

    return true;
};

export const emailValidator = (value: any) => {
    if (/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
        return true;
    }
    return "Invalid email address";
};

export const number = (value: any) => {
    const v = value as string;
    const pattern = /^[0-9]*$/;

    if (!v.match(pattern)) {
        return "Personal Id Numner must contain only digits";
    }

    return true;
};
