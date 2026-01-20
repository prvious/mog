# Radio Group

Radio button groups for single-selection from multiple options. Uses Alpine.js for state management and provides accessible, keyboard-navigable radio controls.

## Overview

Radio groups allow users to select exactly one option from a set of choices. The Mog radio group components use custom styling while maintaining semantic HTML and full accessibility.

## Components

### `<x-radio-group>`

Container component that manages the selected value state for all radio items within it.

**Props:**

- `value` (string/number, default: `null`): Initially selected value
- `orientation` (string, default: `'vertical'`): Layout direction
- `required` (boolean): Whether selection is required
- `disabled` (boolean): Disable all radio items

**Attributes:**

- `role="radiogroup"`: Semantic role for accessibility
- `aria-orientation`: Reflects orientation prop
- `aria-required`: Reflects required state

### `<x-radio-group-item>`

Individual radio button within a group.

**Props:**

- `value` (string/number, required): The value this radio represents

**Features:**

- Circular indicator appears when selected
- Keyboard navigation support
- Focus states with ring indicator
- Disabled state support

## Usage Examples

### Basic Radio Group

```blade
<x-radio-group name="size">
    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="sm" />
            Small
        </x-field-label>
    </x-field>

    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="md" />
            Medium
        </x-field-label>
    </x-field>

    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="lg" />
            Large
        </x-field-label>
    </x-field>
</x-radio-group>
```

### With Fieldset

```blade
<x-fieldset>
    <x-field-legend>Choose your plan</x-field-legend>

    <x-radio-group name="plan">
        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="free" />
                Free - $0/month
            </x-field-label>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="pro" />
                Pro - $10/month
            </x-field-label>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="enterprise" />
                Enterprise - $50/month
            </x-field-label>
        </x-field>
    </x-radio-group>
</x-fieldset>
```

### With Default Value

```blade
<x-radio-group
    name="shipping"
    value="standard">
    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="standard" />
            Standard Shipping - Free
        </x-field-label>
    </x-field>

    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="express" />
            Express Shipping - $10
        </x-field-label>
    </x-field>
</x-radio-group>
```

### With Livewire

```blade
<x-radio-group wire:model="selectedPlan">
    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="monthly" />
            Monthly Billing
        </x-field-label>
    </x-field>

    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="yearly" />
            Yearly Billing (Save 20%)
        </x-field-label>
    </x-field>
</x-radio-group>
```

### With Descriptions

```blade
<x-fieldset>
    <x-field-legend>Notification Preferences</x-field-legend>

    <x-radio-group wire:model="notificationFrequency">
        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="realtime" />
                <div>
                    <div class="font-medium">Real-time</div>
                    <x-field-description>Get notified immediately as events occur</x-field-description>
                </div>
            </x-field-label>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="daily" />
                <div>
                    <div class="font-medium">Daily Digest</div>
                    <x-field-description>Receive a summary once per day</x-field-description>
                </div>
            </x-field-label>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="weekly" />
                <div>
                    <div class="font-medium">Weekly Digest</div>
                    <x-field-description>Receive a summary once per week</x-field-description>
                </div>
            </x-field-label>
        </x-field>
    </x-radio-group>
</x-fieldset>
```

### With Icons

```blade
<x-radio-group wire:model="theme">
    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="light" />
            @svg('mog-sun')
            Light Mode
        </x-field-label>
    </x-field>

    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="dark" />
            @svg('mog-moon')
            Dark Mode
        </x-field-label>
    </x-field>

    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="system" />
            @svg('mog-monitor')
            System Default
        </x-field-label>
    </x-field>
</x-radio-group>
```

### Disabled State

```blade
<x-radio-group disabled>
    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="1" />
            Option 1
        </x-field-label>
    </x-field>

    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="2" />
            Option 2
        </x-field-label>
    </x-field>
</x-radio-group>
```

### With Error Validation

```blade
<x-fieldset>
    <x-field-legend>Select payment method</x-field-legend>

    <x-radio-group
        wire:model="paymentMethod"
        @error('paymentMethod')
        data-invalid="true"
        @enderror>
        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="card" />
                Credit Card
            </x-field-label>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="paypal" />
                PayPal
            </x-field-label>
        </x-field>
    </x-radio-group>

    <x-field-error key="paymentMethod" />
</x-fieldset>
```

### Horizontal Orientation

```blade
<x-radio-group
    orientation="horizontal"
    class="flex gap-4">
    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="yes" />
            Yes
        </x-field-label>
    </x-field>

    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="no" />
            No
        </x-field-label>
    </x-field>
</x-radio-group>
```

## Accessibility

### Keyboard Navigation

- `Tab`: Focus the radio group
- `↑`/`←`: Select previous option
- `↓`/`→`: Select next option
- `Space`: Select focused option

### ARIA Attributes

The component includes proper ARIA attributes:

```html
role="radiogroup" aria-required="true|false" aria-orientation="vertical|horizontal" role="radio" (on items) aria-checked="true|false"
```

### Semantic Structure

Always use with fieldset and legend for proper semantics:

```blade
<x-fieldset>
    <x-field-legend>Question</x-field-legend>
    <x-radio-group>
        {{-- Radio items --}}
    </x-radio-group>
</x-fieldset>
```

## Best Practices

### Use Fieldsets

```blade
{{-- Good --}}
<x-fieldset>
    <x-field-legend>Choose your plan</x-field-legend>
    <x-radio-group>...</x-radio-group>
</x-fieldset>

{{-- Avoid: No fieldset/legend --}}
<x-radio-group>...</x-radio-group>
```

### Provide Descriptions for Complex Options

```blade
<x-field orientation="horizontal">
    <x-field-label>
        <x-radio-group-item value="pro" />
        <div>
            <div class="font-medium">Pro Plan</div>
            <x-field-description>Best for small teams</x-field-description>
        </div>
    </x-field-label>
</x-field>
```

### Use Appropriate Defaults

```blade
{{-- Set sensible default when applicable --}}
<x-radio-group value="standard">
    <x-field orientation="horizontal">
        <x-field-label>
            <x-radio-group-item value="standard" />
            Standard (Recommended)
        </x-field-label>
    </x-field>
</x-radio-group>
```

## Technical Details

### Alpine.js State

The radio group uses Alpine.js for state management:

```javascript
x-data="{
    radio_group_selected: null,
    select(item) {
        this.radio_group_selected = item
    },
}"
x-modelable="radio_group_selected"
```

### Data Attributes

Radio items expose their state via data attributes:

```html
data-state="checked|unchecked" data-checked="true|false"
```

### Focus Management

Radio groups have `tabindex="0"` and `outline: none` for proper keyboard focus management.

## Related Components

- [Field](./field.md) - Form field layouts
- [Checkbox](./checkbox.md) - Multiple selection controls
- [Select](./select.md) - Dropdown selection

## Common Patterns

### Payment Method Selection

```blade
<x-fieldset>
    <x-field-legend>Payment Method</x-field-legend>

    <x-radio-group wire:model="paymentMethod">
        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="card" />
                @svg('mog-credit-card')
                Credit Card
            </x-field-label>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="paypal" />
                @svg('mog-paypal')
                PayPal
            </x-field-label>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="bank" />
                @svg('mog-bank')
                Bank Transfer
            </x-field-label>
        </x-field>
    </x-radio-group>
</x-fieldset>
```

### Shipping Options

```blade
<x-fieldset>
    <x-field-legend>Shipping Method</x-field-legend>

    <x-radio-group wire:model="shipping">
        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="standard" />
                <div>
                    <div class="font-medium">Standard Shipping</div>
                    <x-field-description>5-7 business days - Free</x-field-description>
                </div>
            </x-field-label>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="express" />
                <div>
                    <div class="font-medium">Express Shipping</div>
                    <x-field-description>2-3 business days - $10.00</x-field-description>
                </div>
            </x-field-label>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="overnight" />
                <div>
                    <div class="font-medium">Overnight Shipping</div>
                    <x-field-description>Next business day - $25.00</x-field-description>
                </div>
            </x-field-label>
        </x-field>
    </x-radio-group>
</x-fieldset>
```

### Yes/No Question

```blade
<x-fieldset>
    <x-field-legend>Do you want to subscribe?</x-field-legend>

    <x-radio-group
        wire:model="subscribe"
        orientation="horizontal"
        class="flex gap-6">
        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="yes" />
                Yes
            </x-field-label>
        </x-field>

        <x-field orientation="horizontal">
            <x-field-label>
                <x-radio-group-item value="no" />
                No
            </x-field-label>
        </x-field>
    </x-radio-group>
</x-fieldset>
```
