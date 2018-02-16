/**
 * @snippet       Disable Variable Product Price Range
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/disable-variable-product-price-range-woocommerce/
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.1.1
 */
 
add_filter( 'woocommerce_variable_price_html', 'bbloomer_variation_price_format_310', 10, 2 );
 
function bbloomer_variation_price_format_310( $price, $product ) {
 
// 1. Find the minimum regular and sale prices
 
$available_variations = $product->get_available_variations();

#Step 2: Get product variation id
$variation_id=$available_variations[0]['variation_id']; // Getting the variable id of just the 1st product. You can loop $available_variations to get info about each variation.

#Step 3: Create the variable product object
$variable_product1= new WC_Product_Variation( $variation_id );

#Step 4: You have the data. Have fun :)
$sales_price = $variable_product1 ->sale_price;

$min_var_reg_price = $product->get_variation_regular_price( 'min', true );
$min_var_sale_price = $product->get_variation_sale_price( 'min', true );
 
// 2. New $price

if ( $sales_price != null ) {
$price = sprintf( __( 'A partir de: <del>%1$s</del>%2$s', 'woocommerce' ), wc_price( $min_var_reg_price ), wc_price( $min_var_sale_price ) );
} else {
$price = sprintf( __( 'A partir de: %1$s', 'woocommerce' ), wc_price( $min_var_reg_price ) );
}
