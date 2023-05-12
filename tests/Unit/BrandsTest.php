<?php

namespace Tests\Unit;

use App\Contracts\BrandContract;
use App\Http\Controllers\Admin\BrandController;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Mockery;
use Tests\TestCase;

class BrandsTest extends TestCase
{
    use WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the BrandContract instance
        $this->brandRepositoryMock = Mockery::mock(BrandContract::class);
        $this->app->instance(BrandContract::class, $this->brandRepositoryMock);
    }


    /** @test */
    public function it_displays_create_brand_page()
    {
        // Create an instance of the BrandController
        $brandController = new BrandController($this->brandRepositoryMock);

        // Call the create method
        $response = $brandController->create();

        // Assert that the response is an instance of Illuminate\View\View
        $this->assertInstanceOf(\Illuminate\View\View::class, $response);

        // Assert that the returned view is 'admin.brands.create'
        $this->assertEquals('admin.brands.create', $response->getName());
    }

    /** @test */
    public function it_allows_create_brands()
    {
        // Create a dummy brand
        $brand = new Brand();

        // Set the fillable attributes
        $brand->name = 'Example Brand';
        $brand->slug = 'example-brand';
        $brand->logo = 'brand_logo.png';

        // Save the brand
        $brand->save();

        // Assert that the attributes were saved correctly
        $this->assertEquals('Example Brand', $brand->name);
        $this->assertEquals('example-brand', $brand->slug);
        $this->assertEquals('brand_logo.png', $brand->logo);
    }


    /** @test */
    public function it_displays_edit_brand_page_with_brand_data()
    {
        // Create a dummy brand
        $brand = new Brand();

        // Set the fillable attributes
        $brand->name = 'Example Brand2';
        $brand->slug = 'example-brand2';
        $brand->logo = 'brand_logo2.png';

        // Save the brand
        $brand->save();
        // Mock the findBrandById method to return the dummy brand
        $this->brandRepositoryMock
            ->shouldReceive('findBrandById')
            ->once()
            ->with($brand->id)
            ->andReturn($brand);

        // Create an instance of the BrandController
        $brandController = new BrandController($this->brandRepositoryMock);

        // Call the edit method with the brand ID
        $response = $brandController->edit($brand->id);

        // Assert that the response is an instance of Illuminate\View\View
        $this->assertInstanceOf(\Illuminate\View\View::class, $response);

        // Assert that the returned view is 'admin.brands.edit'
        $this->assertEquals('admin.brands.edit', $response->getName());

        // Assert that the 'brand' variable is passed to the view and matches the dummy brand
        $this->assertEquals($brand, $response->getData()['brand']);
    }

    /** @test */
    public function it_updates_brand_data()
    {
        // Create a dummy brand
        $data = [
            'name' => $this->faker->company,
            'slug' => $this->faker->slug,
            'logo' => $this->faker->imageUrl(200, 200, 'cats', true),
        ];
        $brand = Brand::create($data);

        // Update the brand attributes
        $brand->name = 'Updated Brand';
        $brand->slug = 'updated-brand';
        $brand->logo = 'updated_logo.png';

        // Save the updated brand
        $brand->save();

        // Assert that the attributes were updated correctly
        $this->assertEquals('Updated Brand', $brand->name);
        $this->assertEquals('updated-brand', $brand->slug);
        $this->assertEquals('updated_logo.png', $brand->logo);
    }
}
