<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';

const emitTest = e => console.log(e)
</script>
<template>
    <GuestLayout>
        何か文字を書く
        <InputLabel value="バリュー">インプットラベル</InputLabel>
        <InputLabel @update:modelValue="emitTest"></InputLabel>
    </GuestLayout>
</template>