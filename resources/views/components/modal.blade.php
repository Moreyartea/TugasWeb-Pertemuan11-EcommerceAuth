@props(['name', 'show' => false, 'maxWidth' => '2xl'])

<div
    x-data="{ show: @js($show) }"
    x-init="$watch('show', value => document.body.style.overflow = value ? 'hidden' : '')"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    x-cloak
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div class="modal-back" x-show="show" x-transition.opacity x-on:click="show = false"></div>
    <div class="modal-wrap" x-show="show" x-transition>
        <div class="modal">{{ $slot }}</div>
    </div>
</div>
