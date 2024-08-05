<script>
import AdminNavigation from "@/Components/AdminNavigation.vue";

import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import slugify from 'slugify';

export default {
    components: {AdminNavigation},
    props: {
        poems: Array
    },
    data() {
        return {
            showModal: false,
            editMode: false,
            form: useForm({
                id: null,
                title: '',
                slug: '',
                content: '',
                wrote_at: ''
            })
        };
    },
    methods: {
        openCreateModal() {
            this.resetForm();
            this.editMode = false;
            this.showModal = true;
        },
        openEditModal(poem) {
            this.form.reset();
            this.form.id = poem.id;
            this.form.title = poem.title;
            this.form.slug = poem.slug;
            this.form.content = poem.content;
            this.form.wrote_at = poem.wrote_at;
            this.editMode = true;
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
            this.form.reset();
        },
        generateSlug() {
            this.form.slug = slugify(this.form.title, { lower: true });
        },
        submitForm() {
            if (this.editMode) {
                this.$inertia.put(`/panel/poems/${this.form.id}`, this.form, {
                    onFinish: () => {
                        this.showModal = false;
                        this.form.reset();
                    }
                });
            } else {
                this.$inertia.post('/panel/poems', this.form, {
                    onFinish: () => {
                        this.showModal = false;
                        this.form.reset();
                    }
                });
            }
        },
        confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deletePoem(id);
                }
            });
        },
        deletePoem(id) {
            this.$inertia.delete(`/panel/poems/${id}`, {
                onFinish: () => {
                    Swal.fire(
                        'Deleted!',
                        'Your poem has been deleted.',
                        'success'
                    );
                }
            });
        },
        resetForm() {
            this.form.reset();
            this.form.id = null;
        }
    }
};
</script>

<template>
    <AdminNavigation/>
    <div class="link-container">
        <button class="link" @click="openCreateModal">Yeni Şiir</button>
    </div>
    <div class="container">
        <h1>Şiir Yönetimi</h1>
        <ul class="poem-list">
            <li v-for="poem in poems" :key="poem.id" class="poem-item">
                <span>{{ poem.title }}</span>
                <div>
                    <button class="edit-btn" @click="openEditModal(poem)">Düzenle</button>
                    <button class="delete-btn" @click="confirmDelete(poem.id)">Sil</button>
                </div>
            </li>
        </ul>

        <!-- Create/Edit Modal -->
        <div v-if="showModal" class="modal-overlay">
            <div class="modal">
                <h2>{{ editMode ? 'Şiiri Düzenle' : 'Yeni Şiir' }}</h2>
                <form @submit.prevent="submitForm">
                    <input v-model="form.title" placeholder="Başlık" class="input" @input="generateSlug"/>
                    <div v-if="form.errors.title" class="error">{{ form.errors.title }}</div>

                    <input v-model="form.slug" placeholder="Slug" class="input" readonly/>
                    <div v-if="form.errors.slug" class="error">{{ form.errors.slug }}</div>

                    <textarea v-model="form.content" placeholder="Şiir" class="textarea"></textarea>
                    <div v-if="form.errors.content" class="error">{{ form.errors.content }}</div>

                    <input type="datetime-local" v-model="form.wrote_at" placeholder="Date and Time" class="input"/>
                    <div v-if="form.errors.wrote_at" class="error">{{ form.errors.wrote_at }}</div>

                    <div class="modal-actions">
                        <button type="button" class="cancel-btn" @click="closeModal">İptal</button>
                        <button type="submit" class="save-btn" :disabled="form.processing">
                            {{ editMode ? 'Güncelle' : 'Kaydet' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">

.container {
    margin: 0 auto;
    padding: 20px;
}
h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

.link-container{
    justify-content: end;
    align-items:end;
    display:flex;
    .link{
        display: block;
        margin: 20px;
        text-decoration: none;
        border-radius: 6px;
        background-color: var(--button-hover);
        color: var(--color);
        padding: 0.3em 1em;
        cursor: pointer;
        &:hover{
            background-color: var(--button);
        }
    }
}
.poem-list {
    list-style: none;
    padding: 0;
}
.poem-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #ccc;
}
.edit-btn {
    background-color: var(--button-hover);
    color: var(--color);
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    margin-left: 10px;
    border-radius: 5px;
}
.delete-btn {
    color: var(--color);
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    margin-left: 10px;
    background-color: var(--button-hover);
    border-radius: 5px;
}
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;

    .modal {
        background: var(--background-color);
        padding: 20px;
        border-radius: 5px;
        width: 1200px;


        .input {
            background: var(--button-hover);
            border-radius: 7px;
            color: var(--color);
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
        }
        .textarea {
            background: var(--button-hover);
            border-radius: 7px;
            color: var(--color);
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            height: 100px;
        }
        .error {
            color: red;
            font-size: 12px;
            margin-bottom: 10px;
        }
        .modal-actions {
            display: flex;
            justify-content: flex-end;
        }
        .cancel-btn {
            background-color: var(--button);
            color: var(--color);
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-left: 10px;
            border-radius: 10px;
        }
        .save-btn {
            border-radius: 10px;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-left: 10px;
            background-color: #007bff;
        }
    }
}


</style>
