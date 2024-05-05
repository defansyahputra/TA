<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-primary">
    <div class="app-brand demo ">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo" style="width: 60px;">
                <img src="<?= base_url('assets/public/') ?>klinik.png" alt="klinik gigi">
            </span>
            <span class="demo menu-text fs-4 fw-bold ms-2">Klinik Gigi</span>
        </a>

        <!-- <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a> -->
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1 pt-4">
        <?php
        function showMenu($data, $link_active, $openMenu)
        {
            foreach ($data as $menuUtama) {
                if ($menuUtama->child) {
        ?>
                    <div data-kt-menu-trigger="click" class="menu-item <?php echo (in_array($menuUtama->id_menu, $openMenu)) ? 'here show' : NULL; ?> menu-accordion mb-1">
                        <span class="menu-link menu-toggle">
                            <span class="menu-icon pb-1">
                                <i class="<?php echo (empty($menuUtama->icon)) ? 'bx bx-circle' : $menuUtama->icon; ?>"></i>
                            </span>
                            <span class="menu-title"><?php echo $menuUtama->nama_menu ?></span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub">
                            <?php
                            showMenu($menuUtama->content_child, $link_active, $openMenu);
                            ?>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="menu-item">
                        <a class="menu-link <?php echo ($link_active == $menuUtama->href) ? 'active py-3' : NULL; ?>" href="<?php echo site_url($menuUtama->href) ?>">
                            <span class="menu-icon pb-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <i class="<?php echo (empty($menuUtama->icon)) ? '' : $menuUtama->icon; ?>"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title"><?php echo $menuUtama->nama_menu ?></span>
                        </a>
                    </div>
        <?php
                }
            }
        }

        showMenu($ShowMenu, $link_active, $openMenu);
        ?>
    </ul>
</aside>
<!-- / Menu -->
</div>