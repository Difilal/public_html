<div class="o-page__sidebar js-page-sidebar is-minimized">

            <!-- We just added `c-sidebar--light` class -->
            <div class="c-sidebar is-minimized">
                <a class="c-sidebar__brand u-bg-primary" href="./">
                    <img class="c-sidebar__brand-img" src="img/tools.png" alt="Logo">
                    <span class="c-sidebar__brand-text" style="margin-left: 2px;">App Config</span>
                </a>
                
                <!--<h4 class="c-sidebar__title">Dashboards</h4>-->
                <ul class="c-sidebar__list">

                    <li class="c-sidebar__item">
                        <?php 
                        if(     $_GET["subpg"]=="dashboard-admin-data-whatsapp-sender") $isActive=" is-active"; 
                        elseif( $_GET["subpg"]=="dashboard-admin-tambah-nohp-whatsapp") $isActive=" is-active"; 
                        elseif( $_GET["subpg"]=="dashboard-admin-edit-nohp-whatsapp")   $isActive=" is-active"; 
                        else                                                            $isActive="";
                        ?>
                        <a class="c-sidebar__link<?php echo $isActive; ?>" href="dashboard-admin-data-whatsapp-sender.html">
                            <span class="c-sidebar__icon">
                            <i class="fab fa-whatsapp u-mr-xsmall"></i></span>
                            Whatsapp Sender
                        </a>
                    </li>

                    <li class="c-sidebar__item">
                        <?php 
                        if(     $_GET["subpg"]=="dashboard-admin-data-email-sender")    $isActive=" is-active"; 
                        else                                                            $isActive="";
                        ?>
                        <a class="c-sidebar__link<?php echo $isActive; ?>" href="dashboard-admin-data-email-sender.html">
                            <span class="c-sidebar__icon">
                            <i class="far fa-envelope u-mr-xsmall"></i></span>
                            Email Sender
                        </a>
                    </li>

                    <li class="c-sidebar__item">
                        <?php 
                        if(     $_GET["subpg"]=="dashboard-admin-mesin-absen-data")    $isActive=" is-active"; 
                        else                                                            $isActive="";
                        ?>
                        <a class="c-sidebar__link<?php echo $isActive; ?>" href="dashboard-admin-mesin-absen-data.html">
                            <span class="c-sidebar__icon">
                            <i class="fas fa-fingerprint"></i></span>
                            Mesin Absen
                        </a>
                    </li>

                    <li class="c-sidebar__item">
                        <?php 
                        if(     $_GET["subpg"]=="dashboard-admin-data-operator")    $isActive=" is-active"; 
                        elseif( $_GET["subpg"]=="dashboard-admin-tambah-operator")  $isActive=" is-active"; 
                        elseif( $_GET["subpg"]=="dashboard-admin-edit-operator")    $isActive=" is-active"; 
                        else                                                        $isActive="";
                        ?>
                        <a class="c-sidebar__link<?php echo $isActive; ?>" href="dashboard-admin-data-operator.html">
                            <span class="c-sidebar__icon">
                            <i class="fas fa-users-cog u-mr-xsmall"></i></span>
                            Data Operator
                        </a>
                    </li>

                    <li class="c-sidebar__item">
                        <?php 
                        if(     $_GET["subpg"]=="dashboard-admin-access-rights")     $isActive=" is-active"; 
                        else                                                        $isActive="";
                        ?>
                        <a class="c-sidebar__link<?php echo $isActive; ?>" href="dashboard-admin-access-rights.html">
                            <span class="c-sidebar__icon">
                            <i class="fas fa-user-lock u-mr-xsmall"></i></span>
                            Hak Akses
                        </a>
                    </li>

                    <li class="c-sidebar__item">
                        <a class="c-sidebar__link<?php if($_GET["subpg"]=="dashboard-user-history") echo " is-active"; ?>" href="dashboard-user-history.html">
                            <span class="c-sidebar__icon"><i class="fa fa-history u-mr-xsmall"></i></span>User History
                        </a>
                    </li>
                    
                </ul>

            </div><!-- // .c-sidebar -->
        </div>