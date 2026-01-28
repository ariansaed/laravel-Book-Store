<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="https://netcopy.ir"></a>
    <div class="profile__info border cursor-pointer text-center">
        <div class="avatar__img"><img src="{{ asset('Admin-dist/img/pro.jpg') }}" class="avatar___img" alt="">
            <input type="file" accept="image/*" class="hidden avatar-img__input">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name"> کاربر : {{ auth()->user()->name }} </span>
    </div>

    <ul>
        <li class="item-li i-dashboard {{ Route::is('admin.dashboard') ? 'is-active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">پیشخوان</a>
        </li>
        <li class="item-li i-users {{ Route::is('admin.users.create') ? 'is-active' : '' }}">
            <a href="{{ route('admin.users.create') }}">ایجاد کاربران</a>
        </li>
        <li class="item-li i-users {{ Route::is('admin.users.index') ? 'is-active' : '' }}">
            <a href="{{ route('admin.users.index') }}">کاربران</a>
        </li>
        <li class="item-li"><b>مدیریت گروه بندی ها</b></li>
        <li class="item-li i-categories {{ Route::is('admin.categories.create') ? 'is-active' : '' }}">
            <a href="{{ route('admin.categories.create') }}">ایجاد گروه بندی</a>
        </li>
        <li class="item-li i-courses {{ Route::is('admin.categories.index') ? 'is-active' : '' }}">
            <a href="{{ route('admin.categories.index') }}">لیست گروه بندی ها</a>
        </li>
        <li class="item-li"><b>مدیریت محصولات</b></li>
        <li class="item-li i-categories {{ Route::is('admin.products.create') ? 'is-active' : '' }}">
            <a href="{{ route('admin.products.create') }}">ایجاد محصول</a>
        </li>
        <li class="item-li i-courses {{ Route::is('admin.products.index') ? 'is-active' : '' }}">
            <a href="{{ route('admin.products.index') }}">لیست محصولات</a>
        </li>
        <li class="item-li"><b>مدیریت بلاگ</b></li>
        <li class="item-li i-categories {{ Route::is('admin.blogs.create') ? 'is-active' : '' }}">
            <a href="{{ route('admin.blogs.create') }}">ایجاد بلاگ</a>
        </li>
        <li class="item-li i-courses {{ Route::is('admin.blogs.index') ? 'is-active' : '' }}">
            <a href="{{ route('admin.blogs.index') }}">لیست بلاگ ها</a>
        </li>



        {{--        <li class="item-li i-slideshow"><a href="slideshow.html">اسلایدشو</a></li> --}}
        {{--        <li class="item-li i-banners"><a href="banners.html">بنر ها</a></li> --}}
        {{--        <li class="item-li i-articles"><a href="articles.html">مقالات</a></li> --}}
        {{--        <li class="item-li i-ads"><a href="ads.html">تبلیغات</a></li> --}}
        {{--        <li class="item-li i-comments"><a href="comments.html"> نظرات</a></li> --}}
        {{--        <li class="item-li i-tickets"><a href="tickets.html"> تیکت ها</a></li> --}}
        {{--        <li class="item-li i-discounts"><a href="discounts.html">تخفیف ها</a></li> --}}
        {{--        <li class="item-li i-transactions"><a href="transactions.html">تراکنش ها</a></li> --}}
        {{--        <li class="item-li i-checkouts"><a href="checkouts.html">تسویه حساب ها</a></li> --}}
        {{--        <li class="item-li i-checkout__request "><a href="checkout-request.html">درخواست تسویه </a></li> --}}
        {{--        <li class="item-li i-my__purchases"><a href="mypurchases.html">خرید های من</a></li> --}}
        {{--        <li class="item-li i-my__peyments"><a href="mypeyments.html">پرداخت های من</a></li> --}}
        {{--        <li class="item-li i-notification__management"><a href="notification-management.html">مدیریت اطلاع رسانی</a> --}}
        {{--        </li> --}}
        <li class="item-li i-user__inforamtion"><a href="#">اطلاعات کاربری</a></li>
    </ul>

</div>
