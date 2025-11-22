<div>
    @props(['type' => 'success', 'message' => null])

    @php
        $alerts = [
            'success' => ['color' => '#0f5132', 'icon' => '✅'], // سبز
            'error'   => ['color' => '#842029', 'icon' => '❌'], // قرمز
            'warning' => ['color' => '#664d03', 'icon' => '⚠️'], // نارنجی
            'info'    => ['color' => '#055160', 'icon' => 'ℹ️'], // آبی
        ];

        $alert = $alerts[$type] ?? $alerts['info'];
    @endphp

    @if($message)
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 transform -translate-y-5"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-5"
            style="background: {{ $alert['color'] }}; color: white; padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; position: relative; display: flex; align-items: center; gap: 10px;">

            <span style="font-size: 18px;">{{ $alert['icon'] }}</span>
            <span>{{ $message }}</span>

            <button
                @click="show = false"
                style="position: absolute; top: 5px; right: 10px; background: transparent; border: none; color: white; font-size: 16px; cursor: pointer;">
                ×
            </button>
        </div>
    @endif


</div>
