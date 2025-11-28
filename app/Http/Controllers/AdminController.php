<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;


class AdminController extends Controller
{

    public function index()
    {
        $brands = Brand::all();
        
        return Inertia::render('Admin/AdminPanel', [
            'brands' => $brands
        ]);
    }

    // Brand action 
    public function storeBrand(Request $request)
    {
        try{
            $data = $request->validate([
                'name' => 'required|string'
            ]);

            if(Brand::where('name', $data['name'])->exists()){
                return redirect()->back()->with('error', 'Бренд уже существует!');
            }

        Brand::create($data);
        return redirect()->back()->with('success', 'Бренд успешно создан!');
        
        }catch(ValidationException $e){
            return redirect()->back()
            ->with('error', 'Ошибка валидации: ' . implode(', ', $e->errors()['name']))
            ->withInput();
        }
        
    }
    public function deleteBrand($id){

       $currentBrand = Brand::find($id);
       if(!$currentBrand){

            return redirect()->back()->with('error', 'Бренд не найден!');

       }
       $currentBrand->delete();
       return redirect()->route('admin.adminpanel')->with('success', 'Бренд успешно удален!');

    }
    public function deleteAllBrands() {

        if(DB::table('brands')->exists()){

            DB::table('brands')->delete();
            return redirect()->back()->with('success', 'Все бренды были удалены!');
        }

        return redirect()->back()->with('error', 'Нету ни одного бренда!');
    }

        // Product action
    public function editProductPage(string $id)
    {
        $currentProduct = Product::with('brand')->find($id);
        $brands = Brand::all();

        return Inertia::render('products/EditProductPage', [
            'product' => $currentProduct,
            'brands' => $brands

        ]);
    }

    public function createProductPage(){
        $brands = Brand::all();
        return Inertia::render('Admin/CreateProductPage', [
            'brands' => $brands
        ]);
    }


    public function deleteProduct($id){
        $product = Product::findOrFail($id);

        if (!$product) {

            return redirect()->back()->with('error', 'Товар не найден');
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Товар успешно удален!');
    }

    public function updateProduct(Request $request, $id)
    {

        $currentproduct = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'size' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'brand_id' => 'required|exists:brands,id'
        ]);

        $currentproduct->update($data);

        return redirect()->route('product.show', $id)->with('success', 'Данные карточки успешно обновлены!');
    }

  public function storeProducts(Request $request){
    try{

    //     dd([
    //     'ВСЕ ДАННЫЕ' => $request->all(),
    //     'ФАЙЛЫ' => $request->allFiles(),
    //     'ЕСТЬ ФАЙЛ' => $request->hasFile('path_picture'),
    //     'ИНФО О ФАЙЛЕ' => $request->file('path_picture') ? [
    //         'имя' => $request->file('path_picture')->getClientOriginalName(),
    //         'размер' => $request->file('path_picture')->getSize(),
    //         'тип' => $request->file('path_picture')->getMimeType()
    //     ] : 'ФАЙЛА НЕТ'
    // ]);


      
        Log::info('=== FILE UPLOAD DEBUG ===');
        Log::info('Has file:', [$request->hasFile('path_picture')]);
        Log::info('File name:', $request->file('path_picture') ? 
            [$request->file('path_picture')->getClientOriginalName()] : ['no file']);

        $data = $request->validate([
            'name' => 'required|string',
            'size' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'path_picture' => 'required|image|mimes:jpeg,jpg,png|max:3064',
            'brand_id' => 'required|exists:brands,id'
        ]);

        Log::info('Validation passed');

        $file = $request->file('path_picture');

        $extension = $file->getClientOriginalExtension();
        
        $filename = uniqid() . '_' . time() . '.' . $extension;

        $file->move(public_path('uploads/products/'), $filename);

        $pathPicture = 'uploads/products/' . $filename;

        Log::info('File saved:', [$pathPicture]);
    
        Log::info('Creating product with filename:', [$pathPicture]);

        Product::create([
            'name' => $data['name'],
            'size' => $data['size'],
            'description' => $data['description'],
            'price' => $data['price'],
            'path_picture' => $pathPicture,
            'brand_id' => $data['brand_id']
        ]);

        Log::info('Product created successfully');

        return redirect()->route('admin.adminpanel')->with('success', 'Товар успешно создан!');

    } catch(\Exception $ex){
        Log::error('Product creation error: ' . $ex->getMessage());
        Log::error('Stack trace: ' . $ex->getTraceAsString());
        return redirect()->back()->with('error', "Произошла ошибка: " . $ex->getMessage())->withInput();
    }
}

}
