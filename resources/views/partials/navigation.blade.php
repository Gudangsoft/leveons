<!-- Dynamic Navigation Menu -->
@if(isset($navigationMenus) && !empty($navigationMenus))
    @foreach($navigationMenus as $menu)
        @if($menu['slug'] === 'home')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">{{ $menu['title'] }}</a>
            </li>
        @elseif($menu['slug'] === 'service' && !empty($menu['children']))
            <li class="nav-item dropdown mega-dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $menu['title'] }}
                </a>
                <div class="dropdown-menu mega-dropdown-menu" aria-labelledby="servicesDropdown">
                    <div class="row">
                        @foreach($menu['children'] as $serviceCategory)
                            <div class="col-lg-4 mega-menu-column">
                                <div class="mega-menu-title">{{ $serviceCategory['title'] }}</div>
                                
                                @if($serviceCategory['slug'] === 'consulting' && !empty($serviceCategory['children']))
                                    {{-- Consulting memiliki 8 area utama --}}
                                    @foreach($serviceCategory['children'] as $consultingArea)
                                        @if(!empty($consultingArea['children']))
                                            {{-- Area dengan sub-items (dropdown) --}}
                                            <div class="mega-menu-item dropdown-submenu">
                                                <a href="{{ route('menu.show', ['slug' => $consultingArea['slug']]) }}" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    {{ $consultingArea['title'] }}
                                                </a>
                                                <div class="dropdown-menu">
                                                    @foreach($consultingArea['children'] as $subItem)
                                                        <a class="dropdown-item" href="{{ route('menu.show', ['slug' => $subItem['slug']]) }}">
                                                            {{ $subItem['title'] }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            {{-- Area tanpa sub-items (single page) --}}
                                            <div class="mega-menu-item">
                                                <a href="{{ route('menu.show', ['slug' => $consultingArea['slug']]) }}">
                                                    {{ $consultingArea['title'] }}
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                @elseif($serviceCategory['slug'] === 'research' && !empty($serviceCategory['children']))
                                    {{-- Research services --}}
                                    @foreach($serviceCategory['children'] as $researchItem)
                                        <div class="mega-menu-item">
                                            <a href="{{ route('menu.show', ['slug' => $researchItem['slug']]) }}">
                                                {{ $researchItem['title'] }}
                                            </a>
                                        </div>
                                    @endforeach
                                @elseif($serviceCategory['slug'] === 'academy' && !empty($serviceCategory['children']))
                                    {{-- Academy programs --}}
                                    @foreach($serviceCategory['children'] as $academyProgram)
                                        <div class="mega-menu-item">
                                            <a href="{{ route('menu.show', ['slug' => $academyProgram['slug']]) }}">
                                                {{ $academyProgram['title'] }}
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    {{-- Fallback untuk kategori lain --}}
                                    @if(!empty($serviceCategory['children']))
                                        @foreach($serviceCategory['children'] as $service)
                                            <div class="mega-menu-item">
                                                <a href="{{ route('menu.show', ['slug' => $service['slug']]) }}">
                                                    {{ $service['title'] }}
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('menu.show', ['slug' => $menu['slug']]) }}">{{ $menu['title'] }}</a>
            </li>
        @endif
    @endforeach
@endif