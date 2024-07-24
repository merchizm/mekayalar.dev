<template>
    <MdEditor v-model="state.text" :theme="state.theme" :language="state.language" />
  </template>
  
  <script setup>
  import { reactive } from 'vue';
  import { MdEditor } from 'md-editor-v3';
  import 'md-editor-v3/lib/style.css';
  
  const state = reactive({
    text: '',
    theme: 'dark',
    language: 'en-us'
});
  </script>