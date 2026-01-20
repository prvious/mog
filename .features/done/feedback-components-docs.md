---
name: feedback-components-documentation
description: Document feedback components (alert, badge, spinner, toast, etc.)
depends_on: null
---

## Feature Description

Create comprehensive documentation for feedback and status components: `alert`, `badge`, `spinner`, `skeleton`, `empty`, `toaster`, `error`, and `tooltip`.

These components provide visual feedback to users about system status, loading states, validation errors, notifications, and empty states.

## Implementation Plan

### Documentation Structure

**Files to create:**
- `docs/alert.md` - Alert notification component
- `docs/badge.md` - Badge/label component
- `docs/spinner.md` - Loading spinner component
- `docs/skeleton.md` - Skeleton loading placeholder
- `docs/empty.md` - Empty state component
- `docs/toaster.md` - Toast notification system
- `docs/tooltip.md` - Tooltip component
- `docs/error.md` - Error message component

### Each Documentation Should Include

1. **Overview**
   - Component purpose
   - When to use vs alternatives

2. **Component API**
   - Props with types and defaults
   - Variants and styles
   - Slots

3. **Usage Examples**
   - Basic usage
   - All variants
   - Common patterns
   - Livewire integration (for toaster, error)

4. **Accessibility**
   - ARIA attributes
   - Screen reader announcements
   - Keyboard interactions (tooltip)

## Acceptance Criteria

- [ ] `docs/alert.md` is created with alert variants and icons
- [ ] `docs/badge.md` is created with badge styles and use cases
- [ ] `docs/spinner.md` is created with sizing examples
- [ ] `docs/skeleton.md` is created with loading patterns
- [ ] `docs/empty.md` is created with empty state patterns
- [ ] `docs/toaster.md` is created with notification system usage
- [ ] `docs/tooltip.md` is created with positioning examples
- [ ] `docs/error.md` is created with error display patterns
- [ ] At least 3 examples per component
- [ ] All variants are documented
- [ ] Livewire integration examples where applicable
- [ ] Accessibility features are documented
- [ ] Code examples are tested and formatted

## Testing Strategy

**Manual Testing**
- Review locations: All `docs/*.md` files created
- Validation steps:
  - Test alert variants render correctly
  - Verify badge styles and sizing
  - Check spinner animations work
  - Test skeleton loading patterns
  - Validate empty state messaging
  - Test toaster notification system
  - Check tooltip positioning
  - Verify error component integration with forms
  - Test accessibility with screen reader (if possible)

## Code Formatting

Format all code using: Prettier with Blade plugin

Command to run: `pnpm run format`

## Additional Notes

- Alert component likely has variants (info, warning, error, success)
- Badge component may support color variants and sizes
- Spinner is used within button loading states
- Skeleton provides visual placeholder during content loading
- Empty component helps with zero-state UX
- Toaster integrates with Livewire for notifications
- Tooltip uses floating-ui for positioning
- Error component integrates with field validation
- All components support dark mode
- Icons from blade-tabler-icons are likely used
