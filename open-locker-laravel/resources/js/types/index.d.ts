export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export type Locker = {
    id: number;
    designation: string;
    last_opened_at: Date;
    content: TLockerItem;
    is_open: boolean;
    created_at: Date;
    updated_at: Date;
}

export type Station = {
    id: number;
    name: string;
    lockers: Locker[];
    created_at: Date;
    updated_at: Date;
}

export type TLockerItem = {
    id: number;
    name: string;
    user_id: number | null;
    created_at: Date;
    updated_at: Date;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};
