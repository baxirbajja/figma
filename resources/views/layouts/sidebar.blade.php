<nav class="sidebar bg-white">
    <div class="sidebar-background"></div>
    <div class="active-indicator"></div>
    
    <!-- Logo -->
    <div class="logo-container bg-white">
        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="logo">
    </div>

    <!-- Menu Items -->
    <ul class="menu-list bg-white">
        <li>
            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="menu-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 13h8v7H4v-7zm0-9h8v7H4V4zm10 0h8v7h-8V4zm0 9h8v7h-8v-7z" fill="currentColor"/>
                </svg>
                <span>Tableau de bord</span>
            </a>
        </li>
        <li>
            <a href="{{ route('orders.index') }}" class="menu-item {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                <svg class="menu-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" fill="currentColor"/>
                </svg>
                <span>Commandes</span>
            </a>
        </li>
        <li>
            <a href="{{ route('products.index') }}" class="menu-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <svg class="menu-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z" fill="currentColor"/>
                </svg>
                <span>Gestion des produits</span>
            </a>
        </li>
        <li>
            <a href="{{ route('ingredients.index') }}" class="menu-item {{ request()->routeIs('ingredients.*') ? 'active' : '' }}">
                <svg class="menu-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 19c-1.1 0-2 .9-2 2h14c0-1.1-.9-2-2-2h-4v-2h3c1.1 0 2-.9 2-2h-8c-1.66 0-3-1.34-3-3 0-1.09.59-2.04 1.47-2.57.41.59 1.06 1 1.83 1.06.7.06 1.36-.19 1.85-.62l.59 1.61.94-.34.34.94 1.88-.68-.34-.94.94-.34-2.74-7.52-.94.34-.34-.94-1.88.68.34.94-.94.34.56 1.55c-.47.43-1.13.68-1.83.62-.77-.06-1.42-.47-1.83-1.06C5.59 8.96 5 9.91 5 11c0 1.66 1.34 3 3 3h1v3H7v2z" fill="currentColor"/>
                </svg>
                <span>Gestion des ingrédients</span>
            </a>
        </li>
        <li>
            <a href="#" class="menu-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <svg class="menu-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z" fill="currentColor"/>
                </svg>
                <span>Gestion des catégories</span>
            </a>
        </li>
        <li>
            <a href="#" class="menu-item {{ request()->routeIs('promo-codes.*') ? 'active' : '' }}">
                <svg class="menu-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM13 20.01L4 11V4h7v-.01l9 9-7 7.02z" fill="currentColor"/>
                </svg>
                <span>Code Promo</span>
            </a>
        </li>
        <li>
            <a href="#" class="menu-item {{ request()->routeIs('content.*') ? 'active' : '' }}">
                <svg class="menu-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-2-6h-4v4h-2v-4H7v-2h4V7h2v4h4v2z" fill="currentColor"/>
                </svg>
                <span>Gestion contenu</span>
            </a>
        </li>
    </ul>
</nav>
