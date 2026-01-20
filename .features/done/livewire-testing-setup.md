---
name: livewire-testing-setup
description: Set up Livewire for browser testing with Orchestra Testbench
depends_on: null
---

## Feature Description

Integrate Livewire into the browser testing setup to enable true end-to-end testing with server interactions. This will:
- Remove Alpine.js CDN from test layout (Livewire includes it)
- Add Livewire service provider to Orchestra Testbench
- Use @livewireStyles and @livewireScripts in test layout
- Enable testing of Livewire-specific features (wire:click, wire:model, loading states)
- Provide more realistic testing environment

## Implementation Plan

### 1. Install Livewire

```bash
composer require livewire/livewire --dev
```

### 2. Update Orchestra Testbench Configuration

**File: `tests/TestCase.php`**
- Add Livewire service provider to `getPackageProviders()`
- Configure Livewire for testing environment

### 3. Update Test Layout

**File: `tests/views/layout.blade.php`**
- Remove Alpine.js CDN script
- Add @livewireStyles in <head>
- Add @livewireScripts before </body>
- Livewire will automatically inject Alpine.js

### 4. Create Livewire Test Components (Optional)

**Location: `tests/Livewire/`**
- Create example components for testing interactive features
- Test wire:click, wire:model, loading states
- Test component rendering and reactivity

### 5. Update Browser Tests

**File: `tests/Browser/ButtonComponentTest.php`**
- Update tests to work with Livewire
- Test Livewire loading states properly
- Verify Alpine.js functionality through Livewire

### 6. Update CSS Build

**Ensure Livewire views are scanned:**
- Update resources/css/app.css @source to include Livewire vendor views

## Acceptance Criteria

- [ ] Livewire installed as dev dependency
- [ ] Livewire service provider registered in TestCase
- [ ] Test layout uses @livewireStyles and @livewireScripts
- [ ] Alpine.js CDN removed from layout
- [ ] All existing browser tests still pass
- [ ] Livewire components can be tested in browser
- [ ] Loading states work with Livewire wire:loading
- [ ] Code formatted with project standards

## Testing Strategy

1. **Verify Livewire Installation**:
   - Check Livewire assets are available
   - Verify Alpine.js is injected by Livewire

2. **Test Layout Rendering**:
   - Visit test pages and verify Livewire is loaded
   - Check browser console for errors
   - Verify Alpine.js components still work

3. **Browser Tests**:
   - Run all button tests: `vendor/bin/pest --group=button`
   - Verify all tests pass with Livewire
   - Check that interactive features still work

## File Structure

```
tests/
├── Livewire/              # Livewire components for testing
│   └── ButtonTest.php     # Example test component
├── views/
│   └── layout.blade.php   # Updated with Livewire directives
└── TestCase.php          # Register Livewire provider

resources/css/
└── app.css               # Updated @source for Livewire views
```

## Notes

**Livewire Benefits for Testing:**
- Automatic Alpine.js injection (no CDN needed)
- Server-side rendering and reactivity
- Real HTTP requests and responses
- Proper loading state handling
- Form validation testing
- Component lifecycle testing

**Configuration:**
- Livewire will use Orchestra Testbench's test environment
- Routes are automatically registered by Livewire
- Assets are served from vendor directory
- No additional configuration needed for basic usage
