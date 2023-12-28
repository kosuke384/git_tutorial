<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
Inertiaテスト
<a href="/">aタグ経由</a>
<Link href="/">リンク経由</Link>
<Link :href="route('inertia.index')">名前付きルート</Link>
<Link :href="route('inertia.show',{id:1})">ルートパラメーター</Link>
</template>