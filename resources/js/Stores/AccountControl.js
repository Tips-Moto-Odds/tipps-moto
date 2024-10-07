import { defineStore } from 'pinia'

export const useAccountStore = defineStore('app', {
    state: () => ({
        canSwitchBackToAdmin: false, // Track if in admin mode
    }),
    actions: {
        enableAdminMode() {
            this.canSwitchBackToAdmin = true; // Set to true when switching to user mode
        },
        disableAdminMode() {
            this.canSwitchBackToAdmin = false; // Set to false when switching back to admin
        },
    },
    getters: {
        isAdminModeActive: (state) => state.canSwitchBackToAdmin, // Getter to check admin mode status
    }
})
