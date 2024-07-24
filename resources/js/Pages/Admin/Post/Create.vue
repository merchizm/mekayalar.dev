<template>
        <AdminNavigation/>
    <div class="form-container">
        <form @submit.prevent="handleSubmit" class="form">
            <div class="form-group">
                <label for="post_title" class="form-label">
                    Gönderi Başlığı
                </label>
                <input
                    id="post_title"
                    name="post_title"
                    type="text"
                    v-model="postTitle"
                    maxlength="70"
                    @input="checkTitleLength"
                    class="form-input"
                />
                <p class="char-count">
                    {{ 70 - postTitle.length }} karakter kaldı.
                </p>
                <p v-if="postTitle.length === 70" class="char-warning">
                    Karakter Limitine Eriştiniz.
                </p>
            </div>

            <div class="form-group">
                <label for="post_slug" class="form-label">
                    Gönderi Slugu
                </label>
                <div class="input-group">
                    <input
                        id="post_slug"
                        name="post_slug"
                        type="text"
                        v-model="postSlug"
                        class="form-input"
                    />
                    <button
                        type="button"
                        @click="generateSlug"
                        class="generate-slug-button"
                    >
                        Slug Oluştur
                    </button>
                </div>
            </div>

            <MdEditor v-model="state.text" :theme="state.theme" :language="state.language" />


            <div class="form-group">
                <label for="image" class="form-label">
                    Upload Image
                </label>
                <input
                    type="file"
                    id="image"
                    @change="onImageChange"
                    accept="image/*"
                    class="form-input"
                />
                <div v-if="imagePreview" class="image-preview">
                    <img :src="imagePreview" alt="Image Preview" />
                </div>
            </div>


            <div class="form-group">
                <label for="status" class="form-label">
                    Gönderi Türü
                </label>
                <select id="status" class="form-select">
                    <option value="post">Gönderi</option>
                    <option value="drawing">Çizim</option>
                    <option value="photo">Fotoğraf</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">
                    Durum
                </label>
                <select id="status" class="form-select">
                    <option value="published">Yayımla</option>
                    <option value="draft">Taslak</option>
                </select>
            </div>



            <div>
                <button
                    type="submit"
                    class="submit-button"
                >
                    Gönderi Oluştur
                </button>
            </div>
        </form>
    </div>
  </template>

  <script setup>
  import slugify from 'slugify';
  import AdminNavigation from "../../../Components/AdminNavigation.vue";
  import { reactive, ref } from 'vue';
  import { MdEditor } from 'md-editor-v3';
  import 'md-editor-v3/lib/style.css';


  const postTitle = ref('');
  const postSlug = ref('');
  const imageFile = ref(null);
  const imagePreview = ref('');

  const onImageChange = (event) => {
      const file = event.target.files[0];
      if (file && file.type.startsWith('image/')) {
          imageFile.value = file;
          const reader = new FileReader();
          reader.onload = (e) => {
              imagePreview.value = e.target.result;
          };
          reader.readAsDataURL(file);
      } else {
          imageFile.value = null;
          imagePreview.value = '';
      }
  };


  const state = reactive({
    text: '',
    theme: 'dark',
    language: 'en-us'
  });

  function checkTitleLength() {
      if (this.postTitle.length > 70) {
          this.postTitle = this.postTitle.slice(0, 70);
      }
  }
  function generateSlug() {
      postSlug.value = slugify(postTitle.value, {
          lower: true,
          strict: true,
      });
  }
  function handleSubmit() {
//
  }
  </script>


<style scoped lang="scss">
.form-container {
    margin: 0 auto;
    padding: 20px;
}

.form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 5px;
}

.form-select, .form-input {
    padding: 8px;
    border: 1px solid var(--label-border);
    background-color: var(--background-color);
    color: var(--color);
    border-radius: 4px;
    font-size: 14px;
}

.char-count {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}

.char-warning {
    font-size: 12px;
    color: red;
    margin-top: 5px;
}

.input-group {
    display: flex;
    align-items: center;
    input{
        flex: 1;
        border: 1px solid var(--label-border);
        background-color: var(--background-color);
        color: var(--color);
    }
}

.generate-slug-button {
    margin-left: 10px;
    padding: 8px 12px;
    background-color: #4f46e5;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;

    &:hover {
        background-color: #4338ca;
    }
}

.submit-button {
    padding: 10px 15px;
    background-color: #2563eb;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;

    &:hover {
        background-color: #1d4ed8;
    }
}

.image-preview {
    margin-top: 10px;

    img {
        max-width: 100%;
        height: 10vw;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
}

</style>
