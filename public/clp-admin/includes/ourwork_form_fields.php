<?php
// Structured form fields for Our Work section content editing.
// Decodes JSON content and renders proper HTML inputs per section type.

if (!defined('CLP_ADMIN_URL')) {
    require_once __DIR__ . '/functions.php';
}

function ourwork_form_value($content, $key, $default = '') {
    if (!is_array($content)) return $default;
    return $content[$key] ?? $default;
}

function ourwork_form_text($content, $key, $label, $default = '') {
    $val = htmlspecialchars(ourwork_form_value($content, $key, $default), ENT_QUOTES);
    echo '<div class="form-group"><label>' . $label . '</label><input type="text" class="form-control content-field" data-key="' . htmlspecialchars($key, ENT_QUOTES) . '" value="' . $val . '"></div>' . "\n";
}

function ourwork_form_textarea($content, $key, $label, $rows = 4) {
    $val = htmlspecialchars(ourwork_form_value($content, $key), ENT_QUOTES);
    echo '<div class="form-group"><label>' . $label . '</label><textarea class="form-control content-field" data-key="' . htmlspecialchars($key, ENT_QUOTES) . '" rows="' . (int)$rows . '">' . $val . '</textarea></div>' . "\n";
}

function ourwork_form_select($content, $key, $label, $options, $default = '') {
    $val = ourwork_form_value($content, $key, $default);
    echo '<div class="form-group"><label>' . $label . '</label><select class="form-control content-field" data-key="' . htmlspecialchars($key, ENT_QUOTES) . '">' . "\n";
    foreach ($options as $optVal => $optLabel) {
        $selected = $val === $optVal ? ' selected' : '';
        echo '<option value="' . htmlspecialchars($optVal, ENT_QUOTES) . '"' . $selected . '>' . htmlspecialchars($optLabel, ENT_QUOTES) . '</option>' . "\n";
    }
    echo '</select></div>' . "\n";
}

function ourwork_form_checkbox($content, $key, $label, $default = 0) {
    $val = ourwork_form_value($content, $key, $default);
    $checked = $val ? ' checked' : '';
    echo '<div class="form-check"><input type="checkbox" class="form-check-input content-field" data-key="' . htmlspecialchars($key, ENT_QUOTES) . '" value="1"' . $checked . '><label class="form-check-label">' . $label . '</label></div>' . "\n";
}

function ourwork_form_images($content, $key, $label) {
    $images = ourwork_form_value($content, $key, []);
    if (!is_array($images)) $images = [];
    echo '<div class="form-group"><label>' . $label . '</label><div id="field-' . htmlspecialchars($key, ENT_QUOTES) . '-list">';
    foreach ($images as $i => $img) {
        $src = htmlspecialchars($img['src'] ?? '', ENT_QUOTES);
        $alt = htmlspecialchars($img['alt'] ?? '', ENT_QUOTES);
        echo '<div class="image-row" style="margin-bottom:8px;">';
        echo '<input type="text" class="form-control content-image-src" data-parent="' . htmlspecialchars($key, ENT_QUOTES) . '" data-index="' . $i . '" value="' . $src . '" placeholder="Image URL" style="width:45%;display:inline-block;">';
        echo '<input type="text" class="form-control content-image-alt" data-parent="' . htmlspecialchars($key, ENT_QUOTES) . '" data-index="' . $i . '" value="' . $alt . '" placeholder="Alt text" style="width:45%;display:inline-block;">';
        echo '<button type="button" class="btn btn-danger btn-sm remove-image" data-parent="' . htmlspecialchars($key, ENT_QUOTES) . '" data-index="' . $i . '">&times;</button>';
        echo '</div>';
    }
    echo '</div><button type="button" class="btn btn-secondary btn-sm" id="add-image-' . htmlspecialchars($key, ENT_QUOTES) . '">Add Image</button></div>' . "\n";
}

function ourwork_form_cards($content, $key) {
    $cards = ourwork_form_value($content, $key, []);
    if (!is_array($cards)) $cards = [];
    echo '<div class="form-group"><label>Cards</label><div id="field-' . htmlspecialchars($key, ENT_QUOTES) . '-list">';
    foreach ($cards as $i => $card) {
        $items = is_array($card['items'] ?? null) ? $card['items'] : [];
        echo '<div class="card-item" style="border:1px solid #ddd;padding:10px;margin-bottom:8px;">';
        echo '<label>Items (one per line)</label><textarea class="form-control card-items" data-parent="' . htmlspecialchars($key, ENT_QUOTES) . '" data-index="' . $i . '" rows="3">' . htmlspecialchars(implode("\n", $items), ENT_QUOTES) . '</textarea>';
        echo '<button type="button" class="btn btn-danger btn-sm remove-card" data-parent="' . htmlspecialchars($key, ENT_QUOTES) . '" data-index="' . $i . '" style="margin-top:5px;">Remove</button>';
        echo '</div>';
    }
    echo '</div><button type="button" class="btn btn-secondary btn-sm" id="add-card-' . htmlspecialchars($key, ENT_QUOTES) . '">Add Card</button></div>' . "\n";
}

function ourwork_form_items($content, $key, $label) {
    $items = ourwork_form_value($content, $key, []);
    if (!is_array($items)) $items = [];
    echo '<div class="form-group"><label>' . $label . '</label><div id="field-' . htmlspecialchars($key, ENT_QUOTES) . '-list">';
    foreach ($items as $i => $item) {
        if (is_array($item)) {
            echo '<div class="item-row" style="margin-bottom:8px;">';
            echo '<input type="text" class="form-control content-item-field" data-parent="' . htmlspecialchars($key, ENT_QUOTES) . '" data-index="' . $i . '" data-subkey="text" value="' . htmlspecialchars($item['text'] ?? '', ENT_QUOTES) . '" placeholder="Text" style="width:60%;display:inline-block;">';
            echo '<button type="button" class="btn btn-danger btn-sm remove-item" data-parent="' . htmlspecialchars($key, ENT_QUOTES) . '" data-index="' . $i . '">&times;</button>';
            echo '</div>';
        } else {
            echo '<div class="item-row" style="margin-bottom:8px;">';
            echo '<input type="text" class="form-control content-item-field" data-parent="' . htmlspecialchars($key, ENT_QUOTES) . '" data-index="' . $i . '" value="' . htmlspecialchars($item, ENT_QUOTES) . '" placeholder="Item" style="width:80%;display:inline-block;">';
            echo '<button type="button" class="btn btn-danger btn-sm remove-item" data-parent="' . htmlspecialchars($key, ENT_QUOTES) . '" data-index="' . $i . '">&times;</button>';
            echo '</div>';
        }
    }
    echo '</div><button type="button" class="btn btn-secondary btn-sm" id="add-item-' . htmlspecialchars($key, ENT_QUOTES) . '">Add Item</button></div>' . "\n";
}

function ourwork_form_render_fields($content, $section_type) {
    if (!is_array($content)) $content = [];
    echo '<div class="structured-fields" data-section-type="' . htmlspecialchars($section_type, ENT_QUOTES) . '">' . "\n";

    switch ($section_type) {
        case 'hero':
            ourwork_form_text($content, 'heading', 'Heading');
            ourwork_form_text($content, 'subheading', 'Subheading');
            ourwork_form_text($content, 'background_image', 'Background Image URL');
            ourwork_form_text($content, 'cta_text', 'CTA Button Text');
            ourwork_form_text($content, 'cta_link', 'CTA Button Link');
            break;

        case 'text':
            ourwork_form_text($content, 'section_class', 'Section CSS Class (optional)', 'history-wrap sec-padd');
            ourwork_form_text($content, 'heading', 'Heading');
            ourwork_form_textarea($content, 'body', 'Body / HTML Content', 6);
            ourwork_form_text($content, 'image', 'Image URL');
            ourwork_form_select($content, 'image_align', 'Image Align', ['left' => 'Left', 'right' => 'Right'], 'left');
            ourwork_form_text($content, 'image_col_class', 'Image Column CSS Class (optional)', 'col-md-6');
            ourwork_form_text($content, 'text_col_class', 'Text Column CSS Class (optional)', 'col-md-6');
            ourwork_form_text($content, 'text_wrapper', 'Text Wrapper Class (optional)', '');
            ourwork_form_text($content, 'image_wrapper_class', 'Image Wrapper Class (optional, e.g. card-columns literacy-columns)', '');
            ourwork_form_text($content, 'col_class', 'Text Column CSS Class (legacy)', 'col-md-12');
            ourwork_form_checkbox($content, 'no_padd', 'Remove Section Padding (history-wrap only, no sec-padd)');
            break;

        case 'text_with_carousel':
            ourwork_form_text($content, 'section_class', 'Section CSS Class (optional)', 'history-wrap sec-padd');
            ourwork_form_text($content, 'heading', 'Heading');
            ourwork_form_textarea($content, 'body', 'Body Text', 4);
            ourwork_form_images($content, 'carousel_images', 'Carousel Images');
            ourwork_form_text($content, 'carousel_border', 'Carousel Border Style', '10px solid #e0e0e345');
            ourwork_form_text($content, 'carousel_id', 'Carousel ID', 'carousel');
            ourwork_form_cards($content, 'cards');
            break;

        case 'text_with_map':
            ourwork_form_text($content, 'body_top', 'Top Body Text (optional)');
            ourwork_form_textarea($content, 'body', 'Main Body Text', 5);
            ourwork_form_items($content, 'body_blocks', 'Extra Body Paragraphs');
            ourwork_form_text($content, 'map_image', 'Map Image URL');
            break;

        case 'list_cards':
            ourwork_form_cards($content, 'cards');
            break;

        case 'image':
            ourwork_form_text($content, 'src', 'Image URL');
            ourwork_form_text($content, 'alt', 'Alt Text');
            ourwork_form_text($content, 'caption', 'Caption');
            break;

        case 'sponsorship_media':
            ourwork_form_images($content, 'media_items', 'Media Images');
            ourwork_form_items($content, 'blocks', 'Text Blocks / List Blocks');
            break;

        case 'gallery':
            ourwork_form_images($content, 'images', 'Gallery Images');
            break;

        case 'stats':
            ourwork_form_text($content, 'section_class', 'Section CSS Class (optional)', 'our-partners-wrap sec-padd');
            ourwork_form_select($content, 'layout', 'Layout', ['grid' => 'Grid', 'literacy' => 'Literacy', 'scr' => 'SCR Stats'], 'grid');
            ourwork_form_text($content, 'body', 'Intro / Body Text (optional)');
            ourwork_form_text($content, 'total_number', 'Total Number (for SCR layout)', '');
            ourwork_form_text($content, 'total_label', 'Total Label (for SCR layout)', '');
            ourwork_form_items($content, 'items', 'Stats Items (number + label)');
            break;

        case 'benefits':
            ourwork_form_text($content, 'section_class', 'Section CSS Class (optional)', 'sponsorship-wrap sec-padd');
            ourwork_form_text($content, 'heading', 'Heading (plain text)');
            ourwork_form_text($content, 'heading_html', 'Heading HTML (overrides plain text if provided)');
            ourwork_form_text($content, 'button_text', 'Button Text');
            ourwork_form_text($content, 'button_link', 'Button Link');
            ourwork_form_text($content, 'image', 'Side Image URL');
            ourwork_form_text($content, 'image_caption', 'Image Caption');
            ourwork_form_textarea($content, 'note', 'Note / Extra Text', 3);
            ourwork_form_items($content, 'benefits', 'Benefits List');
            break;

        case 'cta':
            ourwork_form_text($content, 'heading', 'Heading');
            ourwork_form_text($content, 'subheading', 'Subheading');
            ourwork_form_text($content, 'button_text', 'Button Text');
            ourwork_form_text($content, 'button_link', 'Button Link');
            break;

        case 'scr_intro':
            ourwork_form_textarea($content, 'intro_text', 'Intro Text', 4);
            ourwork_form_images($content, 'carousel_images', 'Carousel Images');
            ourwork_form_text($content, 'carousel_border', 'Carousel Border Style', '10px solid #e0e0e345');
            ourwork_form_text($content, 'carousel_id', 'Carousel ID', 'carousel');
            ourwork_form_text($content, 'table1_image', 'Table 1 Image URL');
            ourwork_form_textarea($content, 'table1_text', 'Table 1 Text', 4);
            ourwork_form_text($content, 'total_number', 'Total Number (dynamic)', '');
            ourwork_form_text($content, 'total_label', 'Total Label', '');
            ourwork_form_items($content, 'stats_items', 'Stats Items (number + label)');
            break;

        case 'video_section':
            ourwork_form_text($content, 'section_class', 'Section CSS Class', 'introduction-wrap news fact-counter-2 sec-padd');
            ourwork_form_text($content, 'background_image', 'Background Image URL');
            ourwork_form_text($content, 'video_wrapper_class', 'Video Wrapper Class (e.g., rvt1_video)');
            ourwork_form_text($content, 'youtube_url', 'YouTube URL');
            ourwork_form_text($content, 'play_image', 'Play Button Image URL', '/theme/clp/assets/images/play.svg');
            ourwork_form_text($content, 'heading', 'Heading');
            ourwork_form_textarea($content, 'body', 'Body Text', 5);
            break;

        case 'table':
            ourwork_form_text($content, 'caption', 'Table Caption');
            ourwork_form_textarea($content, 'top_text', 'Top Text (optional)', 3);
            ourwork_form_textarea($content, 'bottom_text', 'Bottom Text (optional)', 3);
            ourwork_form_text($content, 'button_text', 'Button Text');
            ourwork_form_text($content, 'button_link', 'Button Link');
            ourwork_form_items($content, 'headers', 'Table Headers');
            ourwork_form_cards($content, 'rows');
            break;

        case 'custom':
            ourwork_form_textarea($content, 'html', 'Custom HTML', 10);
            break;
    }

    echo '</div>' . "\n";
}
