<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Cart;

class MyFunctionTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
    public function test_calculateTotalPrice()
    {
        $cart = new ShoppingCart();
        $cart->addItem(['price' => 10]);
        $cart->addItem(['price' => 15]);
        $totalPrice = $cart->calculateTotalPrice();

        $this->assertEquals(25, $totalPrice);
    }

    public function testAddToCart()
    {
        // Create a user and authenticate (if necessary) for the test
        $user = factory(\App\User::class)->create();
        $this->actingAs($user);

        // Create a product for testing
        $product = factory(Product::class)->create();

        // Send a POST request to the addToCart method
        $response = $this->post('/addToCart', [
            'slug' => $product->slug,
            // Add any other required data for the test
        ]);

        // Assert that the response contains a success message
        $response->assertSessionHas('success', 'Product successfully added to cart');

        // Assert that the cart contains the added product
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            // Add any other conditions that need to be checked
        ]);
    }
}
