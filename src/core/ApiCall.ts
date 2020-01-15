import {CustomResponse} from "./models/CustomResponse";
import {VanillaToast} from "./models/VanillaToast";

declare const vanillaToast: VanillaToast;

export const apiCall = async (url: RequestInfo, options: RequestInit) => {
    const response = await fetch(url, options);

    const responseBody = await response.json() as { message: string };

    const customResponse: CustomResponse = response;
    customResponse.getBody = responseBody;

    if (!response.ok) {
        if (responseBody.message) {
            vanillaToast.error(responseBody.message, {duration: 5000});
        }
        return customResponse;
    }

    if (responseBody.message) {
        vanillaToast.success(responseBody.message, {duration: 5000});
    }

    return customResponse;
};
