<?php

// Key of your custom taxonomy goes here.
// Taxonomy key, must not exceed 32 characters.
$prefix_taxonomy = 'category';

/**
 * This will add the custom meta field to the add new term page.
 * 
 * the function recieves data depending the action
 * if its add_form_field, it recieves only the taxonomy
 * if its edit_form_field, it recieves the term and the taxonomy
 *
 * @return void
 */
function rc_prefix_add_meta_fields($data)
{
    //check if the data is a taxonomy or term
    $term = "";
    if ($data != 'category') {
        $term_id = $data->term_id;
        $term = $data->slug;
    }

    $categories_data = rc_get_categories_data();

    if (current_filter() == 'category_edit_form_fields') {
?>
        <tr class="form-field term-meta-wrap">
            <th valign="top" scope="row">
                <label for="related_category">
                    <?php
                    esc_html_e('Categoría con la que se relaciona', 'related-cat');
                    ?>
                </label>
            </th>
            <td>
                <select name="related_category" id="related_category">
                    <?php
                    foreach ($categories_data as $category) {
                        if ($category['slug'] != $term) {
                    ?>
                            <option value="<?php echo $category["slug"] ?>" <?php echo selected(get_term_meta($term_id, 'related_category', true), $category['slug']) ?>>
                                <?php echo $category["name"] ?>
                            </option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
    <?php
    } elseif (current_filter() == 'category_add_form_fields') {
    ?>
        <div class="form-field term-meta-wrap">
            <label for="related_category">
                <?php esc_html_e('Categoría con la que se relacionaaa', 'related-cat'); ?>
            </label>
            <select name="related_category" id="related_category">
                <?php
                foreach ($categories_data as $category) {
                ?>
                    <option value="<?php echo $category["slug"] ?>">
                        <?php echo $category["name"] ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>
<?php
    }
}
add_action(sprintf('%s_add_form_fields', $prefix_taxonomy), 'rc_prefix_add_meta_fields');
add_action(sprintf('%s_edit_form_fields', $prefix_taxonomy), 'rc_prefix_add_meta_fields');


function wcr_save_category_fields($term_id)
{
    if (!isset($_POST['related_category'])) {
        return;
    }

    update_term_meta($term_id, 'related_category', sanitize_text_field($_POST['related_category']));
}

// Save the fields values, using our callback function
add_action(sprintf('edited_%s', $prefix_taxonomy), 'wcr_save_category_fields', 10, 2);
add_action(sprintf('created_%s', $prefix_taxonomy), 'wcr_save_category_fields', 10, 2);
