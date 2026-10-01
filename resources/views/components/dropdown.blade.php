@props(['align' => 'right', 'width' => '48', 'contentClasses' => ''])

<div style="position: relative;" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">{{ $trigger }}</div>

    <div x-show="open" x-cloak x-transition.opacity.duration.150ms class="menu" @click="open = false">
        {{ $content }}
    </div>
</div>
