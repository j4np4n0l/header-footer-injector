<?php
/**
 * Plugin Name: Elementor Template Injector & Asset Manager
 * Description: Native header/footer template injection with cleanly categorized CSS, HTML, and JS controls (Global & Page Settings).
 * Version: 1.2.5
 * Author: Jan Panol
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * 1. Admin Settings Page (Categorized by CSS, HTML, JS)
 */
function leti_add_settings_page() {
    add_options_page(
        'Template Injector & Assets',
        'Template Injector & Assets',
        'manage_options',
        'let-injector',
        'leti_settings_page_html'
    );
}
add_action( 'admin_menu', 'leti_add_settings_page' );

function leti_register_settings() {
    register_setting( 'leti_options_group', 'leti_header_id' );
    register_setting( 'leti_options_group', 'leti_footer_id' );
    register_setting( 'leti_options_group', 'leti_global_custom_css' );
    register_setting( 'leti_options_group', 'leti_global_head_html' );
    register_setting( 'leti_options_group', 'leti_global_body_open_html' );
    register_setting( 'leti_options_group', 'leti_global_footer_html' );
    register_setting( 'leti_options_group', 'leti_global_head_js' );
    register_setting( 'leti_options_group', 'leti_global_body_open_js' );
    register_setting( 'leti_options_group', 'leti_global_footer_js' );
}
add_action( 'admin_init', 'leti_register_settings' );

function leti_settings_page_html() {
    ?>
    <div class="wrap">
        <h1>Elementor Template Injector & Asset Manager</h1>
        <p>Manage native template injections and control site-wide custom code categorized by asset type.</p>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'leti_options_group' );
            do_settings_sections( 'leti_options_group' );
            ?>
            
            <!-- Templates Section -->
            <h2>Template IDs</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="leti_header_id">Header Template ID</label></th>
                    <td><input type="number" id="leti_header_id" name="leti_header_id" value="<?php echo esc_attr( get_option( 'leti_header_id' ) ); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="leti_footer_id">Footer Template ID</label></th>
                    <td><input type="number" id="leti_footer_id" name="leti_footer_id" value="<?php echo esc_attr( get_option( 'leti_footer_id' ) ); ?>" class="regular-text" /></td>
                </tr>
            </table>

            <!-- CSS Category -->
            <h2>🎨 Global CSS</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="leti_global_custom_css">Custom CSS Rules</label></th>
                    <td>
                        <textarea id="leti_global_custom_css" name="leti_global_custom_css" rows="5" class="large-text code"><?php echo esc_textarea( get_option( 'leti_global_custom_css' ) ); ?></textarea>
                        <p class="description">Applies site-wide inside the &lt;head&gt; tag.</p>
                    </td>
                </tr>
            </table>

            <!-- HTML Category -->
            <h2>🌐 Global HTML</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="leti_global_head_html">Header HTML (&lt;head&gt;)</label></th>
                    <td>
                        <textarea id="leti_global_head_html" name="leti_global_head_html" rows="4" class="large-text code"><?php echo esc_textarea( get_option( 'leti_global_head_html' ) ); ?></textarea>
                        <p class="description">Injects raw HTML inside the &lt;head&gt; tag on all pages.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="leti_global_body_open_html">Body Open HTML (Start of &lt;body&gt;)</label></th>
                    <td>
                        <textarea id="leti_global_body_open_html" name="leti_global_body_open_html" rows="4" class="large-text code"><?php echo esc_textarea( get_option( 'leti_global_body_open_html' ) ); ?></textarea>
                        <p class="description">Injects raw HTML immediately after opening &lt;body&gt; tag on all pages.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="leti_global_footer_html">Footer HTML (Before &lt;/body&gt;)</label></th>
                    <td>
                        <textarea id="leti_global_footer_html" name="leti_global_footer_html" rows="4" class="large-text code"><?php echo esc_textarea( get_option( 'leti_global_footer_html' ) ); ?></textarea>
                        <p class="description">Injects raw HTML right before closing &lt;/body&gt; tag on all pages.</p>
                    </td>
                </tr>
            </table>

            <!-- JavaScript Category -->
            <h2>⚡ Global JavaScript (JS)</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="leti_global_head_js">Header JS (&lt;head&gt;)</label></th>
                    <td>
                        <textarea id="leti_global_head_js" name="leti_global_head_js" rows="4" class="large-text code"><?php echo esc_textarea( get_option( 'leti_global_head_js' ) ); ?></textarea>
                        <p class="description">Executes inside the &lt;head&gt; tag on all pages.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="leti_global_body_open_js">Body Open JS (Start of &lt;body&gt;)</label></th>
                    <td>
                        <textarea id="leti_global_body_open_js" name="leti_global_body_open_js" rows="4" class="large-text code"><?php echo esc_textarea( get_option( 'leti_global_body_open_js' ) ); ?></textarea>
                        <p class="description">Executes immediately after opening &lt;body&gt; tag on all pages.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="leti_global_footer_js">Footer JS (Before &lt;/body&gt;)</label></th>
                    <td>
                        <textarea id="leti_global_footer_js" name="leti_global_footer_js" rows="4" class="large-text code"><?php echo esc_textarea( get_option( 'leti_global_footer_js' ) ); ?></textarea>
                        <p class="description">Executes right before closing &lt;/body&gt; tag on all pages.</p>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * 2. Add Categorized Controls to Elementor Page Settings
 */
function leti_add_elementor_page_assets_controls( $page ) {
    // CSS Category Section
    $page->start_controls_section(
        'leti_custom_css_section',
        [
            'label' => '🎨 Page CSS',
            'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
        ]
    );

    $page->add_control(
        'leti_page_custom_css',
        [
            'label'       => 'Custom CSS Rules',
            'type'        => \Elementor\Controls_Manager::CODE,
            'language'    => 'css',
            'rows'        => 8,
            'description' => 'Applies only to this page/template.',
        ]
    );

    $page->end_controls_section();

    // HTML Category Section
    $page->start_controls_section(
        'leti_custom_html_section',
        [
            'label' => '🌐 Page HTML',
            'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
        ]
    );

    $page->add_control(
        'leti_page_head_html',
        [
            'label'       => 'Header HTML (<head>)',
            'type'        => \Elementor\Controls_Manager::CODE,
            'language'    => 'html',
            'rows'        => 5,
            'description' => 'Injects raw HTML into the page <head>.',
        ]
    );

    $page->add_control(
        'leti_page_body_open_html',
        [
            'label'       => 'Body Open HTML (Start of <body>)',
            'type'        => \Elementor\Controls_Manager::CODE,
            'language'    => 'html',
            'rows'        => 5,
            'description' => 'Injects raw HTML after opening <body>.',
        ]
    );

    $page->add_control(
        'leti_page_footer_html',
        [
            'label'       => 'Footer HTML (Before </body>)',
            'type'        => \Elementor\Controls_Manager::CODE,
            'language'    => 'html',
            'rows'        => 5,
            'description' => 'Injects raw HTML before closing </body>.',
        ]
    );

    $page->end_controls_section();

    // JS Category Section
    $page->start_controls_section(
        'leti_custom_js_section',
        [
            'label' => '⚡ Page JavaScript (JS)',
            'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
        ]
    );

    $page->add_control(
        'leti_page_head_js',
        [
            'label'       => 'Header JS (<head>)',
            'type'        => \Elementor\Controls_Manager::CODE,
            'language'    => 'javascript',
            'rows'        => 5,
            'description' => 'Executes in the page <head>.',
        ]
    );

    $page->add_control(
        'leti_page_body_open_js',
        [
            'label'       => 'Body Open JS (Start of <body>)',
            'type'        => \Elementor\Controls_Manager::CODE,
            'language'    => 'javascript',
            'rows'        => 5,
            'description' => 'Executes after opening <body>.',
        ]
    );

    $page->add_control(
        'leti_page_footer_js',
        [
            'label'       => 'Footer JS (Before </body>)',
            'type'        => \Elementor\Controls_Manager::CODE,
            'language'    => 'javascript',
            'rows'        => 5,
            'description' => 'Executes before closing </body>.',
        ]
    );

    $page->end_controls_section();
}
add_action( 'elementor/documents/register_controls', 'leti_add_elementor_page_assets_controls' );

/**
 * 3. Render CSS & Header Assets in <head>
 */
function leti_output_head_assets() {
    // Output CSS
    $global_css = get_option( 'leti_global_custom_css' );
    if ( ! empty( $global_css ) ) {
        echo '<style id="leti-global-css">' . wp_strip_all_tags( $global_css ) . '</style>' . "\n";
    }

    if ( is_singular() && class_exists( '\Elementor\Plugin' ) ) {
        $document = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
        if ( $document ) {
            $page_css = $document->get_settings( 'leti_page_custom_css' );
            if ( ! empty( $page_css ) ) {
                echo '<style id="leti-page-custom-css">' . wp_strip_all_tags( $page_css ) . '</style>' . "\n";
            }
        }
    }

    // Output Header HTML
    $global_head_html = get_option( 'leti_global_head_html' );
    if ( ! empty( $global_head_html ) ) {
        echo $global_head_html . "\n";
    }

    if ( is_singular() && class_exists( '\Elementor\Plugin' ) ) {
        $document = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
        if ( $document ) {
            $page_head_html = $document->get_settings( 'leti_page_head_html' );
            if ( ! empty( $page_head_html ) ) {
                echo $page_head_html . "\n";
            }
        }
    }

    // Output Header JS
    $global_head_js = get_option( 'leti_global_head_js' );
    if ( ! empty( $global_head_js ) ) {
        echo '<script id="leti-global-head-js">' . $global_head_js . '</script>' . "\n";
    }

    if ( is_singular() && class_exists( '\Elementor\Plugin' ) ) {
        $document = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
        if ( $document ) {
            $page_head_js = $document->get_settings( 'leti_page_head_js' );
            if ( ! empty( $page_head_js ) ) {
                echo '<script id="leti-page-head-js">' . $page_head_js . '</script>' . "\n";
            }
        }
    }
}
add_action( 'wp_head', 'leti_output_head_assets', 20 );

/**
 * 4. Render Body Open Assets & Header Template
 */
function leti_inject_header() {
    // Body Open HTML Output
    $global_body_html = get_option( 'leti_global_body_open_html' );
    if ( ! empty( $global_body_html ) ) {
        echo $global_body_html . "\n";
    }

    if ( is_singular() && class_exists( '\Elementor\Plugin' ) ) {
        $document = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
        if ( $document ) {
            $page_body_html = $document->get_settings( 'leti_page_body_open_html' );
            if ( ! empty( $page_body_html ) ) {
                echo $page_body_html . "\n";
            }
        }
    }

    // Body Open JS Output
    $global_body_js = get_option( 'leti_global_body_open_js' );
    if ( ! empty( $global_body_js ) ) {
        echo '<script id="leti-global-body-open-js">' . $global_body_js . '</script>' . "\n";
    }

    if ( is_singular() && class_exists( '\Elementor\Plugin' ) ) {
        $document = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
        if ( $document ) {
            $page_body_js = $document->get_settings( 'leti_page_body_open_js' );
            if ( ! empty( $page_body_js ) ) {
                echo '<script id="leti-page-body-open-js">' . $page_body_js . '</script>' . "\n";
            }
        }
    }

    // Header Template Output
    $header_id = get_option( 'leti_header_id' );
    if ( $header_id && class_exists( '\Elementor\Plugin' ) ) {
        echo '<div class="site-header-wrapper">';
        echo \Elementor\Plugin::instance()->frontend->get_builder_content( intval( $header_id ) );
        echo '</div>';
    }
}
add_action( 'wp_body_open', 'leti_inject_header', 1 );

/**
 * 5. Render Footer Template & Footer Assets
 */
function leti_inject_footer() {
    // Footer Template Output
    $footer_id = get_option( 'leti_footer_id' );
    if ( $footer_id && class_exists( '\Elementor\Plugin' ) ) {
        echo '<div class="site-footer-wrapper">';
        echo \Elementor\Plugin::instance()->frontend->get_builder_content( intval( $footer_id ) );
        echo '</div>';
    }

    // Footer HTML Output
    $global_footer_html = get_option( 'leti_global_footer_html' );
    if ( ! empty( $global_footer_html ) ) {
        echo $global_footer_html . "\n";
    }

    if ( is_singular() && class_exists( '\Elementor\Plugin' ) ) {
        $document = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
        if ( $document ) {
            $page_footer_html = $document->get_settings( 'leti_page_footer_html' );
            if ( ! empty( $page_footer_html ) ) {
                echo $page_footer_html . "\n";
            }
        }
    }

    // Footer JS Output
    $global_footer_js = get_option( 'leti_global_footer_js' );
    if ( ! empty( $global_footer_js ) ) {
        echo '<script id="leti-global-footer-js">' . "\n";
        echo 'document.addEventListener("DOMContentLoaded", function() {' . "\n";
        echo $global_footer_js . "\n";
        echo '});' . "\n";
        echo '</script>' . "\n";
    }

    if ( is_singular() && class_exists( '\Elementor\Plugin' ) ) {
        $document = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
        if ( $document ) {
            $page_footer_js = $document->get_settings( 'leti_page_footer_js' );
            if ( ! empty( $page_footer_js ) ) {
                echo '<script id="leti-page-footer-js">' . "\n";
                echo 'document.addEventListener("DOMContentLoaded", function() {' . "\n";
                echo $page_footer_js . "\n";
                echo '});' . "\n";
                echo '</script>' . "\n";
            }
        }
    }
}
add_action( 'wp_footer', 'leti_inject_footer', 999 );