<div class="w-full max-w-md rounded-lg border p-6">
    <form>
        <x-mog::field-group>
            <x-mog::fieldset>
                <x-mog::field-legend>Payment Method</x-mog::field-legend>

                <x-mog::field-description>All transactions are secure and encrypted</x-mog::field-description>

                <x-mog::field-group>
                    <x-mog::field>
                        <x-mog::field-label for="checkout-7j9-card-name-43j">Name on Card</x-mog::field-label>

                        <x-mog::input
                            id="checkout-7j9-card-name-43j"
                            placeholder="John Doe"
                            required />
                    </x-mog::field>

                    <div class="grid grid-cols-3 gap-4">
                        <x-mog::field class="col-span-2">
                            <x-mog::field-label for="checkout-7j9-card-number-uw1">Card Number</x-mog::field-label>

                            <x-mog::input
                                id="checkout-7j9-card-number-uw1"
                                placeholder="1234 5678 9012 3456"
                                required />

                            <x-mog::field-description>Enter your 16-digit number.</x-mog::field-description>
                        </x-mog::field>
                        <x-mog::field class="col-span-1">
                            <x-mog::field-label for="checkout-7j9-cvv">CVV</x-mog::field-label>

                            <x-mog::input
                                id="checkout-7j9-cvv"
                                placeholder="123"
                                required />
                        </x-mog::field>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <x-mog::field>
                            <x-mog::field-label for="checkout-7j9-exp-month-ts6">Month</x-mog::field-label>

                            <x-mog::select placeholder="MM">
                                <x-slot:[options] value="01">One</x-slot:[options]>
                                <x-slot:[options] value="02">Two</x-slot:[options]>
                                <x-slot:[options] value="03">Three</x-slot:[options]>
                                <x-slot:[options] value="04">Four</x-slot:[options]>
                                <x-slot:[options] value="05">Five</x-slot:[options]>
                                <x-slot:[options] value="06">Six</x-slot:[options]>
                                <x-slot:[options] value="07">Seven</x-slot:[options]>
                                <x-slot:[options] value="08">Eight</x-slot:[options]>
                                <x-slot:[options] value="09">Nine</x-slot:[options]>
                                <x-slot:[options] value="10">Ten</x-slot:[options]>
                                <x-slot:[options] value="11">Eleven</x-slot:[options]>
                                <x-slot:[options] value="12">Twelve</x-slot:[options]>
                            </x-mog::select>
                        </x-mog::field>

                        <x-mog::field>
                            <x-mog::field-label for="checkout-7j9-exp-year-f59">Year</x-mog::field-label>

                            <x-mog::select placeholder="YYYY">
                                <x-slot:[options] value="2024">2024</x-slot:[options]>
                                <x-slot:[options] value="2025">2025</x-slot:[options]>
                                <x-slot:[options] value="2026">2026</x-slot:[options]>
                                <x-slot:[options] value="2027">2027</x-slot:[options]>
                                <x-slot:[options] value="2028">2028</x-slot:[options]>
                                <x-slot:[options] value="2029">2029</x-slot:[options]>
                            </x-mog::select>
                        </x-mog::field>
                    </div>
                </x-mog::field-group>
            </x-mog::fieldset>

            <x-mog::field-separator />

            <x-mog::fieldset>
                <x-mog::field-legend>Billing Address</x-mog::field-legend>
                <x-mog::field-description>The billing address associated with your payment method</x-mog::field-description>
                <x-mog::field-group>
                    <x-mog::field orientation="horizontal">
                        <x-mog::checkbox
                            id="checkout-7j9-same-as-shipping-wgm"
                            checked />
                        <x-mog::field-label
                            for="checkout-7j9-same-as-shipping-wgm"
                            class="font-normal">
                            Same as shipping address
                        </x-mog::field-label>
                    </x-mog::field>
                </x-mog::field-group>
            </x-mog::fieldset>

            <x-mog::field-separator />

            <x-mog::fieldset>
                <x-mog::field-group>
                    <x-mog::field>
                        <x-mog::field-label for="checkout-7j9-optional-comments">Comments</x-mog::field-label>

                        <x-mog::textarea
                            id="checkout-7j9-optional-comments"
                            placeholder="Add any additional comments" />
                    </x-mog::field>
                </x-mog::field-group>
            </x-mog::fieldset>

            <x-mog::field orientation="horizontal">
                <x-mog::button type="submit">Submit</x-mog::button>

                <x-mog::button
                    variant="outline"
                    type="button">
                    Cancel
                </x-mog::button>
            </x-mog::field>
        </x-mog::field-group>
    </form>
</div>
