<?php
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_51JlCw9GVC5CV6peYkLETbPaoHRsmiQwqb49NMqCvYtDgw1Hccl7Cj3C94hA7cVVoFELZKS1zlQrbWGcQBINVORob009x7AsMVc');

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
      'price_data' => [
        'currency' => 'usd',
        'product_data' => [
          'name' => 'T-shirt',
        ],
        'unit_amount' => 2000,
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'https://example.com/success',
    'cancel_url' => 'https://example.com/cancel',
  ]);


?>

<html>
  <head>
    <title>Buy cool new product</title>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <button id="checkout-button">Checkout</button>
    <script>
        var stripe = Stripe('pk_test_51JlCw9GVC5CV6peYvHPuJUhLHKVT1YDwgnp2kWJmN6AijkFfkMSMbDgNLKet6740rZW03K7rZIM7halSIYkJvh6d00OYLNTPPY');
        const btn = document.getElementById("checkout-button");
        btn.addEventListener("click", function(e){
            e.preventDefault();
            stripe.redirectToCheckout({
                sessionId: "<?php echo $session->id; ?>"
            });
        });
    </script>
  </body>
</html>