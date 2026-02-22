<div class="theme-container mx-auto grid gap-8 py-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-6 2xl:gap-8">
    <div class="flex flex-col gap-6 *:[div]:w-full *:[div]:max-w-full">
        <x-field-demo />
    </div>

    <div class="flex flex-col gap-6 *:[div]:w-full *:[div]:max-w-full">
        <x-empty-avatar-group />
        <x-spinner-badge />
        <x-button-group-input-group />
        <x-field-slider />
        <x-input-group-demo />
    </div>

    <div class="flex flex-col gap-6 *:[div]:w-full *:[div]:max-w-full">
        <x-input-group-button-example />
        <x-item-demo />
        <x-mog::field-separator class="my-4">Appearance Settings</x-mog::field-separator>
        <x-appearance-settings />
    </div>

    <div class="order-first flex flex-col gap-6 lg:hidden xl:order-last xl:flex *:[div]:w-full *:[div]:max-w-full">
        <x-notion-prompt-form />
        <div class="flex justify-between gap-4"></div>
    </div>
</div>
