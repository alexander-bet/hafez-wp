<?php
if (post_password_required()) {
    return;
} ?>

<!-- Comments -->
<div class="comments story" id="comments">

    <?php if (have_comments()) : ?>
        <div class="comments_container cf">
            <h3 class="comments_title"><?php esc_html_e('Comments', 'hafezkids');
                                        if (get_comments_number()) {
                                            echo ' (' . esc_html(get_comments_number()) . ')';
                                        }
                                        ?></h3>
            <a name="comments"></a>
            <?php wp_list_comments(array('callback' => 'hafezkids_comment_default', 'style' => 'div', 'max_depth' => 2, 'avatar_size' => 100,)); ?>
            <?php the_comments_navigation(); ?>
        </div>
    <?php else :
        echo '<div class="comments_separator"></div>';
    endif; ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'hafezkids'); ?></p>
    <?php endif; ?>

    <?php $args = array(
        'comment_field' => '<div class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_html__('Your Comment', 'hafezkids') . ' *"></textarea></div>',
        'fields' => apply_filters(
            'comment_form_default_fields',
            array(

                'author' =>
                '<div class="comment-form-author"><input id="author" required name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
                    '" size="30" placeholder="' . esc_html__('Your name', 'hafezkids') . ' *" /></div>',

                'email' =>
                '<div class="comment-form-email"><input id="email" required name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
                    '" size="30" placeholder="' . esc_html__('Your email', 'hafezkids') . ' *" /></div>',

                'url' =>
                '<div class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
                    '" size="30" placeholder="' . esc_html__('Website', 'hafezkids') . '" /></div>'
            )
        ),
        'submit_button' => '<div class="hafezkids_button">
            <div class="container">
                <svg class="hafezkids_dashed"><rect x="5px" y="5px" rx="26px" ry="26px" width="167.234" height="53"></rect></svg>
                <span><input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" /></span>
            </div>
        </div>',
        'submit_field' => '<div class="form-submit">%1$s %2$s</div>'
    );
    comment_form($args); ?>
</div>