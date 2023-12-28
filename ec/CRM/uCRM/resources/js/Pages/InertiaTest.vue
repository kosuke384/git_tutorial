<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const newTitle=ref('');
const newContent=ref('');
</script>

<template>
Inertiaテスト
<a href="/">aタグ経由</a>
<Link href="/">リンク経由</Link>
<Link :href="route('inertia.index')">名前付きルート</Link>
<Link :href="route('inertia.show',{id:1})">ルートパラメーター</Link>
<div class="mb-8"></div>
<input type="text" name="newTitle" v-model="newTitle">{{ newTitle }}<br>
<input type="text" name="newContent" v-model="newContent">{{ newContent }}<br>
<Link as="button" method="post" :href="route('inertia.store')" :data="{
    title:newTitle,
    content:newContent
}">DB保存</Link>

</template>