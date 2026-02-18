<header class="header">
    <div class="header-1">
        <a href="#" class="logo"> <i class="fas fa-book"></i> کتابخانه </a>
        <form action="" class="search-form">
            <input type="search" name="" placeholder="جستجو کنید" id="search-box">
            <label for="search-box" class="fas fa-search"></label>
        </form>
        <div class="icons">
            <div id="search-btn" class="fas fa-search"></div>
            <a href="#" class="fas fa-heart"></a>
            <a href="#" class="fas fa-shopping-cart"></a>
            <a href="{{ route('admin.dashboard') }}" class="fas fa-user"></a>
        </div>
    </div>
    <div class="header-2">
        <nav class="navbar" style="    justify-content: center;">
            <a href="index.html">خانه</a>
            <a href="#featured">ویژه</a>
            <a href="{{ route('products.index') }}">جدیدها</a>
            <a href="#reviews">نظرات</a>
            <a href="blog-archive.html">وبلاگ</a>

            <div class="pure-dropdown">
                <a href="#" class="pure-dropdown-toggle">
                    دسته بندی ها <i class="fas fa-angle-down"></i>
                </a>
                <div class="pure-dropdown-menu">
                    @foreach ($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                            class="pure-dropdown-item">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- header section ends -->
<!-- bottom navbar  -->
<nav class="bottom-navbar">
    <a href="#home" class="fas fa-home"></a>
    <a href="#featured" class="fas fa-list"></a>
    <a href="#arrivals" class="fas fa-tags"></a>
    <a href="#reviews" class="fas fa-comments"></a>
    <a href="#blogs" class="fas fa-blog"></a>
</nav>
