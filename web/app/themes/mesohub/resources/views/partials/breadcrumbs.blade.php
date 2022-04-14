@if ($breadcrumbs)
  <nav class="breadcrumbs" id="breadcrumbs" role="navigation">
    <ol class="flex" itemscope itemtype="https://schema.org/BreadcrumbList" aria-label="breadcrumb navigation">
      @foreach ($breadcrumbs as $crumb)
        <li class="mr-1 last:mr-0" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          @if (!$loop->last)
            <a href="{{ $crumb->href }}" itemscope itemtype="https://schema.org/Thing" itemprop="item">
              @if ($crumb->text ==='Home')
                @svg('images.home', 'inline-block h-auto w-4')
              @else
                <span itemprop="name">{{ $crumb->text }}</span>
              @endif
            </a>
          @else
            <span itemscope itemtype="https://schema.org/Thing" itemprop="item" aria-current="page">
              <span itemprop="name">{{ $crumb->text }}</span>
            </span>
          @endif

          <meta itemprop="position" content="{{ $loop->iteration }}">
        </li>
      @endforeach
    </ol>
  </nav>
@endif
