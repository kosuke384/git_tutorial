<x-tests.app>
    <x-slot name='header'>
        header1
    </x-slot>
コンポーネント1
<x-tests.card :title="$title" content="本文" message="メッセージ" />
<x-tests.card :title="$title" class="bg-red-300" />
</x-tests.app>