<?php
    // Step 1: Require the library from your Composer vendor folder
    require_once 'vendor/autoload.php';

    use MercadoPago\SDK;
    use MercadoPago\Customer;
    use MercadoPago\Payment;
    SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

    use MercadoPago\Preference;
    use MercadoPago\Item;
    
    $preference = new Preference();
    
    // Create the items
    $item = new Item();
    $item->title = "Test Product";
    $item->quantity = 1;
    $item->unit_price = 100;
    
    // Add the items to the preference
    $preference->items = array($item);
    
    // Define the back URLs
    $preference->back_urls = array(
        "success" => "https://www.your-site.com/success",
        "failure" => "https://www.your-site.com/failure",
        "pending" => "https://www.your-site.com/pending"
    );
    
    // Set auto return to "approved"
    $preference->auto_return = "approved";
    
    // Save the preference
    $preference->save();
    
    // Redirect the user to the MercadoPago checkout page
    header("Location: " . $preference->init_point);
    exit;
    
?>