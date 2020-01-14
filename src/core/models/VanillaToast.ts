export interface VanillaToast {
    success: (arg: any, args: any) => void,
    error: (arg: any, args: any) => void
}

export declare const vanillaToast: VanillaToast;
