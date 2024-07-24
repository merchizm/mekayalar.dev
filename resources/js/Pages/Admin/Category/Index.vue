<template>
    <AdminNavigation/>
    <div class="container">
        <h1>Kategori Yönetimi</h1>
        <button class="add-btn" @click="openCreateModal">Yeni Kategori</button>
        <ul class="category-list">
            <li v-for="category in categories" :key="category.id" class="category-item">
                <span>{{ category.name }}</span>
                <div>
                    <button class="edit-btn" @click="openEditModal(category)">Düzenle</button>
                    <button class="delete-btn" @click="confirmDelete(category.id)">Sil</button>
                </div>
            </li>
        </ul>

        <div v-if="showModal" class="modal-overlay">
            <div class="modal">
                <h2>{{ editMode ? 'Kategoriyi Düzenle' : 'Yeni Kategori' }}</h2>
                <input v-model="categoryForm.name" placeholder="Kategori Adı" class="input" />
                <div class="modal-actions">
                    <button class="cancel-btn" @click="closeModal">İptal</button>
                    <button class="save-btn" @click="saveCategory">{{ editMode ? 'Güncelle' : 'Kaydet' }}</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {usePage, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import AdminNavigation from "@/Components/AdminNavigation.vue";

export default {
    components: {AdminNavigation},
    data() {
        return {
            categories: [],
            showModal: false,
            editMode: false,
            categoryForm: {
                id: null,
                name: ''
            }
        };
    },
    methods: {
        openCreateModal() {
            this.resetForm();
            this.editMode = false;
            this.showModal = true;
        },
        openEditModal(category) {
            this.categoryForm = { ...category };
            this.editMode = true;
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        saveCategory() {
            if (this.editMode) {
                router.put(`/api/category/${this.categoryForm.id}`, this.categoryForm, {
                    onFinish: () => {
                        this.showModal = false;
                    }
                });
            } else {
                router.post('/api/category', this.categoryForm, {
                    onFinish: () => {
                        this.showModal = false;
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
                    this.deleteCategory(id);
                }
            });
        },
        deleteCategory(id) {
            router.delete(`/api/category/${id}`, {
                onFinish: () => {
                    Swal.fire(
                        'Deleted!',
                        'Your category has been deleted.',
                        'success'
                    );
                }
            });
        },
        resetForm() {
            this.categoryForm = {
                id: null,
                name: ''
            };
        }
    }
};
</script>

<style scoped>
.container {
    margin: 0 auto;
    padding: 20px;
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

.add-btn {
    display: inline-block;
    background-color: var(--button);
    color: var(--color);
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    margin-bottom: 20px;
    border-radius: 5px;
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
</style>
