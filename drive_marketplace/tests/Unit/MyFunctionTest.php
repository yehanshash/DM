<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Wishlist;

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
        
    }

    public function testAddToCart()
    {
        // Create a user and authenticate (if necessary) for the test
        $user = factory(\App\User::class)->create();
        $this->actingAs($user);

        // Create a product for testing
        $product = factory(Product::class)->create();

        // Send a POST request to the addToWishlist method
        $response = $this->post('/addToWishlist', [
            'slug' => $product->slug,
            // Add any other required data for the test
        ]);

        // Assert that the response contains a success message
        $response->assertSessionHas('success', 'Product successfully added to wishlist');

        // Assert that the cart contains the added product
        $this->assertDatabaseHas('wishlists',  [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }
}
