<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-warning']) }}>
    {{ $slot }}
</button>
