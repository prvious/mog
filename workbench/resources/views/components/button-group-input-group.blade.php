<x-mog::button-group class="[--radius:9999rem]">
    <x-mog::button-group>
        <x-mog::button
            variant="outline"
            size="icon"
            aria-label="Add">
            @svg('lucide-plus')
        </x-mog::button>
    </x-mog::button-group>

    <x-mog::button-group
        class="flex-1"
        x-data="{
            voiceEnabled: false,
            get placeholder() {
                return this.voiceEnabled ? 'Record and send audio...' : 'Send a message...';
            }
        }">
        <x-mog::input-group>
            <x-mog::input-group-input
                x-bind:placeholder="placeholder"
                x-bind:disabled="voiceEnabled" />
            <x-mog::input-group-addon align="inline-end">
                <x-mog::tooltip>
                    <x-slot:trigger>
                        <x-mog::input-group-button
                            x-on:click="voiceEnabled = !voiceEnabled"
                            x-bind:data-active="String(voiceEnabled)"
                            class="data-[active=true]:bg-primary data-[active=true]:text-primary-foreground"
                            x-bind:aria-pressed="String(voiceEnabled)"
                            size="icon-xs"
                            aria-label="Voice Mode">
                            @svg('lucide-audio-lines')
                        </x-mog::input-group-button>
                    </x-slot:trigger>

                    <x-slot:content>Voice Mode</x-slot:content>
                </x-mog::tooltip>
            </x-mog::input-group-addon>
        </x-mog::input-group>
    </x-mog::button-group>
</x-mog::button-group>
