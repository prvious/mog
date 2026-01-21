# Pagination

The Pagination component provides a complete navigation interface for paginated data sets. It integrates seamlessly with Laravel's pagination system (LengthAwarePaginator, CursorPaginator, and Paginator) and includes Livewire support for reactive page changes.

## Overview

Pagination helps users navigate through large data sets by dividing content into discrete pages. The component automatically adapts to different pagination types and provides accessible controls for moving between pages.

### When to Use

- **Data tables**: Navigate through large record sets
- **Search results**: Browse through search result pages
- **Product listings**: Page through product catalogs
- **Blog archives**: Navigate article or post listings
- **User directories**: Browse through user lists
- **API results**: Display paginated API responses

## Props

### `paginator`

**Type:** `LengthAwarePaginator | CursorPaginator | Paginator`
**Required:** Yes

The Laravel paginator instance to render. Supports three types:

- **LengthAwarePaginator**: Shows all page numbers with ellipsis for large ranges
- **CursorPaginator**: Shows only previous/next navigation for cursor-based pagination
- **Paginator**: Shows simple previous/next navigation without total pages

## Features

### Multi-Paginator Support

Automatically detects and adapts to different paginator types:

- **LengthAwarePaginator**: Full page number list with ellipsis
- **CursorPaginator**: Cursor-based navigation using encoded cursors
- **Paginator**: Simple previous/next navigation

### Livewire Integration

Built-in Livewire support for reactive pagination:

- `wire:click` directives for page changes
- No page reloads required
- Automatic loading states with button component
- Custom page names supported

### Responsive Design

Mobile-friendly interface:

- Previous/Next labels hidden on small screens
- Icon-only buttons on mobile
- Compact spacing for narrow viewports
- Touch-friendly button sizes

### Accessibility

ARIA attributes for screen readers:

- `role="navigation"` for semantic navigation
- `aria-label="pagination"` for context
- `aria-label` for previous/next buttons
- Active page indication via button variants

### Ellipsis Support

Smart ellipsis for large page ranges:

- Shows `...` for gaps in page numbers
- Disabled ellipsis buttons prevent interaction
- More horizontal icon for visual consistency

### Boundary States

Previous/Next buttons disabled at boundaries:

- Previous disabled on first page
- Next disabled on last page
- Visual indication via disabled state

## Usage Examples

### Basic Pagination with LengthAwarePaginator

```blade
{{-- In your Livewire component --}}
class UserList extends Component { public function render() { return view('livewire.user-list', [ 'users' => User::paginate(15), ]); } }

{{-- In your view --}}
<div>
    <x-table>
        <x-slot:header>
            <x-tr>
                <x-th>Name</x-th>
                <x-th>Email</x-th>
                <x-th>Role</x-th>
            </x-tr>
        </x-slot:header>

        <x-slot:body>
            @foreach ($users as $user)
                <x-tr>
                    <x-cell>{{ $user->name }}</x-cell>
                    <x-cell>{{ $user->email }}</x-cell>
                    <x-cell>{{ $user->role }}</x-cell>
                </x-tr>
            @endforeach
        </x-slot:body>
    </x-table>

    <div class="mt-4">
        <x-pagination :paginator="$users" />
    </div>
</div>
```

### Cursor-Based Pagination

```blade
{{-- Efficient for large datasets --}}
class ActivityFeed extends Component { public function render() { return view('livewire.activity-feed', [ 'activities' => Activity::latest()
->cursorPaginate(20), ]); } }

{{-- In your view --}}
<div class="space-y-4">
    @foreach ($activities as $activity)
        <x-card>
            <x-slot:content>
                <div class="flex items-start gap-3">
                    <div class="text-muted-foreground">
                        @svg('lucide-activity', 'size-5')
                    </div>
                    <div class="flex-1">
                        <p class="font-medium">{{ $activity->title }}</p>
                        <p class="text-muted-foreground text-sm">{{ $activity->description }}</p>
                        <time class="text-muted-foreground mt-1 text-xs">
                            {{ $activity->created_at->diffForHumans() }}
                        </time>
                    </div>
                </div>
            </x-slot:content>
        </x-card>
    @endforeach

    <x-pagination :paginator="$activities" />
</div>
```

### Simple Paginator

```blade
{{-- For when you don't need total page count --}}
class PostList extends Component { public function render() { return view('livewire.post-list', [ 'posts' => Post::simplePaginate(10), ]); } }

{{-- In your view --}}
<div>
    <div class="grid gap-6 md:grid-cols-2">
        @foreach ($posts as $post)
            <x-card>
                <x-slot:header>
                    <x-slot:title>{{ $post->title }}</x-slot:title>
                    <x-slot:description>{{ $post->excerpt }}</x-slot:description>
                </x-slot:header>

                <x-slot:content>
                    <img
                        src="{{ $post->image }}"
                        alt="{{ $post->title }}"
                        class="rounded-lg" />
                </x-slot:content>

                <x-slot:footer>
                    <x-button
                        variant="outline"
                        href="{{ route('posts.show', $post) }}">
                        Read More
                    </x-button>
                </x-slot:footer>
            </x-card>
        @endforeach
    </div>

    <div class="mt-6">
        <x-pagination :paginator="$posts" />
    </div>
</div>
```

### Multiple Paginators on Same Page

```blade
{{-- Use custom page names for multiple paginators --}}
class Dashboard extends Component { public function render() { return view('livewire.dashboard', [ 'recentOrders' => Order::latest() ->paginate(5, ['*'],
'orders_page'), 'topProducts' => Product::orderBy('sales', 'desc') ->paginate(5, ['*'], 'products_page'), ]); } }

{{-- In your view --}}
<div class="grid gap-6 lg:grid-cols-2">
    <x-card>
        <x-slot:header>
            <x-slot:title>Recent Orders</x-slot:title>
        </x-slot:header>

        <x-slot:content>
            <x-table>
                <x-slot:body>
                    @foreach ($recentOrders as $order)
                        <x-tr>
                            <x-cell>{{ $order->number }}</x-cell>
                            <x-cell>{{ $order->customer }}</x-cell>
                            <x-cell>${{ $order->total }}</x-cell>
                        </x-tr>
                    @endforeach
                </x-slot:body>
            </x-table>
        </x-slot:content>

        <x-slot:footer>
            <x-pagination :paginator="$recentOrders" />
        </x-slot:footer>
    </x-card>

    <x-card>
        <x-slot:header>
            <x-slot:title>Top Products</x-slot:title>
        </x-slot:header>

        <x-slot:content>
            <x-table>
                <x-slot:body>
                    @foreach ($topProducts as $product)
                        <x-tr>
                            <x-cell>{{ $product->name }}</x-cell>
                            <x-cell>{{ $product->sales }} sold</x-cell>
                        </x-tr>
                    @endforeach
                </x-slot:body>
            </x-table>
        </x-slot:content>

        <x-slot:footer>
            <x-pagination :paginator="$topProducts" />
        </x-slot:footer>
    </x-card>
</div>
```

### Search Results with Pagination

```blade
class SearchResults extends Component { public $query = ''; public function render() { $results = collect(); if ($this->query) { $results =
Article::search($this->query) ->paginate(20); } return view('livewire.search-results', [ 'results' => $results, ]); } }

{{-- In your view --}}
<div>
    <div class="mb-6">
        <x-input-group>
            <x-input
                wire:model.live.debounce.300ms="query"
                type="search"
                placeholder="Search articles..." />
            <x-slot:icon>
                @svg('lucide-search')
            </x-slot:icon>
        </x-input-group>
    </div>

    @if ($query && $results->total() > 0)
        <div class="mb-4">
            <p class="text-muted-foreground text-sm">Found {{ $results->total() }} results for "{{ $query }}"</p>
        </div>

        <div class="space-y-4">
            @foreach ($results as $result)
                <x-card>
                    <x-slot:content>
                        <h3 class="font-semibold">{{ $result->title }}</h3>
                        <p class="text-muted-foreground mt-1 text-sm">
                            {{ $result->excerpt }}
                        </p>
                        <div class="mt-2">
                            <x-link href="{{ route('articles.show', $result) }}">Read more →</x-link>
                        </div>
                    </x-slot:content>
                </x-card>
            @endforeach
        </div>

        <div class="mt-6">
            <x-pagination :paginator="$results" />
        </div>
    @elseif ($query)
        <x-empty
            icon="lucide-search-x"
            title="No results found"
            description="Try adjusting your search terms" />
    @endif
</div>
```

### Product Catalog with Filters

```blade
class ProductCatalog extends Component { public $category = null; public $priceRange = 'all'; public $sortBy = 'newest'; public function render() { $query =
Product::query(); if ($this->category) { $query->where('category_id', $this->category); } if ($this->priceRange === 'under-50') { $query->where('price', '<',
50); } elseif ($this->priceRange === '50-100') { $query->whereBetween('price', [50, 100]); } elseif ($this->priceRange === 'over-100') { $query->where('price',
'>', 100); } $query->orderBy( match ($this->sortBy) { 'price-low' => 'price', 'price-high' => 'price', 'name' => 'name', default => 'created_at', }, match
($this->sortBy) { 'price-high' => 'desc', default => 'asc', } ); return view('livewire.product-catalog', [ 'products' => $query->paginate(12), ]); } }

{{-- In your view --}}
<div>
    <div class="mb-6 flex flex-wrap gap-4">
        <x-select wire:model.live="category">
            <x-slot:trigger>
                <x-slot:label>Category</x-slot:label>
            </x-slot:trigger>
            <x-slot:content>
                <x-select-item value="">All Categories</x-select-item>
                <x-select-item value="1">Electronics</x-select-item>
                <x-select-item value="2">Clothing</x-select-item>
                <x-select-item value="3">Books</x-select-item>
            </x-slot:content>
        </x-select>

        <x-select wire:model.live="priceRange">
            <x-slot:trigger>
                <x-slot:label>Price Range</x-slot:label>
            </x-slot:trigger>
            <x-slot:content>
                <x-select-item value="all">All Prices</x-select-item>
                <x-select-item value="under-50">Under $50</x-select-item>
                <x-select-item value="50-100">$50 - $100</x-select-item>
                <x-select-item value="over-100">Over $100</x-select-item>
            </x-slot:content>
        </x-select>

        <x-select wire:model.live="sortBy">
            <x-slot:trigger>
                <x-slot:label>Sort By</x-slot:label>
            </x-slot:trigger>
            <x-slot:content>
                <x-select-item value="newest">Newest</x-select-item>
                <x-select-item value="name">Name</x-select-item>
                <x-select-item value="price-low">Price: Low to High</x-select-item>
                <x-select-item value="price-high">Price: High to Low</x-select-item>
            </x-slot:content>
        </x-select>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($products as $product)
            <x-card>
                <x-slot:content class="p-0">
                    <x-aspect-ratio ratio="4/3">
                        <img
                            src="{{ $product->image }}"
                            alt="{{ $product->name }}"
                            class="size-full object-cover" />
                    </x-aspect-ratio>

                    <div class="p-4">
                        <h3 class="font-semibold">{{ $product->name }}</h3>
                        <p class="text-muted-foreground mt-1 text-sm">
                            {{ $product->category->name }}
                        </p>
                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-lg font-bold">${{ $product->price }}</span>
                            <x-button size="sm">Add to Cart</x-button>
                        </div>
                    </div>
                </x-slot:content>
            </x-card>
        @endforeach
    </div>

    <div class="mt-8">
        <x-pagination :paginator="$products" />
    </div>
</div>
```

### Custom Styling

```blade
{{-- Center aligned with custom spacing --}}
<x-pagination
    :paginator="$items"
    class="mt-8" />

{{-- Left aligned --}}
<x-pagination
    :paginator="$items"
    class="mt-8 justify-start" />

{{-- Right aligned --}}
<x-pagination
    :paginator="$items"
    class="mt-8 justify-end" />

{{-- With custom container --}}
<div class="bg-muted rounded-lg p-4">
    <div class="mb-2 text-center">
        <span class="text-muted-foreground text-sm">Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} results</span>
    </div>
    <x-pagination :paginator="$items" />
</div>
```

### Blog Archive with Posts

```blade
class BlogArchive extends Component { public function render() { return view('livewire.blog-archive', [ 'posts' => Post::with('author', 'category')
->published() ->latest('published_at') ->paginate(10), ]); } }

{{-- In your view --}}
<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Blog</h1>
        <p class="text-muted-foreground mt-2">Latest articles and updates from our team</p>
    </div>

    <div class="space-y-8">
        @foreach ($posts as $post)
            <article class="group">
                <div class="grid gap-6 md:grid-cols-3">
                    <div class="md:col-span-1">
                        <x-aspect-ratio ratio="16/9">
                            <img
                                src="{{ $post->featured_image }}"
                                alt="{{ $post->title }}"
                                class="size-full rounded-lg object-cover transition-transform group-hover:scale-105" />
                        </x-aspect-ratio>
                    </div>

                    <div class="md:col-span-2">
                        <div class="flex items-center gap-2">
                            <x-badge size="sm">{{ $post->category->name }}</x-badge>
                            <span class="text-muted-foreground text-sm">
                                {{ $post->published_at->format('M d, Y') }}
                            </span>
                        </div>

                        <h2 class="group-hover:text-primary mt-3 text-2xl font-bold transition-colors">
                            <a href="{{ route('blog.show', $post) }}">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <p class="text-muted-foreground mt-2">
                            {{ $post->excerpt }}
                        </p>

                        <div class="mt-4 flex items-center gap-3">
                            <img
                                src="{{ $post->author->avatar }}"
                                alt="{{ $post->author->name }}"
                                class="size-8 rounded-full" />
                            <span class="text-sm font-medium">
                                {{ $post->author->name }}
                            </span>
                        </div>
                    </div>
                </div>
            </article>

            @if (! $loop->last)
                <x-separator />
            @endif
        @endforeach
    </div>

    <div class="mt-10">
        <x-pagination :paginator="$posts" />
    </div>
</div>
```

### User Directory

```blade
class UserDirectory extends Component { public $search = ''; public $role = ''; public function render() { $query = User::query(); if ($this->search) {
$query->where(function ($q) { $q->where('name', 'like', "%{$this->search}%") ->orWhere('email', 'like', "%{$this->search}%"); }); } if ($this->role) {
$query->where('role', $this->role); } return view('livewire.user-directory', [ 'users' => $query->paginate(20), ]); } }

{{-- In your view --}}
<div>
    <div class="mb-6 flex gap-4">
        <div class="flex-1">
            <x-input-group>
                <x-input
                    wire:model.live.debounce.300ms="search"
                    type="search"
                    placeholder="Search users..." />
                <x-slot:icon>
                    @svg('lucide-search')
                </x-slot:icon>
            </x-input-group>
        </div>

        <x-select wire:model.live="role">
            <x-slot:trigger>
                <x-slot:label>Filter by role</x-slot:label>
            </x-slot:trigger>
            <x-slot:content>
                <x-select-item value="">All Roles</x-select-item>
                <x-select-item value="admin">Admin</x-select-item>
                <x-select-item value="editor">Editor</x-select-item>
                <x-select-item value="user">User</x-select-item>
            </x-slot:content>
        </x-select>
    </div>

    <x-card>
        <x-slot:content class="p-0">
            <x-table>
                <x-slot:header>
                    <x-tr>
                        <x-th>User</x-th>
                        <x-th>Email</x-th>
                        <x-th>Role</x-th>
                        <x-th>Joined</x-th>
                        <x-th class="text-right">Actions</x-th>
                    </x-tr>
                </x-slot:header>

                <x-slot:body>
                    @foreach ($users as $user)
                        <x-tr>
                            <x-cell>
                                <div class="flex items-center gap-3">
                                    <img
                                        src="{{ $user->avatar }}"
                                        alt="{{ $user->name }}"
                                        class="size-8 rounded-full" />
                                    <span class="font-medium">{{ $user->name }}</span>
                                </div>
                            </x-cell>
                            <x-cell>{{ $user->email }}</x-cell>
                            <x-cell>
                                <x-badge>{{ $user->role }}</x-badge>
                            </x-cell>
                            <x-cell>{{ $user->created_at->format('M d, Y') }}</x-cell>
                            <x-cell class="text-right">
                                <x-button
                                    size="sm"
                                    variant="outline">
                                    View Profile
                                </x-button>
                            </x-cell>
                        </x-tr>
                    @endforeach
                </x-slot:body>
            </x-table>
        </x-slot:content>

        <x-slot:footer>
            <x-pagination :paginator="$users" />
        </x-slot:footer>
    </x-card>
</div>
```

### API Results Pagination

```blade
class ApiExplorer extends Component { public $endpoint = 'users'; public function render() { $results = Http::get("https://api.example.com/{$this->endpoint}")
->json(); // Convert API results to paginator $paginator = new LengthAwarePaginator( collect($results['data']), $results['total'], $results['per_page'],
$results['current_page'], ['path' => request()->url()] ); return view('livewire.api-explorer', [ 'results' => $paginator, ]); } }

{{-- In your view --}}
<div>
    <x-card>
        <x-slot:header>
            <x-slot:title>API Explorer</x-slot:title>
            <x-slot:description>Browse API results with pagination</x-slot:description>
        </x-slot:header>

        <x-slot:content>
            <x-scrollable class="max-h-96">
                <pre class="text-xs"><code>{{ json_encode($results->items(), JSON_PRETTY_PRINT) }}</code></pre>
            </x-scrollable>
        </x-slot:content>

        <x-slot:footer>
            <x-pagination :paginator="$results" />
        </x-slot:footer>
    </x-card>
</div>
```

## Accessibility

### Navigation Semantics

The component uses proper ARIA attributes:

```blade
{{-- Automatic ARIA attributes --}}
<nav
    role="navigation"
    aria-label="pagination">
    {{-- Pagination content --}}
</nav>

{{-- Previous/Next buttons include descriptive labels --}}
<button aria-label="Go to previous page">Previous</button>
<button aria-label="Go to next page">Next</button>
```

### Keyboard Navigation

Users can navigate with keyboard:

- **Tab**: Move between pagination buttons
- **Enter/Space**: Activate the focused button
- **Shift + Tab**: Move backwards through buttons

### Active Page Indication

Current page is clearly indicated:

```blade
{{-- Active page uses outline variant --}}
<x-button variant="outline">2</x-button>

{{-- Inactive pages use ghost variant --}}
<x-button variant="ghost">3</x-button>
```

### Disabled States

Proper disabled states at boundaries:

```blade
{{-- First page: Previous button disabled --}}
@if ($paginator->onFirstPage())
    <x-button
        variant="ghost"
        disabled
        aria-label="Go to previous page">
        Previous
    </x-button>
@endif

{{-- Last page: Next button disabled --}}
@if (! $paginator->hasMorePages())
    <x-button
        variant="ghost"
        disabled
        aria-label="Go to next page">
        Next
    </x-button>
@endif
```

## Best Practices

### Always Show Total Results

```blade
{{-- Good: Show result count for context --}}
<div class="mb-4">
    <p class="text-muted-foreground text-sm">Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} results</p>
</div>
<x-pagination :paginator="$items" />

{{-- Avoid: Pagination without context --}}
<x-pagination :paginator="$items" />
```

### Use Appropriate Paginator Type

```blade
{{-- Good: Use LengthAwarePaginator when you need total pages --}}
$products = Product::paginate(20);

{{-- Good: Use CursorPaginator for large datasets --}}
$logs = Log::cursorPaginate(50);

{{-- Good: Use simplePaginate when total count is expensive --}}
$posts = Post::simplePaginate(10);
```

### Maintain Filters Across Pages

```blade
{{-- Good: Preserve query parameters --}}
class ProductList extends Component { public $category = null; public $search = ''; public function render() { return view('livewire.product-list', [ 'products'
=> Product::query() ->when($this->category, fn($q) => $q->where('category_id', $this->category)) ->when($this->search, fn($q) => $q->where('name', 'like',
"%{$this->search}%")) ->paginate(20), ]); } }
```

### Provide Visual Feedback

```blade
{{-- Good: Loading states handled automatically --}}
<x-pagination :paginator="$items" />
{{-- Button component shows loading spinner during Livewire navigation --}}

{{-- Good: Add transition effects --}}
<div wire:loading.class="opacity-50 transition-opacity">
    @foreach ($items as $item)
        {{-- Item content --}}
    @endforeach
</div>
```

### Consider Mobile Users

```blade
{{-- Good: Responsive labels --}}
<x-button>
    @svg('lucide-chevron-left')
    <span class="hidden sm:block">Previous</span>
</x-button>

{{-- The component already handles this internally --}}
```

## Technical Details

### Component Structure

```blade
<nav
    role="navigation"
    aria-label="pagination"
    data-slot="pagination"
    class="mx-auto flex w-full justify-center">
    <ul
        data-slot="pagination-content"
        class="flex flex-row items-center gap-1">
        {{-- Previous button --}}
        <li data-active="false">...</li>

        {{-- Page number buttons --}}
        <li data-active="true|false">...</li>

        {{-- Next button --}}
        <li data-active="false">...</li>
    </ul>
</nav>
```

### Livewire Methods

The component uses different Livewire methods based on paginator type:

```php
// LengthAwarePaginator
wire:click="previousPage('page')"
wire:click="nextPage('page')"
wire:click="gotoPage(2, 'page')"

// CursorPaginator
wire:click="setPage('encoded_cursor', 'cursor')"

// Paginator
wire:click="previousPage('page')"
wire:click="nextPage('page')"
```

### CSS Classes

```css
/* Navigation container */
mx-auto flex w-full justify-center

/* Pagination list */
flex flex-row items-center gap-1

/* Page buttons */
flex size-9 items-center justify-center

/* Previous/Next buttons */
gap-1 px-2.5 sm:pr-2.5

/* Responsive labels */
hidden sm:block
```

### Data Attributes

- `data-slot="pagination"`: Main container identifier
- `data-slot="pagination-content"`: Content wrapper identifier
- `data-active="true|false"`: Indicates active/current page

## Related Components

- [Button](./button.md) - Used for page number and navigation buttons
- [Link](./link.md) - Alternative for simple navigation links
- [Table](./table.md) - Common use case for pagination
- [Card](./card.md) - Container for paginated content

## Common Patterns

### Pagination with Empty State

```blade
<div>
    @if ($items->count() > 0)
        <div class="grid gap-4">
            @foreach ($items as $item)
                {{-- Item content --}}
            @endforeach
        </div>

        <div class="mt-6">
            <x-pagination :paginator="$items" />
        </div>
    @else
        <x-empty
            icon="lucide-inbox"
            title="No items found"
            description="There are no items to display" />
    @endif
</div>
```

### Sticky Pagination Footer

```blade
<div class="flex min-h-screen flex-col">
    <div class="flex-1">
        @foreach ($items as $item)
            {{-- Item content --}}
        @endforeach
    </div>

    <div class="bg-background border-border sticky bottom-0 border-t py-4">
        <x-pagination :paginator="$items" />
    </div>
</div>
```

### Pagination with Per-Page Selector

```blade
<div>
    <div class="mb-4 flex items-center justify-between">
        <p class="text-muted-foreground text-sm">Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} results</p>

        <x-select wire:model.live="perPage">
            <x-slot:trigger>
                <x-slot:label>Per page: {{ $perPage }}</x-slot:label>
            </x-slot:trigger>
            <x-slot:content>
                <x-select-item value="10">10</x-select-item>
                <x-select-item value="25">25</x-select-item>
                <x-select-item value="50">50</x-select-item>
                <x-select-item value="100">100</x-select-item>
            </x-slot:content>
        </x-select>
    </div>

    {{-- Content --}}

    <x-pagination :paginator="$items" />
</div>
```
