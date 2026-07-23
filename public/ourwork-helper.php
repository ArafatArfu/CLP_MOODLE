<?php
// Our Work Frontend Helper
// Renders the exact original theme HTML from the CMS database.

defined('MOODLE_INTERNAL') || define('MOODLE_INTERNAL', true);

function ourwork_get_page(string $slug): ?array {
    global $DB;
    $sql = "SELECT * FROM clp_ourwork_pages WHERE slug = :slug AND status = 'published'";
    $record = $DB->get_record_sql($sql, ['slug' => $slug]);
    return $record ? (array)$record : null;
}

function ourwork_get_sections(int $page_id): array {
    global $DB;
    $sql = "SELECT * FROM clp_ourwork_sections WHERE page_id = :pid AND status = 'published' ORDER BY display_order ASC, id ASC";
    $records = $DB->get_recordset_sql($sql, ['pid' => $page_id]);
    $sections = [];
    foreach ($records as $record) {
        $sections[] = (array)$record;
    }
    $records->close();
    return $sections;
}

function ourwork_section(array $sections, string $key, string $field, $default = '') {
    foreach ($sections as $section) {
        if ($section['section_key'] === $key) {
            $content = json_decode($section['content'] ?? '{}', true);
            if (is_array($content) && array_key_exists($field, $content)) {
                return $content[$field];
            }
        }
    }
    return $default;
}

function ourwork_general(string $key, string $default = ''): string {
    global $DB;
    $record = $DB->get_record('clp_general', ['setting_key' => $key]);
    return $record ? (string)$record->setting_value : $default;
}

function ourwork_render_section(array $section): string {
    $type = $section['section_type'] ?? 'text';
    $content = json_decode($section['content'] ?? '{}', true);
    if (!is_array($content)) {
        $content = [];
    }

    switch ($type) {
        case 'hero':
            $heading = htmlspecialchars($content['heading'] ?? '', ENT_QUOTES);
            $subheading = htmlspecialchars($content['subheading'] ?? '', ENT_QUOTES);
            $bg = htmlspecialchars($content['background_image'] ?? '', ENT_QUOTES);
            $ctaText = htmlspecialchars($content['cta_text'] ?? '', ENT_QUOTES);
            $ctaLink = htmlspecialchars($content['cta_link'] ?? '#', ENT_QUOTES);
            $breadcrumbs = is_array($content['breadcrumbs'] ?? null) ? $content['breadcrumbs'] : [];
            $style = $bg ? " style=\"background-image: url('{$bg}');\"" : '';
            ob_start();
            ?>
            <section class="inner-banner"<?php echo $style; ?>>
                <div class="container">
                    <div class="box">
                        <h1><?php echo $heading; ?></h1>
                        <?php if ($subheading): ?><p><?php echo $subheading; ?></p><?php endif; ?>
                        <div class="breadcumb-wrapper">
                            <ul class="list-inline link-list">
                                <?php foreach ($breadcrumbs as $crumb): ?>
                                    <li>
                                        <?php if (!empty($crumb['link'])): ?>
                                            <a href="<?php echo htmlspecialchars($crumb['link'], ENT_QUOTES); ?>">
                                                <?php if (!empty($crumb['icon'])): ?><i class="<?php echo htmlspecialchars($crumb['icon'], ENT_QUOTES); ?>" aria-hidden="true"></i> <?php endif; ?>
                                                <?php echo htmlspecialchars($crumb['label'], ENT_QUOTES); ?>
                                            </a>
                                        <?php else: ?>
                                            <?php echo htmlspecialchars($crumb['label'], ENT_QUOTES); ?>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            return ob_get_clean();

        case 'text':
            $heading = htmlspecialchars($content['heading'] ?? '', ENT_QUOTES);
            $body = $content['body'] ?? '';
            $image = htmlspecialchars($content['image'] ?? '', ENT_QUOTES);
            $imageAlign = htmlspecialchars($content['image_align'] ?? 'left', ENT_QUOTES);
            $alignClass = $imageAlign === 'right' ? 'col-md-pull-6' : '';
            $noPadd = !empty($content['no_padd']);
            $sectionClass = $noPadd ? 'history-wrap' : 'history-wrap sec-padd';
            $colClass = !empty($content['col_class']) ? htmlspecialchars($content['col_class'], ENT_QUOTES) : ($image ? 'col-md-6' : 'col-md-12');
            ob_start();
            ?>
            <section class="<?php echo $sectionClass; ?>">
                <div class="container">
                    <div class="row">
                        <?php if ($image): ?>
                            <div class="col-md-6 <?php echo $alignClass; ?>">
                                <img src="<?php echo $image; ?>" alt="<?php echo $heading; ?>" class="img-responsive">
                            </div>
                        <?php endif; ?>
                        <div class="<?php echo $colClass; ?>">
                            <?php if ($heading): ?><h3><?php echo $heading; ?></h3><?php endif; ?>
                            <p class="work_para"><?php echo $body; ?></p>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            return ob_get_clean();

        case 'text_with_carousel':
            $heading = htmlspecialchars($content['heading'] ?? '', ENT_QUOTES);
            $body = $content['body'] ?? '';
            $carouselImages = is_array($content['carousel_images'] ?? null) ? $content['carousel_images'] : [];
            $carouselBorder = htmlspecialchars($content['carousel_border'] ?? '10px solid #e0e0e345', ENT_QUOTES);
            $carouselId = htmlspecialchars($content['carousel_id'] ?? 'carousel', ENT_QUOTES);
            ob_start();
            ?>
            <section class="history-wrap sec-padd">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <?php if ($heading): ?><h3><?php echo $heading; ?></h3><?php endif; ?>
                            <p class="work_para"><?php echo $body; ?></p>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div style="border: <?php echo $carouselBorder; ?>;" id="<?php echo $carouselId; ?>" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php foreach ($carouselImages as $i => $img): ?>
                                        <li data-target="#<?php echo $carouselId; ?>" data-slide-to="<?php echo $i; ?>" <?php echo $i === 0 ? 'class="active"' : ''; ?>></li>
                                    <?php endforeach; ?>
                                </ol>
                                <div class="carousel-inner carousel-zoom">
                                    <?php foreach ($carouselImages as $i => $img): ?>
                                        <div class="<?php echo $i === 0 ? 'active ' : ''; ?>item slider-inner-img">
                                            <img class="img-responsive" src="<?php echo htmlspecialchars($img['src'] ?? '', ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($img['alt'] ?? '', ENT_QUOTES); ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <a class="left carousel-control" href="#<?php echo $carouselId; ?>" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#<?php echo $carouselId; ?>" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $cards = is_array($content['cards'] ?? null) ? $content['cards'] : [];
                    if (!empty($cards)): ?>
                    <br>
                    <div class="row">
                        <?php foreach ($cards as $card): ?>
                            <div class="card-columns literacy-columns">
                                <div class="card partner-items literacy mrg">
                                    <div class="text-col">
                                        <div class="inner work_para">
                                            <?php if (!empty($card['items']) && is_array($card['items'])): ?>
                                                <ul>
                                                    <?php foreach ($card['items'] as $item): ?>
                                                        <li><?php echo htmlspecialchars($item, ENT_QUOTES); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <?php
            return ob_get_clean();

        case 'list_cards':
            $cards = is_array($content['cards'] ?? null) ? $content['cards'] : [];
            ob_start();
            ?>
            <section class="history-wrap sec-padd">
                <div class="container">
                    <div class="row">
                        <?php foreach ($cards as $card): ?>
                            <div class="card-columns literacy-columns">
                                <div class="card partner-items literacy mrg">
                                    <div class="text-col">
                                        <div class="inner work_para">
                                            <?php if (!empty($card['items']) && is_array($card['items'])): ?>
                                                <ul>
                                                    <?php foreach ($card['items'] as $item): ?>
                                                        <li><?php echo htmlspecialchars($item, ENT_QUOTES); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <?php
            return ob_get_clean();

        case 'image':
            $src = htmlspecialchars($content['src'] ?? '', ENT_QUOTES);
            $alt = htmlspecialchars($content['alt'] ?? '', ENT_QUOTES);
            $caption = htmlspecialchars($content['caption'] ?? '', ENT_QUOTES);
            ob_start();
            ?>
            <section class="sponsorship-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <?php if ($src): ?>
                                <p><img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" class="img-responsive"/></p>
                            <?php endif; ?>
                            <?php if ($caption): ?>
                                <p class="work_para"><?php echo $caption; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            return ob_get_clean();

        case 'text_with_map':
            $bodyTop = htmlspecialchars($content['body_top'] ?? '', ENT_QUOTES);
            $rawBody = $content['body'] ?? '';
            $body = preg_replace_callback('/\{\{(\w+)\}\}/', function ($m) {
                return ourwork_general($m[1], $m[0]);
            }, $rawBody);
            $bodyBlocks = is_array($content['body_blocks'] ?? null) ? $content['body_blocks'] : [];
            $mapImage = htmlspecialchars($content['map_image'] ?? '', ENT_QUOTES);
            ob_start();
            ?>
            <section class="history-wrap">
                <div class="container">
                    <div class="row">
                        <?php if ($bodyTop): ?>
                            <div class="col-xs-12">
                                <p class="work_para"><?php echo $bodyTop; ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="col-sm-7 col-xs-12">
                            <?php if ($body): ?>
                                <p class="work_para"><?php echo $body; ?></p>
                            <?php endif; ?>
                            <?php foreach ($bodyBlocks as $block): ?>
                                <p class="work_para"><?php echo htmlspecialchars($block, ENT_QUOTES); ?></p>
                            <?php endforeach; ?>
                        </div>
                        <?php if ($mapImage): ?>
                            <div class="col-sm-5 col-xs-12">
                                <p><img src="<?php echo $mapImage; ?>" alt="map" class="img-responsive"/></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php
            return ob_get_clean();

        case 'sponsorship_media':
            $mediaItems = is_array($content['media_items'] ?? null) ? $content['media_items'] : [];
            $blocks = is_array($content['blocks'] ?? null) ? $content['blocks'] : [];
            $listItems = is_array($content['list'] ?? null) ? $content['list'] : [];
            ob_start();
            ?>
            <section class="sponsorship-wrap">
                <div class="container">
                    <div class="row">
                        <?php foreach ($mediaItems as $item): ?>
                            <div class="col-xs-12">
                                <p><img src="<?php echo htmlspecialchars($item['src'] ?? $item ?? '', ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($item['alt'] ?? 'img', ENT_QUOTES); ?>" class="img-responsive"/></p>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-xs-12">
                            <?php foreach ($blocks as $block): ?>
                                <?php if (is_array($block) && !empty($block['list'])): ?>
                                    <?php if (!empty($block['text'])): ?>
                                        <p class="work_para"><?php echo htmlspecialchars($block['text'], ENT_QUOTES); ?></p>
                                    <?php endif; ?>
                                    <div style="padding-left: 30px;" class="text-col">
                                        <div class="inner work_para">
                                            <ul>
                                                <?php foreach ($block['list'] as $li): ?>
                                                    <li><?php echo htmlspecialchars($li, ENT_QUOTES); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <p class="work_para"><?php echo htmlspecialchars($block, ENT_QUOTES); ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if (!empty($listItems) && empty($blocks)): ?>
                                <div style="padding-left: 30px;" class="text-col">
                                    <div class="inner work_para">
                                        <ul>
                                            <?php foreach ($listItems as $li): ?>
                                                <li><?php echo htmlspecialchars($li, ENT_QUOTES); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            return ob_get_clean();

        case 'gallery':
            $images = $content['images'] ?? [];
            if (!is_array($images)) $images = [];
            ob_start();
            ?>
            <section class="history-wrap sec-padd">
                <div class="container">
                    <div class="row">
                        <?php foreach ($images as $img): ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="single-item-carousel">
                                    <div class="active item slider-inner-img">
                                        <img class="img-responsive" src="<?php echo htmlspecialchars($img['src'] ?? '', ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($img['alt'] ?? '', ENT_QUOTES); ?>">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <?php
            return ob_get_clean();

        case 'stats':
            $layout = htmlspecialchars($content['layout'] ?? 'grid', ENT_QUOTES);
            $items = is_array($content['items'] ?? null) ? $content['items'] : [];
            $replacePlaceholders = function ($text) {
                return preg_replace_callback('/\{\{(\w+)\}\}/', function ($m) {
                    return ourwork_general($m[1], $m[0]);
                }, $text);
            };
            ob_start();
            ?>
            <section class="our-partners-wrap">
                <div class="container <?php echo $layout === 'literacy' ? 'literacy-container' : ''; ?>">
                    <?php if ($layout === 'literacy'): ?>
                        <div class="card-columns">
                            <?php foreach ($items as $item): ?>
                                <?php if (empty($item['list'])): ?>
                                    <div class="card partner-items literacy">
                                        <div class="img-col">
                                            <h4><?php echo $replacePlaceholders(htmlspecialchars($item['number'] ?? '', ENT_QUOTES)); ?></h4>
                                            <p><?php echo $replacePlaceholders(htmlspecialchars($item['label'] ?? '', ENT_QUOTES)); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-columns literacy-columns">
                            <?php foreach ($items as $item): ?>
                                <?php if (!empty($item['list'])): ?>
                                    <div class="card partner-items literacy mrg">
                                        <div class="img-col">
                                            <h4><?php echo $replacePlaceholders(htmlspecialchars($item['number'] ?? '', ENT_QUOTES)); ?></h4>
                                            <p><?php echo $replacePlaceholders(htmlspecialchars($item['label'] ?? '', ENT_QUOTES)); ?></p>
                                        </div>
                                        <div class="text-col">
                                            <div class="inner">
                                                <h4><?php echo htmlspecialchars($item['list']['heading'] ?? '', ENT_QUOTES); ?></h4>
                                                <ul class="work_para">
                                                    <?php foreach ($item['list']['items'] as $li): ?>
                                                        <li><?php echo htmlspecialchars($li, ENT_QUOTES); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($items as $item): ?>
                                <div class="col-md-3 col-sm-6">
                                    <div class="single-item-carousel text-center">
                                        <h4><?php echo $replacePlaceholders(htmlspecialchars($item['number'] ?? '', ENT_QUOTES)); ?></h4>
                                        <p><?php echo $replacePlaceholders(htmlspecialchars($item['label'] ?? '', ENT_QUOTES)); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
            <?php
            return ob_get_clean();

        case 'benefits':
            $heading = htmlspecialchars($content['heading'] ?? '', ENT_QUOTES);
            $benefits = is_array($content['benefits'] ?? null) ? $content['benefits'] : [];
            $btnText = htmlspecialchars($content['button_text'] ?? '', ENT_QUOTES);
            $btnLink = htmlspecialchars($content['button_link'] ?? '#', ENT_QUOTES);
            $image = htmlspecialchars($content['image'] ?? '', ENT_QUOTES);
            $imageCaption = htmlspecialchars($content['image_caption'] ?? '', ENT_QUOTES);
            $note = $content['note'] ?? '';
            ob_start();
            ?>
            <section class="sponsorship-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="section-title center">
                                <h2><?php echo $heading; ?></h2>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <ul class="spns-benefits-list work_para">
                                <?php foreach ($benefits as $benefit): ?>
                                    <li><?php echo htmlspecialchars($benefit, ENT_QUOTES); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <p class="btn-area donate-now text-left">
                                <?php if ($btnText): ?>
                                    <a href="<?php echo $btnLink; ?>" class="thm-btn"><?php echo $btnText; ?></a>
                                <?php endif; ?>
                            </p>
                            <?php if ($note): ?>
                                <p class="work_para"><?php echo $note; ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if ($image): ?>
                            <div class="col-sm-6 col-xs-12">
                                <p><img src="<?php echo $image; ?>" alt="<?php echo $imageCaption; ?>" class="img-responsive"></p>
                                <?php if ($imageCaption): ?>
                                    <p class="work_para"><?php echo $imageCaption; ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php
            return ob_get_clean();

        case 'cta':
            $heading = htmlspecialchars($content['heading'] ?? '', ENT_QUOTES);
            $subheading = htmlspecialchars($content['subheading'] ?? '', ENT_QUOTES);
            $btnText = htmlspecialchars($content['button_text'] ?? '', ENT_QUOTES);
            $btnLink = htmlspecialchars($content['button_link'] ?? '#', ENT_QUOTES);
            ob_start();
            ?>
            <section class="sponsorship-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <?php if ($heading): ?><h3><?php echo $heading; ?></h3><?php endif; ?>
                            <?php if ($subheading): ?><p class="work_para"><?php echo $subheading; ?></p><?php endif; ?>
                            <?php if ($btnText): ?>
                                <a href="<?php echo $btnLink; ?>" class="thm-btn"><?php echo $btnText; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            return ob_get_clean();

        case 'custom':
            return $content['html'] ?? '';

        default:
            return '';
    }
}

function ourwork_render_sections(array $sections): string {
    $html = '';
    foreach ($sections as $section) {
        $html .= ourwork_render_section($section);
    }
    return $html;
}

function ourwork_footer_setting(string $key, string $default = ''): string {
    global $DB;
    $record = $DB->get_record('clp_footer_settings', ['setting_key' => $key]);
    return $record ? (string)$record->setting_value : $default;
}

function ourwork_footer_settings_json(string $key, $default = []): array {
    $raw = ourwork_footer_setting($key, '');
    if ($raw === '') return $default;
    $decoded = json_decode($raw, true);
    return is_array($decoded) ? $decoded : $default;
}

function ourwork_footer(): string {
    $logo = ourwork_footer_setting('logo', '/theme/clp/assets/images/logo/clp-logo-2022-4.png');
    $aboutText = ourwork_footer_setting('about_text', 'Empowering underprivileged youths through computer literacy training and technology-aided education.');
    $phone = ourwork_footer_setting('phone', '(732) 972-8362');
    $email = ourwork_footer_setting('email', 'clp@clpweb.org');
    $address = ourwork_footer_setting('address', "Computer Literacy Program (CLP)\n6 Tharp Lane\nMarlboro, NJ 07746, USA");
    $mission = ourwork_footer_setting('mission', 'Empowering underprivileged youths through computer literacy training and technology-aided education.');
    $legal = ourwork_footer_setting('legal', 'IRS ID: <strong>46-0646134</strong>');
    $copyright = ourwork_footer_setting('copyright', 'Copyright &copy; CLP, 2026');

    $resources = ourwork_footer_settings_json('resources', [
        ['label' => 'INDEPENDENT EVALUATION REPORT', 'link' => '/evaluation-report.php'],
        ['label' => 'FORMATIVE REPORT', 'link' => '/formative-reports.php'],
        ['label' => 'ANNUAL REPORT', 'link' => '/annual-report.php'],
        ['label' => 'MAGAZINES', 'link' => '/magazines.php'],
        ['label' => 'BROCHURE', 'link' => '/brochure.php'],
    ]);
    $quickLinks = ourwork_footer_settings_json('quick_links', [
        ['label' => 'DONATE ONLINE', 'link' => '/donation-online.php'],
        ['label' => 'DONATE BY MAIL', 'link' => '/donation-mail.php'],
        ['label' => 'DONATE BY AMAZON-SMILE', 'link' => '/donation-amazon.php'],
        ['label' => 'SPONSOR A CLC', 'link' => '/sponsor-clc.php'],
        ['label' => 'SPONSOR A SCR', 'link' => '/sponsor-scr.php'],
        ['label' => 'SPONSOR A TOKAI(টোকাই)-CLC', 'link' => '/sponsor-tokai.php'],
        ['label' => 'SPONSOR A COMPUTER', 'link' => '/sponsor-computer.php'],
        ['label' => 'BE A VOLUNTEER', 'link' => '/volunteer.php'],
        ['label' => 'CONTACT US', 'link' => '/contact-us.php'],
    ]);
    $social = ourwork_footer_settings_json('social', [
        'facebook' => 'https://facebook.com/CLPUSAA',
        'instagram' => 'https://www.instagram.com/clp_usa/',
        'twitter' => 'https://twitter.com/clp_usa',
        'youtube' => 'https://www.youtube.com/channel/UC3CIzUUXeDXspImUjubA19A',
        'linkedin' => 'https://www.linkedin.com/company/computer-literacy-program-volunteers-for-underprivileged/',
    ]);

    $addressFormatted = nl2br(htmlspecialchars($address, ENT_QUOTES));

    ob_start();
    ?>
    <footer class="clp-footer">
        <section class="container-fluid">
            <div class="row">
                <div class="col-sm-4 col-xs-12" style="background-color: #f7f1e3; height: 520px;">
                    <h3 class="footer-title">Resources</h3>
                    <ul class="footer-list-menu">
                        <?php foreach ($resources as $item): ?>
                            <li><a href="<?php echo htmlspecialchars($item['link'] ?? '#', ENT_QUOTES); ?>"><?php echo strtoupper(htmlspecialchars($item['label'] ?? '', ENT_QUOTES)); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <h3 class="footer-title">Contact Info</h3>
                    <a style="color:black;" href="tel:<?php echo htmlspecialchars($phone, ENT_QUOTES); ?>"><?php echo htmlspecialchars($phone, ENT_QUOTES); ?></a> <br/>
                    <a style="color:black;" href="mailto:<?php echo htmlspecialchars($email, ENT_QUOTES); ?>"><?php echo htmlspecialchars($email, ENT_QUOTES); ?></a>

                    <h3 class="footer-title">Mailing Address</h3>
                    <p class="address"><?php echo $addressFormatted; ?></p>
                </div>

                <div class="col-sm-4 col-xs-12" style="height: 520px;">
                    <h3 class="footer-title">CLP Mission</h3>
                    <p style="line-height: 20px;"><?php echo htmlspecialchars($mission, ENT_QUOTES); ?></p>
                    <h3 class="footer-title">Follow Us</h3>
                    <div class="row">
                        <div class="footer-social">
                            <?php if (!empty($social['facebook'])): ?><a target="_blank" href="<?php echo htmlspecialchars($social['facebook'], ENT_QUOTES); ?>" class="fa fa-facebook social-fb"></a><?php endif; ?>
                            <?php if (!empty($social['instagram'])): ?><a target="_blank" href="<?php echo htmlspecialchars($social['instagram'], ENT_QUOTES); ?>" class="fa fa-instagram social-instagram"></a><?php endif; ?>
                            <?php if (!empty($social['twitter'])): ?><a target="_blank" href="<?php echo htmlspecialchars($social['twitter'], ENT_QUOTES); ?>" class="fa fa-twitter social-twitter"></a><?php endif; ?>
                            <?php if (!empty($social['youtube'])): ?><a target="_blank" href="<?php echo htmlspecialchars($social['youtube'], ENT_QUOTES); ?>" class="fa fa-youtube social-youtube"></a><?php endif; ?>
                            <?php if (!empty($social['linkedin'])): ?><a target="_blank" href="<?php echo htmlspecialchars($social['linkedin'], ENT_QUOTES); ?>" class="fa fa-linkedin social-linkedin"></a><?php endif; ?>
                        </div>
                    </div>

                    <h3 class="footer-title">Legal Info</h3>
                    <ul class="footer-list-menu">
                        <li><?php echo $legal; ?></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-xs-12" style="background-color: #f7f1e3; height: 520px;">
                    <h3 class="footer-title">Quick Links</h3>
                    <ul class="footer-list-menu">
                        <?php foreach ($quickLinks as $item): ?>
                            <li><a href="<?php echo htmlspecialchars($item['link'] ?? '#', ENT_QUOTES); ?>"><?php echo strtoupper(htmlspecialchars($item['label'] ?? '', ENT_QUOTES)); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="background-color: #232121;">
                    <p class="text-center" style="color: #FFF; padding: 5px;"><?php echo htmlspecialchars($copyright, ENT_QUOTES); ?></p>
                </div>
            </div>
        </section>
    </footer>
    <?php
    return ob_get_clean();
}
