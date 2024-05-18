<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
    email: null,
    password: null,
})
const login = () => form.post('./login')
</script>

<template>
    <div class="login-container">
        <h2>Giriş Sayfası</h2>
        <p>Buradan yazar giriş yapıyor yeeğenim.</p>
        <form @submit.prevent="login">
            <div class="form-group" :class="{'input-error': form.errors.email}">
                <label for="email">E-Posta</label>
                <input type="email" id="email" v-model="form.email" required>
                <div v-if="form.errors.email" class="error-message">{{ form.errors.email }}</div>
            </div>
            <div class="form-group" :class="{'input-error': form.errors.password}">
                <label for="password">Şifre</label>
                <input type="password" id="password" v-model="form.password" required>
                <div v-if="form.errors.password" class="error-message">{{ form.errors.password }}</div>
            </div>
            <button type="submit">hele şu girişi yapıver</button>
        </form>
    </div>
</template>

<style scoped lang="scss">

.login-container {
    background-color: var(--button-hover);
    color: var(--color);
    padding: 20px;
    border-radius: 10px;
    max-width: 600px;
    margin: 0 auto;
    text-align: center;

    h2 {
        margin-bottom: 10px;
        font-size: 1.8em;
    }

    p {
        color: var(--light-color);
        margin-bottom: 20px;
        font-size: 1.4em;
    }

    .form-group {
        margin-bottom: 15px;

        label {
            display: block;
            margin-bottom: 5px;
            font-size: .8em;
        }

        input {
            background-color: var(--button-hover);
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            border: 1px solid var(--social-bg);
            color: var(--color);
            &:focus {
                outline-color: var(--key-border);
                outline-style: solid;
            }
        }

        &.input-error {
            input {
                border: 1px solid #ff4d4f;
            }

            .error-message {
                color: #ff4d4f;
                font-size: 12px;
                margin-top: 5px;
            }
        }
    }

    button {
        margin-top:10px;
        background-color: var(--poem-container);
        color: var(--color);
        padding: 10px 20px;
        width: 100%;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;

        &:hover {
            background-color: #555;
        }
    }
}
</style>
