@props([
    'name' => 'default',
    'async' => false,
    'asyncUrl' => '',
    'wide' => false,
    'open' => false,
    'auto' => false,
    'closeOutside' => true,
    'title' => '',
    'outerHtml' => null
])
<div x-data="modal(`{{ $open }}`, `{{ $async && $outerHtml->isEmpty() ? str_replace('&amp;', '&', $asyncUrl) : ''}}`)">
    <template x-teleport="body">
    <div class="modal-template" @modal-toggled-{{ $name }}.window="toggleModal">
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-10"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-10"
            aria-modal="true"
            role="dialog"
            {{ $attributes->merge(['class' => 'modal']) }}
            @if($closeOutside) @click.self="open=false" @endif
        >
            <div class="modal-dialog
            @if($wide) modal-dialog-xl @elseif($auto) modal-dialog-auto @endif"
                 x-bind="dismissModal"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $title ?? '' }}</h5>
                        <button type="button"
                                class="btn btn-close"
                                @click.stop="open=false"
                                aria-label="Close"
                        >
                            <x-moonshine::icon
                                icon="heroicons.x-mark"
                                size="6"
                            />
                        </button>
                    </div>
                    <div class="modal-body">
                        @if($async)
                            <div :id="id">
                                <x-moonshine::loader />
                            </div>
                        @endif

                        {{ $slot ?? '' }}
                    </div>
                </div>
            </div>
        </div>
        <div x-show="open" x-transition.opacity class="modal-backdrop"></div>
    </div>
    </template>

    @if($outerHtml?->isNotEmpty())
        <div @click.prevent="toggleModal;{{ $async ? 'load(`' . str_replace('&amp;', '&', $asyncUrl) . '`, id);' : '' }}">
            {{ $outerHtml ?? '' }}
        </div>
    @endif
</div>
