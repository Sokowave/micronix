// resources/js/types/auth.ts

export interface Auth {
    user: App.Data.Auth.AuthenticatedUserData | null
}

/* @chisel-passkeys */
export interface Passkey {
    id: number
    name: string
    authenticator: string | null
    created_at_diff: string
    last_used_at_diff: string | null
}
/* @end-chisel-passkeys */