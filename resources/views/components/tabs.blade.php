@props([
    'tabs',
    'contents',
    'active',
])
@if($tabs)
    <!-- Tabs -->
    <div {{ $attributes->class(['tabs']) }}
         x-data="{ activeTab: '{{ $active ?? array_key_first($tabs) }}'}"
    >
        <!-- Tabs Buttons -->
        <ul class="tabs-list">
            @foreach($tabs as $tabId => $tabContent)
                <li class="tabs-item">
                    <button
                        @click.prevent="activeTab = '{{ $tabId }}'"
                        :class="{ '_is-active': activeTab === '{{ $tabId }}' }"
                        class="tabs-button"
                        type="button"
                    >
                        {!! $tabContent !!}
                    </button>
                </li>
            @endforeach
        </ul>
        <!-- END: Tabs Buttons -->

        <!-- Tabs content -->
        <div class="tabs-content">
            @foreach($contents as $tabId => $tabContent)
                <div x-show="activeTab === '{{ $tabId }}'" class="tab-panel" style="display: none">
                    <div class="tabs-body">
                        {!! $tabContent !!}
                    </div>
                </div>
            @endforeach
        </div>
        <!-- END: Tabs content -->
    </div>
    <!-- END: Tabs -->
@endif
