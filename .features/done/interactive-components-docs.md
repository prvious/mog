---
name: interactive-components-documentation
description: Document interactive overlay components (accordion, dialog, dropdown, etc.)
depends_on: null
---

## Feature Description

Create comprehensive documentation for interactive overlay and disclosure components: `accordion`, `dialog`, `dropdown`, `popover`, `slide-over`, and `overlay`.

These components provide interactive UI elements that reveal or hide content, create modal experiences, and display contextual information through popovers and dropdowns.

## Implementation Plan

### Documentation Structure

**Files to create:**
- `docs/accordion.md` - Collapsible content sections
- `docs/dialog.md` - Modal dialog component
- `docs/dropdown.md` - Dropdown menu component
- `docs/popover.md` - Popover overlay component
- `docs/slide-over.md` - Slide-over panel component
- `docs/overlay.md` - Base overlay component

### Each Documentation Should Include

1. **Overview**
   - Component purpose and use cases
   - When to use vs alternatives

2. **Component API**
   - Props with types and defaults
   - Slots (trigger, content, etc.)
   - Alpine.js state management
   - Positioning options (for dropdown, popover)

3. **Usage Examples**
   - Basic usage
   - Controlled vs uncontrolled
   - With Livewire
   - Nested content
   - Custom triggers
   - Positioning variants

4. **Interactivity**
   - Open/close behavior
   - Keyboard navigation
   - Focus management
   - Click outside handling

5. **Accessibility**
   - ARIA attributes
   - Focus trapping (dialog, slide-over)
   - Keyboard shortcuts
   - Screen reader support

## Acceptance Criteria

- [ ] `docs/accordion.md` is created with collapsible examples
- [ ] `docs/dialog.md` is created with modal patterns
- [ ] `docs/dropdown.md` is created with menu examples
- [ ] `docs/popover.md` is created with positioning options
- [ ] `docs/slide-over.md` is created with panel patterns
- [ ] `docs/overlay.md` is created with base overlay usage
- [ ] At least 4 examples per component
- [ ] Alpine.js state management is documented
- [ ] Keyboard navigation is documented
- [ ] Accessibility features are thoroughly covered
- [ ] Positioning and placement options documented
- [ ] Focus management behavior explained
- [ ] Code examples are tested and formatted

## Testing Strategy

**Manual Testing**
- Review locations: All `docs/*.md` files created
- Validation steps:
  - Test accordion open/close functionality
  - Verify dialog focus trapping
  - Check dropdown positioning
  - Test popover placement options
  - Validate slide-over animations
  - Test keyboard navigation (Escape, Tab, arrows)
  - Verify click-outside-to-close behavior
  - Check accessibility with screen reader
  - Test with Livewire integration

## Code Formatting

Format all code using: Prettier with Blade plugin

Command to run: `pnpm run format`

## Additional Notes

- Accordion uses Alpine.js x-data for state management
- Accordion supports `collapsible` prop to disable collapsing
- Dialog and slide-over likely use focus trap for accessibility
- Dropdown and popover use floating-ui for positioning
- Components use `data-state` attribute for CSS transitions
- Overlay component is likely base for dialog, slide-over
- Components support `x-modelable` for two-way binding
- Escape key should close overlay components
- Trigger slots use `data-ignore-trigger` pattern
- Focus should return to trigger element on close
- Components integrate with Livewire for dynamic content
