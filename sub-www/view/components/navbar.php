<nav class="navbar navbar-expand-md">
    <div class="container">
        <?php loadComponent('elements/brand') ?>
        
        <button class="btn side-navbar-nav-open-button" type="button"><i class="fas fa-bars"></i></button><!-- Button open sidebar -->
        <div class="side-navbar-bg-overlay d-none"></div><!-- Background overlay sidebar -->
        <div class="side-navbar-nav"><!-- Sidebar -->
            <button class="btn side-navbar-nav-close-button" type="button"><i class="fas fa-times"></i></button><!-- Button close sidebar -->
            <?php loadComponent('elements/menu') ?>
        </div>
    </div>
</nav>