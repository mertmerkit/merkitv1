<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
    <div class="sidebar-brand-text mx-3">merkitv1</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?php isActivePage('index'); ?>">
    <a class="nav-link" href="/admin">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<li class="nav-item <?php isActivePage('mangas'); ?>">
    <a class="nav-link" href="/admin/mangas">
        <i class="fas fa-fw fa-book"></i>
        <span>Mangalar</span></a>
</li>

<li class="nav-item <?php isActivePage('genres'); ?>">
    <a class="nav-link" href="/admin/genres">
        <i class="fas fa-fw fa-list"></i>
        <span>Kategoriler</span></a>
</li>

<li class="nav-item <?php isActivePage('users'); ?>">
    <a class="nav-link" href="/admin/users">
        <i class="fas fa-fw fa-user"></i>
        <span>Kullanıcılar</span></a>
</li>



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">



<li class="nav-item <?php isActivePage('logout'); ?>">
    <a class="nav-link" href="/admin/logout">
        <i class="fas fa-fw fa-sign-out"></i>
        <span>Logout</span></a>
</li>








</ul>