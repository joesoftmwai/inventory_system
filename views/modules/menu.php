<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
         
            <?php if(($_SESSION["profile"] == 'Administrator')): ?>

                <li class="active">
                    <a href="home">
                        <i class="fa fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>

                <li>
                    <a href="users">
                        <i class="fa fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>

            <?php endif;?>

            <?php if(($_SESSION["profile"] == 'Administrator') || ($_SESSION["profile"] == 'Special')): ?>

                <li>
                    <a href="categories">
                        <i class="fa fa-th"></i>
                        <span>Categories</span>
                    </a>
                </li>

                <li>
                    <a href="products">
                        <i class="fa fa-product-hunt"></i>
                        <span>Products</span>
                    </a>
                </li>

            <?php endif;?>

            <?php if(($_SESSION["profile"] == 'Administrator') || ($_SESSION["profile"] == 'Seller')): ?>
    

                <li>
                    <a href="clients">
                        <i class="fa fa-users"></i>
                        <span>Clients</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-list-ul"></i>
                        <span>Sales</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li>
                            <a href="sales">
                                <i class="fa fa-circle-o"></i>
                                <span>Manage sales</span>
                            </a>
                        </li>

                        <li>
                            <a href="create-sales">
                                <i class="fa fa-circle-o"></i>
                                <span>Create sales</span>
                            </a>
                        </li>

                    <?php endif;?>

                    <?php if(($_SESSION["profile"] == 'Administrator')): ?>

                        <li>
                            <a href="reports">
                                <i class="fa fa-circle-o"></i>
                                <span>Sales report</span>
                            </a>
                        </li>

                    <?php endif;?>

                </ul>

            </li>


        </ul>

    </section>

</aside>
