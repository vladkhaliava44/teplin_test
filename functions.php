<?php 

add_action('wp_enqueue_scripts', 'teplin_scripts');

function teplin_scripts() {
    wp_enqueue_style('bootstrap_min', get_template_directory_uri( ) . '/assets/css/bootstrap.min.css', null);
    wp_enqueue_style('slick', get_template_directory_uri( ) . '/assets/css/slick.css', null, null);
    wp_enqueue_style('fonts', get_template_directory_uri( ) . '/assets/css/fonts.css', null, null);
    wp_enqueue_style('style', get_template_directory_uri( ) . '/style.css', null, null);

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap.bundle.min', get_template_directory_uri( ) . '/assets/js/bootstrap.bundle.min.js', null, true);
    wp_enqueue_script('slick.min', get_template_directory_uri( ) . '/assets/js/slick.min.js', null, null, true);
    wp_enqueue_script('global', get_template_directory_uri( ) . '/assets/js/global.js', null, null, true);
}

register_nav_menus([
    'header_menu'=>'Header Menu',
    'footer_menu'=>'Footer Menu',
]);

function arphabet_widgets_init() { 
 
    register_sidebar( array( 
    'name'          => 'Home right sidebar', 
    'id'            => 'home_right_1', 
    'before_widget' => '<div>', 
    'after_widget'  => '</div>', 
    'before_title'  => '<h2 class="rounded">', 
    'after_title'   => '</h2>', 
    ) ); 
 
} 
add_action( 'widgets_init', 'arphabet_widgets_init' ); 

add_theme_support( 'post-thumbnails' ); 
add_filter( 'use_block_editor_for_post_type', '__return_false' );

// WooCommerce API credentials
$consumer_key = 'ck_ec6f6dc273c54bb6c45684d2c4f2b98b928d3ce8';
$consumer_secret = 'cs_ae10828a2b8fb180788cf2b7ed949ca96e7e7016';
$base_url = 'https://localhost/wp-json/wc/v3';
$xml_url = 'https://file.notion.so/f/f/7c481774-d879-405b-a2a4-d3aaadd9c822/8fe065e3-e442-4ae6-ae70-c15a520017e4/products.xml?id=e29d4f66-0606-4507-bc5a-876ff4d54478&table=block&spaceId=7c481774-d879-405b-a2a4-d3aaadd9c822&expirationTimestamp=1712512800000&signature=Ag6GRmgUigMOZaUdz6evHqwjoMgFIKk7EPyJ3ahUDZg&downloadName=products.xml';
$xml_file_path = $_SERVER['DOCUMENT_ROOT'] . '/products.xml';

// Download XML file from URL and save it to the specified path
function downloadXmlFile($url, $filepath) {
    $file_content = file_get_contents($url);
    if ($file_content !== false) {
        file_put_contents($filepath, $file_content);
        echo "XML done";
    } else {
        echo "false";
    }
}

require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;

//Parse XML file and import products to WooCommerce
function importProductsFromXml($filepath, $consumer_key, $consumer_secret, $base_url) {
    $woocommerce = new Client (
        $base_url,
        $consumer_key,
        $consumer_secret,
        [
            'wp_api' => true,
            'version' => 'wc/v3',
            'verify_ssl' => false,
            'query_string_auth' => true
        ]
    );

    // Parse XML file
    $xml = simplexml_load_file($filepath);

    if ($xml !== false) {
        foreach ($xml->product as $product) {
            $product_data = [
                'name' => (string)$product->name,
                'regular_price' => (string)$product->regular_price,
                'description' => (string)$product->description,
                // Add more fields as needed
            ];

            // Send product data to WooCommerce
            $result = $woocommerce->post('products', $product_data);
            if (!empty($result)) {
                echo "Product '{$product_data['name']}' import\n";
            } else {
                echo "False import '{$product_data['name']}'.\n";
            }
        }
    } else {
        echo "Unable to parse XML file.\n";
    }
}

// Download XML file
downloadXmlFile($xml_url, $xml_file_path);

// Import products from XML to WooCommerce
importProductsFromXml($xml_file_path, $consumer_key, $consumer_secret, $base_url);

?>
