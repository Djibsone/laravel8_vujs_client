<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function itlistsCustomers()
    {
        $response = $this->get('/api/customers');

        $response->assertOk();
        $this->assertCount(10, $response->json('data'));
        $this->assertNotNull($response->json('data')[0]['tel']);
    }


    /**
     *
     * @test
     */
    public function itCreatesCutomer()
    {
        $response = $this->post('/api/customers',[
            'name' => 'Mon premier client',
            'tel' => '52XXXXXX',
            'is_favorite' => true
        ]);

        $customers = Customer::all();
        $customer = Customer::first();

        $response->assertOK();
        $this->assertEquals(1, $customers->count());
        $this->assertEquals('Mon premier client', $customer->name);
    }
}
