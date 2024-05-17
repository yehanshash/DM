<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MyFunctionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_calculateTotalPrice()
    {
        $cart = new ShoppingCart();
        $cart->addItem(['price' => 10]);
        $cart->addItem(['price' => 15]);
        $totalPrice = $cart->calculateTotalPrice();

        $this->assertEquals(25, $totalPrice);
    }

}
