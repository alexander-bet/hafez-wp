<?php

//Background Object based on Theme Options Values
$hafez_background = hafez_get_option('background');

$hafez_font_one = hafez_get_option('font_one');
$hafez_font_two = hafez_get_option('font_two');

$hafez_font_one_ex = hafez_get_option('font_one_ex');
$hafez_font_two_ex = hafez_get_option('font_two_ex');

$hafez_font = hafez_get_option('bodystyle');
$hafez_h1 = hafez_get_option('h1sty');
$hafez_h2 = hafez_get_option('h2sty');
$hafez_h3 = hafez_get_option('h3sty');
$hafez_h4 = hafez_get_option('h4sty');
$hafez_h5 = hafez_get_option('h5sty');
$hafez_h6 = hafez_get_option('h6sty');

?>

<style>
    body {
        <?php
        if ($hafez_font['size']) {
            echo "font-size:" . esc_attr($hafez_font['size']) . ";";
        }
        if ($hafez_font['style']) {
            echo "font-style:" . esc_attr($hafez_font['style']) . ";";
        }
        if ($hafez_font['color']) {
            echo "color:" . esc_attr($hafez_font['color']) . ";";
        }
        if ($hafez_font['face']) {
            $fontfamily =  str_replace('+', ' ', esc_attr($hafez_font['face']));
            echo "font-family:" . esc_attr($fontfamily) . ";";
        }
        if ($hafez_font['transform']) {
            echo "text-transform:" . esc_attr($hafez_font['transform']) . ";";
        }
        if ($hafez_font['weight']) {
            echo "font-weight:" . esc_attr($hafez_font['weight']) . ";";
        }
        if ($hafez_font['lineheight']) {
            echo "line-height:" . esc_attr($hafez_font['lineheight']) . ";";
        }

        //Dynamic Background Settings from Theme Options.
        if ($hafez_background['color']) {
            echo "background-color:" . esc_attr($hafez_background['color']) . ";";
        }
        if ($hafez_background['image']) {
            echo "background-image: url(" . esc_url($hafez_background['image']) . ");";
        }
        if ($hafez_background['repeat']) {
            echo "background-repeat:" . esc_attr($hafez_background['repeat']) . ";";
        }
        if ($hafez_background['position']) {
            echo "background-position:" . esc_attr($hafez_background['position']) . ";";
        }
        if ($hafez_background['attachment']) {
            echo "background-attachment:" . esc_attr($hafez_background['attachment']) . ";";
        }
        if ($hafez_background['background-size']) {
            echo "background-size:" . esc_attr($hafez_background['background-size']) . ";";
        }
        ?>
    }

    h1 {
        <?php
        if ($hafez_h1['size']) {
            echo "font-size:" . esc_attr($hafez_h1['size']) . ";";
        };
        if ($hafez_h1['style']) {
            echo "font-style:" . esc_attr($hafez_h1['style']) . ";";
        };
        if ($hafez_h1['color']) {
            echo "color:" . esc_attr($hafez_h1['color']) . ";";
        };
        if ($hafez_h1['face']) {
            $h1family =  str_replace('+', ' ', esc_attr($hafez_h1['face']));
            echo "font-family:" . esc_attr($h1family) . ";";
        };
        if ($hafez_h1['transform']) {
            echo "text-transform:" . esc_attr($hafez_h1['transform']) . ";";
        }
        if ($hafez_h1['weight']) {
            echo "font-weight:" . esc_attr($hafez_h1['weight']) . ";";
        }
        if ($hafez_h1['lineheight']) {
            echo "line-height:" . esc_attr($hafez_h1['lineheight']) . ";";
        }
        ?>
    }

    h2 {
        <?php
        if ($hafez_h2['size']) {
            echo "font-size:" . esc_attr($hafez_h2['size']) . ";";
        };
        if ($hafez_h2['style']) {
            echo "font-style:" . esc_attr($hafez_h2['style']) . ";";
        };
        if ($hafez_h2['color']) {
            echo "color:" . esc_attr($hafez_h2['color']) . ";";
        };
        if ($hafez_h2['face']) {
            $h2family =  str_replace('+', ' ', esc_attr($hafez_h2['face']));
            echo "font-family:" . esc_attr($h2family) . ";";
        };
        if ($hafez_h2['transform']) {
            echo "text-transform:" . esc_attr($hafez_h2['transform']) . ";";
        }
        if ($hafez_h2['weight']) {
            echo "font-weight:" . esc_attr($hafez_h2['weight']) . ";";
        }
        if ($hafez_h2['lineheight']) {
            echo "line-height:" . esc_attr($hafez_h2['lineheight']) . ";";
        }
        ?>
    }

    h3 {
        <?php
        if ($hafez_h3['size']) {
            echo "font-size:" . esc_attr($hafez_h3['size']) . ";";
        };
        if ($hafez_h3['style']) {
            echo "font-style:" . esc_attr($hafez_h3['style']) . ";";
        };
        if ($hafez_h3['color']) {
            echo "color:" . esc_attr($hafez_h3['color']) . ";";
        };
        if ($hafez_h3['face']) {
            $h3family =  str_replace('+', ' ', esc_attr($hafez_h3['face']));
            echo "font-family:" . esc_attr($h3family) . ";";
        };
        if ($hafez_h3['transform']) {
            echo "text-transform:" . esc_attr($hafez_h3['transform']) . ";";
        }
        if ($hafez_h3['weight']) {
            echo "font-weight:" . esc_attr($hafez_h3['weight']) . ";";
        }
        if ($hafez_h3['lineheight']) {
            echo "line-height:" . esc_attr($hafez_h3['lineheight']) . ";";
        }
        ?>
    }

    h4 {
        <?php
        if ($hafez_h4['size']) {
            echo "font-size:" . esc_attr($hafez_h4['size']) . ";";
        };
        if ($hafez_h4['style']) {
            echo "font-style:" . esc_attr($hafez_h4['style']) . ";";
        };
        if ($hafez_h4['color']) {
            echo "color:" . esc_attr($hafez_h4['color']) . ";";
        };
        if ($hafez_h4['face']) {
            $h4family =  str_replace('+', ' ', esc_attr($hafez_h4['face']));
            echo "font-family:" . esc_attr($h4family) . ";";
        };
        if ($hafez_h4['transform']) {
            echo "text-transform:" . esc_attr($hafez_h4['transform']) . ";";
        }
        if ($hafez_h4['weight']) {
            echo "font-weight:" . esc_attr($hafez_h4['weight']) . ";";
        }
        if ($hafez_h4['lineheight']) {
            echo "line-height:" . esc_attr($hafez_h4['lineheight']) . ";";
        }
        ?>
    }

    h5 {
        <?php
        if ($hafez_h5['size']) {
            echo "font-size:" . esc_attr($hafez_h5['size']) . ";";
        };
        if ($hafez_h5['style']) {
            echo "font-style:" . esc_attr($hafez_h5['style']) . ";";
        };
        if ($hafez_h5['color']) {
            echo "color:" . esc_attr($hafez_h5['color']) . ";";
        };
        if ($hafez_h5['face']) {
            $h5family =  str_replace('+', ' ', esc_attr($hafez_h5['face']));
            echo "font-family:" . esc_attr($h5family) . ";";
        };
        if ($hafez_h5['transform']) {
            echo "text-transform:" . esc_attr($hafez_h5['transform']) . ";";
        }
        if ($hafez_h5['weight']) {
            echo "font-weight:" . esc_attr($hafez_h5['weight']) . ";";
        }
        if ($hafez_h5['lineheight']) {
            echo "line-height:" . esc_attr($hafez_h5['lineheight']) . ";";
        }
        ?>
    }

    h6 {
        <?php
        if ($hafez_h6['size']) {
            echo "font-size:" . esc_attr($hafez_h6['size']) . ";";
        };
        if ($hafez_h6['style']) {
            echo "font-style:" . esc_attr($hafez_h6['style']) . ";";
        };
        if ($hafez_h6['color']) {
            echo "color:" . esc_attr($hafez_h6['color']) . ";";
        };
        if ($hafez_h6['face']) {
            $h6family =  str_replace('+', ' ', esc_attr($hafez_h6['face']));
            echo "font-family:" . esc_attr($h6family) . ";";
        };
        if ($hafez_h6['transform']) {
            echo "text-transform:" . esc_attr($hafez_h6['transform']) . ";";
        }
        if ($hafez_h6['weight']) {
            echo "font-weight:" . esc_attr($hafez_h6['weight']) . ";";
        }
        if ($hafez_h6['lineheight']) {
            echo "line-height:" . esc_attr($hafez_h6['lineheight']) . ";";
        }
        ?>
    }


    <?php if ($hafez_font_one) {
        echo '.font_one {';
        $hafez_font_one =  str_replace('+', ' ', esc_attr($hafez_font_one));
        echo "font-family:" . esc_attr($hafez_font_one) . ";";
        echo '}';
    };

    if ($hafez_font_two) {
        echo '.font_two {';
        $hafez_font_two =  str_replace('+', ' ', esc_attr($hafez_font_two));
        echo "font-family:" . esc_attr($hafez_font_two) . ";";
        echo '}';
    };

    if (hafez_get_option('customcsscode')) {
        echo esc_attr(hafez_get_option('customcsscode'));
    } ?>
</style>