<div class="colored_line">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>
<footer class="site_footer <?php if (empty(hafez_get_option('footer_info')) && empty(hafez_get_option('footer_info')) && empty(hafez_get_option('footer_navigation_title')) && empty(hafez_get_option('footer_contacts_title'))) {
                                echo 'no_content';
                            } ?>">

    <div class="hafezkids_footer_ic1"></div>
    <div class="hafezkids_footer_ic2"></div>
    <div class="hafezkids_footer_ic3"></div>
    <div class="hafezkids_footer_ic4"></div>
    <div class="hafezkids_footer_ic5"></div>
    <div class="hafezkids_footer_ic6"></div>
    <div class="hafezkids_footer_ic"></div>

    <div class="wrapper top_line">
        <?php if (!empty(hafez_get_option('footer_info'))) { ?>
            <div class="info_box">
                <div class="inner_footer_widget">
                    <a href="<?php echo esc_url(home_url("/")); ?>">
                        <?php if (hafez_get_option('footerlogo')) { ?>
                            <img src="<?php echo esc_url(hafez_get_option('footerlogo')); ?>" <?php if (!empty(hafez_get_option('footerlogoretina'))) { ?>srcset="<?php echo esc_url(hafez_get_option('footerlogoretina')); ?> 2x" <?php } ?> alt="<?php esc_attr_e('logo', 'hafezkids'); ?>" />
                        <?php } ?>
                    </a>

                    <?php if (hafez_get_option('footer_info')) { ?><div class="footer_info"><?php echo wp_kses_post(hafez_get_option('footer_info')); ?></div><?php } ?>
                </div>
            </div>
        <?php }

        if (!empty(hafez_get_option('footer_openning_title'))) { ?>
            <div class="openning_box">
                <div class="inner_footer_widget">
                    <?php if (hafez_get_option('footer_openning_title')) { ?><h4><?php echo esc_html(hafez_get_option('footer_openning_title')); ?></h4><?php } ?>
                    <?php if (hafez_get_option('footer_openning_info')) { ?><div class="footer_openning_info"><?php echo wp_kses_post(hafez_get_option('footer_openning_info')); ?></div><?php } ?>
                </div>
            </div>
        <?php }

        if (!empty(hafez_get_option('footer_navigation_title'))) { ?>
            <div class="navigation_box">
                <div class="inner_footer_widget">
                    <?php if (hafez_get_option('footer_navigation_title')) { ?><h4><?php echo esc_html(hafez_get_option('footer_navigation_title')); ?></h4><?php } ?>
                    <nav>
                        <?php
                        if (has_nav_menu('footer_menu')) {
                            wp_nav_menu(array(
                                'theme_location' => 'footer_menu',
                                'menu_class'    => 'menu footer-menu',
                                'container'        => '',
                            ));
                        } ?>
                    </nav>
                </div>
            </div>
        <?php }
        if (!empty(hafez_get_option('footer_contacts_title'))) { ?>
            <div class="contact_box">
                <div class="inner_footer_widget">
                    <?php if (hafez_get_option('footer_contacts_title')) { ?><h4><?php echo esc_html(hafez_get_option('footer_contacts_title')); ?></h4><?php } ?>

                    <?php if (hafez_get_option('footer_address')) { ?>
                        <div class="hafezkids_address">
                            <?php echo esc_html(hafez_get_option('footer_address')); ?>
                        </div>
                    <?php } ?>
                    <?php if (hafez_get_option('footer_phone1') or hafez_get_option('footer_phone1')) { ?>
                        <div class="hafezkids_phone">
                            <?php if (hafez_get_option('footer_phone1')) {
                                echo '<strong>' . esc_html(hafez_get_option('footer_phone1')) . '</strong>';
                            } ?>
                            <?php if (hafez_get_option('footer_phone2')) {
                                echo '<strong>' . esc_html(hafez_get_option('footer_phone2')) . '</strong>';
                            } ?>
                        </div>
                    <?php } ?>
                    <?php if (hafez_get_option('footer_email')) { ?>
                        <div class="hafezkids_email">
                            <a href="mailto:<?php echo esc_html(hafez_get_option('footer_email')); ?>"><?php echo esc_html(hafez_get_option('footer_email')); ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="scroll_top_line">
        <div class="scroll_top_container">
            <a href="#" class="hafezkids_button hafezkids_scroll_top">
                <div class="container">
                    <span><?php esc_html_e('Scroll to Top', 'hafezkids'); ?></span>
                    <svg class="hafezkids_dashed">
                        <rect x="5px" y="5px" rx="26px" ry="26px" width="0" height="0"></rect>
                    </svg>
                </div>
            </a>
        </div>
    </div>

    <div class="wrapper bottom_line">
        <?php if (hafez_get_option('copyrights')) { ?><div class="copyrights"><?php echo wp_kses_post(hafez_get_option('copyrights')); ?></div><?php } ?>

        <div class="social">
            <?php get_template_part('partials/social_profiles'); ?>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>

</body>

</html>