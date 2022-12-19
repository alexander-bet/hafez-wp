var hafez_wp_admin_demos = {};
var hafezDemoProgressBar = {};
var hafezDemoFullInstaller = {};

(function ($) {
    'use strict';

    hafez_wp_admin_demos = {

        init: function init() {

            jQuery().ready(function () {
                var installDemoButton = jQuery('.hafez-wp-admin-demo .hafez-button-install-demo');

                function enableInstallButton() {
                    jQuery('.hafez_info').each(function () {
                        if (jQuery(this).find('.install_but:visible').length == jQuery(this).find('.installed:visible').length) {
                            jQuery(this).find(installDemoButton).removeClass('disabled').attr('title', '');
                        }
                    });
                }



                //Disable the Install Demo Button and enable if plugins installed
                installDemoButton.addClass('disabled').attr('title', olins_strings.required_plugins);
                enableInstallButton();



                jQuery('.activate-plugin, .install-plugin').on('click', function (event) {
                    event.preventDefault();

                    if (jQuery(this).hasClass('disabled')) {
                        return;
                    }

                    function hafez_parse_url(url) {
                        var urlArray = url.split('?')[1].split('&'),
                            result = [],
                            elLenght = urlArray.length,
                            i;

                        for (i = 0; i < elLenght; ++i) {
                            var elementArray = urlArray[i].split('=');
                            result[elementArray[0]] = elementArray[1];
                        }

                        return result;
                    }

                    //Save the link
                    var $oldLink = jQuery(this).attr('href');

                    // Get a reference ot the link
                    var $link = jQuery(this),

                        // Parse URL to extract variables
                        url = hafez_parse_url($link.attr('href')),
                        // Get a reference to the HTML field which will display whether the plugin was activated or not
                        $actionResult = $link.parents('.olins_plugin_name').find('.install_but'),

                        action;


                    // Assign the appropriate AJAX action based on which link was clicked
                    if (url.action === 'install-plugin') {
                        action = 'olins_post_install_plugin';
                    } else if (url.action === 'activate') {
                        action = 'olins_post_activate_plugin';
                    }

                    // Disable the installation/activation links for the other plugins
                    jQuery('.required_plugins ul li a').addClass('disabled');

                    var activationLimit;

                    $actionResult.html('<i class="fa fa-spinner fa-spin fa-fw"></i>');

                    // Tell the server to activate the plugin
                    var ajaxRequest = jQuery.ajax({
                        url: olins_strings.hafez_ajax_url,
                        type: 'post',
                        data: {
                            action: action,
                            olins_plugin_nonce: url._wpnonce,
                            olins_plugin_slug: url.plugin
                        },
                        complete: function (data) {
                            clearTimeout(activationLimit);

                            // Result
                            if (data.responseText === 'successful installation' || data.responseText === 'successful activation') {

                                $actionResult.empty().html('<i class="fa fa-check success" aria-hidden="true"></i> ' + olins_strings.plugin_active).removeClass().addClass('install_but installed');
                                enableInstallButton();

                            } else if (data.status === 500) {

                                $actionResult.empty().text(olins_strings.plugin_failed_activation_memory).addClass('olins-plugin-action-failed');

                            } else if (typeof data.responseText !== 'undefined' && data.responseText.indexOf('target') !== -1) {

                                var againLink = '<i class="fa fa-times red" aria-hidden="true"></i> <a href="' + $oldLink + '" class="install-plugin">' + olins_strings.tryAgain + '</a>'
                                $actionResult.empty().html(againLink).addClass('olins-plugin-action-failed');

                            } else {
                                var faildActivation = '<i class="fa fa-times red" aria-hidden="true"></i> <a href="' + $oldLink + '" class="install-plugin">' + olins_strings.plugin_failed_activation + ' ' + olins_strings.tryAgain + '</a>'
                                $actionResult.empty().html(faildActivation).addClass('olins-plugin-action-failed');

                            }

                            // Re-enable links
                            jQuery('.required_plugins ul li .disabled').removeClass('disabled');
                        }
                    });

                    // Set a time limit of 60 seconds for the activation process.
                    if (url.action === 'activate' || url.action === 'install-plugin') {
                        activationLimit = setTimeout(function () {
                            ajaxRequest.abort();

                            var faildActivation = '<i class="fa fa-times red" aria-hidden="true"></i> <a href="' + $oldLink + '" class="install-plugin">' + olins_strings.plugin_failed_activation + ' ' + olins_strings.tryAgain + '</a>'
                            $actionResult.empty().html(olins_strings.plugin_failed_activation_retry).addClass('olins-plugin-action-failed');

                            jQuery('.required_plugins ul li .disabled').removeClass('disabled');
                        }, 60000);
                    }
                });

                // install
                jQuery('.hafez-wp-admin-demo .hafez-button-install-demo').click(function (event) {
                    event.preventDefault();
                    if (!jQuery(this).hasClass('disabled')) {
                        var demo_id = jQuery(this).data('demo-id');
                        var hafez_confirm = '';

                        hafez_confirm = confirm('Click OK to install the selected demo example');

                        if (hafez_confirm === true) {
                            hafez_wp_admin_demos._install_full(demo_id);
                        }
                    } else {
                        hafezrt(olins_strings.required_plugins);
                    }
                });

                // uninstall
                jQuery('.hafez-wp-admin-demo .hafez-button-uninstall-demo').click(function (event) {
                    event.preventDefault();

                    var hafez_confirm = confirm('Click OK to Uninstall the selected demo example.');
                    if (hafez_confirm === true) {
                        var demo_id = jQuery(this).data('demo-id');
                        hafez_wp_admin_demos._uninstall(demo_id);
                    }
                });
            });
        },


        _uninstall: function (demo_id) {
            hafez_wp_admin_demos._block_navigation();

            jQuery('.hafez-wp-admin-demo:not(.hafez-demo-' + demo_id + ')')
                .addClass('hafez-demo-disabled')
                ;

            jQuery('.hafez-demo-' + demo_id)
                .addClass('hafez-demo-uninstalling')
                .removeClass('hafez-demo-installed')
                ;

            hafezDemoProgressBar.progress_bar_wrapper_element = jQuery('.hafez-demo-' + demo_id + ' .hafez-progress-bar-wrap');
            hafezDemoProgressBar.progress_bar_element = jQuery('.hafez-demo-' + demo_id + ' .hafez-progress-bar');
            hafezDemoProgressBar.show();
            hafezDemoProgressBar.change(40);

            hafezDemoProgressBar.timer_change(90);

            var request_data = {
                action: 'hafez_ajax_demo_install',
                hafez_demo_action: 'uninstall_demo',
                hafez_demo_id: demo_id,
                hafez_magic_token: olins_strings.hafezWpAdminImportNonce
            };
            jQuery.ajax({
                type: 'POST',
                url: hafez_wp_admin_demos._getAdminAjax('uninstall_demo'),
                cache: false,
                data: request_data,
                dataType: 'json',
                success: function (data, textStatus, XMLHttpRequest) {

                    hafezDemoProgressBar.change(100);


                    setTimeout(function () {
                        hafezDemoProgressBar.hide();
                        hafezDemoProgressBar.reset();

                        jQuery('.hafez-demo-' + demo_id)
                            .removeClass('hafez-demo-uninstalling');

                        jQuery('.hafez-demo-disabled').removeClass('hafez-demo-disabled');

                        hafez_wp_admin_demos._unblock_navigation();

                    }, 500);
                },
                error: function (MLHttpRequest, textStatus, errorThrown) {
                    hafez_wp_admin_demos._show_network_error('uninstall', MLHttpRequest, textStatus, errorThrown);
                }
            });


        },

        _install_full: function (demoId) {
            hafez_wp_admin_demos._block_navigation();
            hafez_wp_admin_demos._ui_install_start(demoId);
            hafezDemoProgressBar.timer_change(10);

            hafezDemoFullInstaller.installNextStep(demoId, 0, function () {
                // on finish!
                hafez_wp_admin_demos._unblock_navigation();
                hafez_wp_admin_demos._ui_install_end(demoId);
            });
        },

        _show_network_error: function (hafez_ajax_request_name, MLHttpRequest, textStatus, errorThrown) {

            var responseText = MLHttpRequest.responseText.replace(/<br>/g, '\n');

            hafezrt(
                'Ajax error.\n' +
                'textStatus: ' + textStatus + '\n' +
                'hafez_ajax_request_name: ' + hafez_ajax_request_name + '\n' +
                'errorThrown: ' + errorThrown + '\n' + '\n' +
                'responseText: ' + responseText
            );
        },


        _ui_install_start: function (demo_id) {
            jQuery('.hafez-wp-admin-demo:not(.hafez-demo-' + demo_id + ')')
                .addClass('hafez-demo-disabled')
                .removeClass('hafez-demo-installed')
                ;

            jQuery('.hafez-demo-' + demo_id).addClass('hafez-demo-installing');

            hafezDemoProgressBar.progress_bar_wrapper_element = jQuery('.hafez-demo-' + demo_id + ' .hafez-progress-bar-wrap');
            hafezDemoProgressBar.progress_bar_element = jQuery('.hafez-demo-' + demo_id + ' .hafez-progress-bar');
            hafezDemoProgressBar.show();
            hafezDemoProgressBar.change(2);
        },

        _ui_install_end: function (demo_id) {
            hafezDemoProgressBar.change(100);
            setTimeout(function () {
                hafezDemoProgressBar.hide();
                hafezDemoProgressBar.reset();

                jQuery('.hafez-demo-' + demo_id)
                    .removeClass('hafez-demo-installing')
                    .addClass('hafez-demo-installed');


                jQuery('.hafez-demo-disabled').removeClass('hafez-demo-disabled');

            }, 500);

        },

        _block_navigation: function () {
            window.onbeforeunload = function () {
                return "The demo is installing now. If you want to close the page, you will need to uninstall the broken demo.";
            };
        },

        _unblock_navigation: function () {
            window.onbeforeunload = '';
        },

        _getAdminAjax: function (stepName) {
            if (typeof stepName === 'undefined') {
                stepName = 'not_set';
            }

            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(16)
                    .substring(1);
            }
            return olins_strings.hafez_ajax_url + '&step=' + stepName + '&uid=' + s4() + s4() + s4() + s4();
        }
    };

    hafezDemoProgressBar = {
        progress_bar_wrapper_element: '',
        progress_bar_element: '',
        current_value: 0,
        goto_value: 0,
        timer: '',
        last_goto_value: 0,

        show: function show() {
            hafezDemoProgressBar.progress_bar_wrapper_element.addClass('hafez-progress-bar-visible');
        },

        hide: function hide() {
            hafezDemoProgressBar.progress_bar_wrapper_element.removeClass('hafez-progress-bar-visible');
        },

        reset: function reset() {
            clearInterval(hafezDemoProgressBar.timer);
            hafezDemoProgressBar.current_value = 0;
            hafezDemoProgressBar.goto_value = 0;
            hafezDemoProgressBar.timer = '';
            hafezDemoProgressBar.last_goto_value = 0;
            hafezDemoProgressBar.change(0);
        },


        change: function change(new_progress) {
            hafezDemoProgressBar.progress_bar_element.css('width', new_progress + '%');
            hafezDemoProgressBar.last_goto_value = new_progress;
            if (new_progress === 100) {
                clearInterval(hafezDemoProgressBar.timer);
            }
        },


        timer_change: function timer_change(new_progress) {
            clearInterval(hafezDemoProgressBar.timer);

            hafezDemoProgressBar._ui_change(hafezDemoProgressBar.last_goto_value);
            hafezDemoProgressBar.current_value = hafezDemoProgressBar.last_goto_value;


            clearInterval(hafezDemoProgressBar.timer);
            hafezDemoProgressBar.timer = setInterval(function () {
                if (Math.floor((Math.random() * 5) + 1) === 1) {
                    var tmp_value = Math.floor((Math.random() * 5) + 1) + hafezDemoProgressBar.current_value;
                    if (tmp_value <= new_progress) {
                        hafezDemoProgressBar._ui_change(hafezDemoProgressBar.current_value);
                        hafezDemoProgressBar.current_value = tmp_value;
                    } else {
                        hafezDemoProgressBar._ui_change(new_progress);
                        clearInterval(hafezDemoProgressBar.timer);
                    }
                }

            }, 1000);
            hafezDemoProgressBar.last_goto_value = new_progress;
        },

        _ui_change: function change(new_progress) {
            hafezDemoProgressBar.progress_bar_element.css('width', new_progress + '%');
        }
    };

    hafezDemoFullInstaller = {

        installNextStep: function (demoId, step, onFinishCallback) {
            if (typeof step === 'undefined') {
                step = 0;
            }

            var steps = hafezDemoFullInstaller._getSteps(demoId);

            var currentStep = steps[step];
            hafezDemoProgressBar.timer_change(currentStep.progress);

            currentStep.data.hafez_magic_token = olins_strings.hafezWpAdminImportNonce;


            jQuery.ajax({
                type: 'POST',
                url: hafezDemoFullInstaller._getAdminAjax(currentStep.data.hafez_demo_action),
                cache: false,
                data: currentStep.data,
                dataType: 'json',
                success: function (data, textStatus, XMLHttpRequest) {
                    if (typeof steps[step + 1] !== 'undefined') {
                        hafezDemoFullInstaller.installNextStep(demoId, step + 1, onFinishCallback);
                    } else {
                        onFinishCallback();
                    }
                },
                error: function (MLHttpRequest, textStatus, errorThrown) {

                    var responseText = MLHttpRequest.responseText.replace(/<br>/g, '\n');

                    console.log('textStatus: ' + textStatus);
                    console.log('errorThrown: ' + errorThrown);
                    console.log('responseText: ' + responseText);

                    hafezrt('An Error. Click ok to continue.\n');

                    if (typeof steps[step + 1] !== 'undefined') {
                        hafezDemoFullInstaller.installNextStep(demoId, step + 1, onFinishCallback);
                    } else {
                        onFinishCallback();
                    }
                }
            });
        },


        _getAdminAjax: function (stepName) {
            if (typeof stepName === 'undefined') {
                stepName = 'not_set';
            }

            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(16)
                    .substring(1);
            }
            return olins_strings.hafez_ajax_url + '&step=' + stepName + '&uid=' + s4() + s4() + s4() + s4();
        },


        _getSteps: function (demoId) {
            return {
                0: {
                    progress: 10,
                    data: {
                        action: 'hafez_ajax_demo_install',
                        hafez_demo_action: 'remove_content_before_install',
                        hafez_demo_id: ''
                    }
                },
                1: {
                    progress: 22,
                    data: {
                        action: 'hafez_ajax_demo_install',
                        hafez_demo_action: 'hafez_options_media',
                        hafez_demo_id: demoId
                    }

                },
                2: {
                    progress: 28,
                    data: {
                        action: 'hafez_ajax_demo_install',
                        hafez_demo_action: 'hafez_works_media',
                        hafez_demo_id: demoId
                    }
                },
                3: {
                    progress: 36,
                    data: {
                        action: 'hafez_ajax_demo_install',
                        hafez_demo_action: 'hafez_posts_media',
                        hafez_demo_id: demoId
                    }
                },
                4: {
                    progress: 48,
                    data: {
                        action: 'hafez_ajax_demo_install',
                        hafez_demo_action: 'hafez_pages_media',
                        hafez_demo_id: demoId
                    }
                },
                5: {
                    progress: 68,
                    data: {
                        action: 'hafez_ajax_demo_install',
                        hafez_demo_action: 'hafez_library_media',
                        hafez_demo_id: demoId
                    }
                },
                6: {
                    progress: 85,
                    data: {
                        action: 'hafez_ajax_demo_install',
                        hafez_demo_action: 'hafez_import',
                        hafez_demo_id: demoId
                    }
                }
            };
        }
    };

})();

hafez_wp_admin_demos.init();





