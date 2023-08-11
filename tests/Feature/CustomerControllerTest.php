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
     * @test lister the customers(clients)
     */
    public function itlistsCustomers()
    {
        $this->seed();
        $response = $this->get('/api/customers');

        $response->assertOk();
        $this->assertCount(10, $response->json('data'));
        $this->assertNotNull($response->json('data')[0]['tel']);
    }


    /**
     *
     * @test creation
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

        $response->assertStatus(201);
        $this->assertEquals(1, $customers->count());
        $this->assertEquals('Mon premier client', $customer->name);
    }

    /**
     *
     * @test validate fields
     */
    public function itValidatesFields()
    {
        $response = $this->post('/api/customers',[
            'name' => '',
            'tel' => '',
            'is_favorite' => ''
        ]);
        
        $response->assertSessionHasErrors((['name', 'tel']));
    }

     /**
     *
     * @test updatesCustomer
     */
    public function itUpdatesCustomer()
    {
        $this->seed(); 
        $customer = Customer::first();

        $response = $this->put('/api/customers/'. $customer->id, [
            'name' => 'Nom Editer',
            'tel' => '06XXXX',
            'is_favorite' => true
        ]);

        $updatedCustomer = Customer::find($customer->id);
        $response->assertOK();
        $this->assertEquals('Mon Editer', $updatedCustomer->name);
    }

    /**
     *
     * @test deletesCustomer
     */
    public function itDeletesCustomer()
    {
        $this->seed(); 
        $customer = Customer::first();

        $response = $this->delete('/api/customers/'. $customer->id);
        $response->assertNoContent();

        $this->assertEquals(16, Customer::count());
    }

}
