@props([])

<div
    x-show="!toast.dismissed"
    x-transition:enter="transition duration-300 ease-out"
    x-transition:enter-start="translate-x-full transform opacity-0"
    x-transition:enter-end="translate-x-0 transform opacity-100"
    x-transition:leave="transition duration-150 ease-in"
    x-transition:leave-start="translate-x-0 transform opacity-100"
    x-transition:leave-end="translate-x-full transform opacity-0"
    :class="{
        'border-green-200 bg-green-50 text-green-800 dark:border-green-800 dark:bg-green-950 dark:text-green-200': toast.type === 'success',
        'border-red-200 bg-red-50 text-red-800 dark:border-red-800 dark:bg-red-950 dark:text-red-200': toast.type === 'error',
        'border-yellow-200 bg-yellow-50 text-yellow-800 dark:border-yellow-800 dark:bg-yellow-950 dark:text-yellow-200': toast.type === 'warning',
        'border-blue-200 bg-blue-50 text-blue-800 dark:border-blue-800 dark:bg-blue-950 dark:text-blue-200': toast.type === 'info',
        'border-gray-200 bg-gray-50 text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200': toast.type === 'loading',
        'bg-background border-border text-foreground': toast.type === 'default' || !toast.type
    }"
    {{ $attributes->twMerge('group pointer-events-auto relative flex w-full items-center justify-between space-x-4 overflow-hidden rounded-md border p-4 pr-8 shadow-lg transition-all hover:scale-[1.02] hover:shadow-xl') }}>
    <div class="flex items-start space-x-3">
        <div
            class="flex-shrink-0"
            x-show="toast.type && toast.type !== 'default'">
            <template x-if="toast.type === 'success'">
                @svg('tabler-check-circle', 'h-5 w-5')
            </template>
            <template x-if="toast.type === 'error'">
                @svg('tabler-x-circle', 'h-5 w-5')
            </template>
            <template x-if="toast.type === 'warning'">
                @svg('tabler-alert-triangle', 'h-5 w-5')
            </template>
            <template x-if="toast.type === 'info'">
                @svg('tabler-info-circle', 'h-5 w-5')
            </template>
            <template x-if="toast.type === 'loading'">
                @svg('tabler-loader', 'h-5 w-5 animate-spin')
            </template>
        </div>

        <div class="flex-1 space-y-1">
            <div
                class="font-medium leading-none"
                x-text="toast.title"></div>

            <div
                x-show="toast.description"
                x-text="toast.description"
                class="text-sm opacity-90"></div>

            <div
                x-show="toast.action"
                class="mt-2">
                <x-mog::button
                    size="sm"
                    variant="outline"
                    class="h-7 px-2 text-xs"
                    x-on:click="toast.action?.onClick && eval(toast.action.onClick)"
                    x-text="toast.action?.label || 'Action'"></x-mog::button>
            </div>
        </div>
    </div>

    <!-- Close button -->
    <button
        type="button"
        x-on:click="$toast.dismiss(toast.id)"
        class="focus:ring-ring absolute right-2 top-2 inline-flex h-6 w-6 items-center justify-center rounded-md opacity-60 hover:opacity-100 focus:opacity-100 focus:outline-none focus:ring-2">
        @svg('tabler-x', 'h-4 w-4')
    </button>
</div>
