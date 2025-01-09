export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    apellido1: string;
    apellido2: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};
