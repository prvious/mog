<x-mog::fieldset>
    <x-mog::field-group>
        <x-mog::fieldset x-data="{ value: 'kubernetes' }">
            <x-mog::field-legend>Compute Environment</x-mog::field-legend>

            <x-mog::field-description>Select the compute environment for your cluster.</x-mog::field-description>

            <x-mog::radio-group x-model="value">
                <x-mog::field-label>
                    <x-mog::field orientation="horizontal">
                        <x-mog::field-content>
                            <x-mog::field-title>Kubernetes</x-mog::field-title>
                            <x-mog::field-description>Run GPU workloads on a K8s configured cluster. This is the default.</x-mog::field-description>
                        </x-mog::field-content>

                        <x-mog::radio-group-item
                            value="kubernetes"
                            aria-label="Kubernetes" />
                    </x-mog::field>
                </x-mog::field-label>

                <x-mog::field-label>
                    <x-mog::field orientation="horizontal">
                        <x-mog::field-content>
                            <x-mog::field-title>Virtual Machine</x-mog::field-title>
                            <x-mog::field-description>Access a VM configured cluster to run workloads. (Coming soon)</x-mog::field-description>
                        </x-mog::field-content>

                        <x-mog::radio-group-item
                            value="vm"
                            aria-label="Virtual Machine" />
                    </x-mog::field>
                </x-mog::field-label>
            </x-mog::radio-group>
        </x-mog::fieldset>

        <x-mog::field-separator />

        <x-mog::field
            orientation="horizontal"
            x-data="{
                gpus: 8,
                setGpus(x) {
                    this.gpus = Math.max(1, Math.min(99, this.gpus + x))
                },
            }">
            <x-mog::field-content>
                <x-mog::field-label for="number-of-gpus-f6l">
                    Number of GPUs (
                    <span x-text="gpus"></span>
                    )
                </x-mog::field-label>
                <x-mog::field-description>You can add more later.</x-mog::field-description>
            </x-mog::field-content>

            <x-mog::button-group>
                <x-mog::input
                    id="number-of-gpus-f6l"
                    x-model="gpus"
                    size="3"
                    class="h-8 w-14! font-geist-mono"
                    maxLength="3" />

                <x-mog::button
                    variant="outline"
                    size="icon-sm"
                    type="button"
                    aria-label="Decrement"
                    x-on:click="setGpus(-1)"
                    x-bind:disabled="gpus <= 1">
                    @svg('lucide-minus')
                </x-mog::button>

                <x-mog::button
                    variant="outline"
                    size="icon-sm"
                    type="button"
                    aria-label="Increment"
                    x-on:click="setGpus(1)"
                    x-bind:disabled="gpus >= 99">
                    @svg('lucide-plus')
                </x-mog::button>
            </x-mog::button-group>
        </x-mog::field>

        <x-mog::field-separator />

        <x-mog::field orientation="horizontal">
            <x-mog::field-content>
                <x-mog::field-label for="tinting">Wallpaper Tinting</x-mog::field-label>
                <x-mog::field-description>Allow the wallpaper to be tinted.</x-mog::field-description>
            </x-mog::field-content>

            <x-mog::switch
                id="tinting"
                checked />
        </x-mog::field>
    </x-mog::field-group>
</x-mog::fieldset>
