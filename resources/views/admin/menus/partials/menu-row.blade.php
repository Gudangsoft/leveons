<tr>
    <td>
        <div class="menu-level-{{ $menu['level'] ?? 0 }}">
            @if(($menu['level'] ?? 0) > 0)
                @for($i = 0; $i < ($menu['level'] ?? 0); $i++)
                    @if($i == ($menu['level'] ?? 0) - 1)
                        <i class="bi bi-arrow-return-right text-muted me-1"></i>
                    @endif
                @endfor
            @endif
            
            <a href="{{ route('menu.show', $menu['slug']) }}" class="menu-title" target="_blank">
                {{ $menu['title'] }}
            </a>
            
            @if(!empty($menu['description']))
                <br><small class="text-muted">{{ Str::limit($menu['description'], 50) }}</small>
            @endif
        </div>
    </td>
    <td>
        @if($menu['type'] === 'page')
            <span class="badge bg-primary">Page</span>
        @elseif($menu['type'] === 'link')
            <span class="badge bg-info">Link</span>
        @elseif($menu['type'] === 'dropdown')
            <span class="badge bg-secondary">Dropdown</span>
        @endif
    </td>
    <td>
        <span class="badge bg-light text-dark">Level {{ $menu['level'] ?? 0 }}</span>
    </td>
    <td>
        <span class="badge bg-success">{{ $menu['sort_order'] ?? 0 }}</span>
    </td>
    <td>
        @if($menu['status'] === 'active')
            <span class="badge bg-success badge-status">Active</span>
        @else
            <span class="badge bg-danger badge-status">Inactive</span>
        @endif
    </td>
    <td class="menu-actions">
        <div class="btn-group btn-group-sm" role="group">
            <a href="{{ route('admin.menus.show', $menu['id']) }}" class="btn btn-outline-info" title="View">
                <i class="bi bi-eye"></i>
            </a>
            <a href="{{ route('admin.menus.edit', $menu['id']) }}" class="btn btn-outline-warning" title="Edit">
                <i class="bi bi-pencil"></i>
            </a>
        </div>
    </td>
</tr>

@if(isset($menu['children']) && count($menu['children']) > 0)
    @foreach($menu['children'] as $child)
        @include('admin.menus.partials.menu-row', ['menu' => $child, 'level' => ($menu['level'] ?? 0) + 1])
    @endforeach
@endif