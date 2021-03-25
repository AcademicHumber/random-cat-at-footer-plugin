<?php

// Key of your custom taxonomy goes here.
// Taxonomy key, must not exceed 32 characters.
$prefix_taxonomy = 'category';

/**
 * This will add the custom meta field to the add new term page.
 *
 * @return void
 */
function rc_prefix_add_meta_fields()
{

    $categories_data = rc_get_categories_data();
?>

    <div class="form-field term-meta-wrap">
        <label for="term_meta[related_category]">
            <?php esc_html_e('Categoría con la que se relaciona', 'related-cat'); ?>
        </label>
        <select name="term_meta[related_category]" id="term_meta[related_category]">
            <?php
            foreach ($categories_data as $category) {
            ?>
                <option value="<?php echo $category["slug"] ?>"><?php echo $category["name"] ?></option>
            <?php
            }
            ?>
        </select>

    </div>

<?php
}
add_action(sprintf('%s_add_form_fields', $prefix_taxonomy), 'rc_prefix_add_meta_fields');
