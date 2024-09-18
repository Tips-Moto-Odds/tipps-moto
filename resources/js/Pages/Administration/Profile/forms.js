import { useForm } from '@inertiajs/vue3';
import { useAttrs } from 'vue';

export const initializeForms = () => {
    const attrs = useAttrs();

    const userForm = useForm({
        id: attrs.auth.user.id,
        status: attrs.auth.user.status,
        name: attrs.auth.user.name,
        phone: attrs.auth.user.phone,
        email: attrs.auth.user.email,
    });

    const securityForm = useForm({
        current_password: '',
        password: '',
        password_confirmation: '',
    });

    return {
        userForm,
        securityForm,
    };
};
