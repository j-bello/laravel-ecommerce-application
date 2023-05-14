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

        $this->brandRepositoryMock = Mockery::mock(BrandContract::class);
        $this->app->instance(BrandContract::class, $this->brandRepositoryMock);
    }


    /** @test */
    public function it_displays_create_brand_page()
    {
        $brandController = new BrandController($this->brandRepositoryMock);

        $response = $brandController->create();

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);

        $this->assertEquals('admin.brands.create', $response->getName());
    }

    /** @test */
    public function it_allows_brands_creation()
    {
        $brand = new Brand();

        $brand->name = 'Example Brand';
        $brand->slug = 'example-brand';
        $brand->logo = 'brand_logo.png';

        $brand->save();

        $this->assertEquals('Example Brand', $brand->name);
        $this->assertEquals('example-brand', $brand->slug);
        $this->assertEquals('brand_logo.png', $brand->logo);
    }


    /** @test */
    public function it_displays_edit_brand_page_with_brand_data()
    {
        $brand = new Brand();

        $brand->name = 'Example Brand2';
        $brand->slug = 'example-brand2';
        $brand->logo = 'brand_logo2.png';

        $brand->save();

        $this->brandRepositoryMock
            ->shouldReceive('findBrandById')
            ->once()
            ->with($brand->id)
            ->andReturn($brand);

        $brandController = new BrandController($this->brandRepositoryMock);

        $response = $brandController->edit($brand->id);

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);

        $this->assertEquals('admin.brands.edit', $response->getName());

        $this->assertEquals($brand, $response->getData()['brand']);
    }

    /** @test */
    public function it_updates_brand_data()
    {
        $data = [
            'name' => $this->faker->company,
            'slug' => $this->faker->slug,
            'logo' => $this->faker->imageUrl(200, 200, 'cats', true),
        ];
        $brand = Brand::create($data);

        $brand->name = 'Updated Brand';
        $brand->slug = 'updated-brand';
        $brand->logo = 'updated_logo.png';

        $brand->save();

        $this->assertEquals('Updated Brand', $brand->name);
        $this->assertEquals('updated-brand', $brand->slug);
        $this->assertEquals('updated_logo.png', $brand->logo);
    }
}
