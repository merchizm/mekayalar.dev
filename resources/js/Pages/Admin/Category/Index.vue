<template>
    <AdminNavigation/>
    <div class="link-container">
        <button class="link" @click="openCreateModal">Yeni Kategori</button>
    </div>
        <h1>Kategori Yönetimi</h1>
        <ul class="category-list">
            <li v-for="category in categories" :key="category.id" class="category-item">
                <span>{{ category.name }}</span>
                <div>
                    <button class="edit-btn" @click="openEditModal(category)">Düzenle</button>
                    <button class="delete-btn" @click="confirmDelete(category.id)">Sil</button>
                </div>
            </li>
        </ul>

        <!-- Create/Edit Modal -->
        <div v-if="showModal" class="modal-overlay">
            <div class="modal">
                <h2>{{ editMode ? 'Kategoriyi Düzenle': 'Yeni Kategori' }}</h2>
                <form @submit.prevent="submitForm">
                    <input v-model="form.name" placeholder="Kategori Adı" class="input" />
                    <div v-if="form.errors.name" class="error">{{ form.errors.name }}</div>
                    <div class="modal-actions">
                        <button type="button" class="cancel-btn" @click="closeModal">İptal</button>
                        <button type="submit" class="save-btn" :disabled="form.processing">
                            {{ editMode ? 'Güncelle' : 'Kaydet' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import AdminNavigation from "@/Components/AdminNavigation.vue";

export default {
    components: {AdminNavigation},
    props: {
        categories: Array
    },
    data() {
        return {
            showModal: false,
            editMode: false,
            form: useForm({
                id: null,
                name: ''
            })
        };
    },
    methods: {
        openCreateModal() {
            this.resetForm();
            this.editMode = false;
            this.showModal = true;
        },
        openEditModal(category) {
            this.form.reset();
            this.form.id = category.id;
            this.form.name = category.name;
            this.editMode = true;
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
            this.form.reset();
        },
        submitForm() {
            if (this.editMode) {
                this.$inertia.put(`./categories/${this.form.id}`, this.form, {
                    onFinish: () => {
                        this.showModal = false;
                        this.form.reset();
                    }
                });
            } else {
                this.$inertia.post('./categories/', this.form, {
                    onFinish: () => {
                        this.showModal = false;
                        this.form.reset();
                    }
                });
            }
        },
        confirmDelete(id) {
            Swal.fire({
                title: 'Emin misin?',
                text: "Kategoriyi silersen bu işlem geri alınamaz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteCategory(id);
                }
            });
        },
        deleteCategory(id) {
            this.$inertia.delete(`./categories/${id}`, {
                onFinish: () => {
                    Swal.fire(
                        'Deleted!',
                        'Kategori Başarıyla silindi.',
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

<style scoped lang="scss">
h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

.category-list {
    list-style: none;
    padding: 0;
}

.category-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #ccc;
}

.edit-btn,
.delete-btn {
    background-color: #ffc107;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    margin-left: 10px;
    border-radius: 5px;
}

.delete-btn {
    background-color: #dc3545;
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
}

.modal {
    background-color: var(--background-color);
    color: var(--color);
    padding: 20px;
    border-radius: 5px;
    width: 300px;
}

.input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    background-color: var(--background-color);
    color: var(--color);
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
}

.cancel-btn,
.save-btn {
    background-color: #6c757d;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    margin-left: 10px;
    border-radius: 5px;
}

.save-btn {
    background-color: var(--button);
    color: var(--color);
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
</style>
