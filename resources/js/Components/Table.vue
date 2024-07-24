<template>
    <div class="link-container">
      <a href="posts/create" class="link">Gönderi Oluştur</a>
    </div>
    <div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>post_title</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in paginatedData.data" :key="item.id">
            <td>{{ item.id }}</td>
            <td>{{ item.post_title }}</td>
          </tr>
        </tbody>
      </table>
      <div class="pagination">
        <button @click="fetchData(paginatedData.prev_page_url)" :disabled="!paginatedData.prev_page_url">Önceki</button>
        <span>Sayfa {{ paginatedData.current_page }} / {{ paginatedData.last_page }}</span>
        <button @click="fetchData(paginatedData.next_page_url)" :disabled="!paginatedData.next_page_url">Sonrakii</button>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  import {Link} from '@inertiajs/vue3';
  export default {
    setup() {
      const paginatedData = ref({
        current_page: 1,
        data: [],
        first_page_url: "",
        last_page: 1,
        last_page_url: "",
        links: [],
        next_page_url: null,
        path: "",
        per_page: 10,
        prev_page_url: null,
        to: null,
        total: 0
      });
  
      const fetchData = async (url) => {
        if (!url) return;
  
        try {
          const response = await fetch(url);
          const data = await response.json();
          paginatedData.value = data;
        } catch (error) {
          console.error('Error fetching data:', error);
        }
      };
  
      onMounted(() => {
        fetchData('/api/data'); // Replace with your API endpoint
      });
  
      return {
        paginatedData,
        fetchData
      };
    }
  };
  </script>
  
  <style scoped lang="scss">
  /* Add your styles here */
  .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }
  
  .pagination button {
    margin: 0 5px;
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
  