<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

use CodeCommerce\Product;
use CodeCommerce\Tag;
use CodeCommerce\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller {

    private $productModel;

    /**
     * @param Product $productModel
     */
    public function __construct(Product $productModel){

        $this->productModel = $productModel;

    }

    /**
     * @return \Illuminate\View\View
     */
    public function index(){

        $products = $this->productModel->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * @param Category $category
     * @return \Illuminate\View\View
     */
    public function create(Category $category){

        $categories = $category->lists('name','id');

        return view('products.create', compact('categories'));

    }

    /**
     * @param Requests\ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\ProductRequest $request){

        $input = $request->all();

        $product = $this->productModel->fill($input);

        $product->save();

        $arrTags = explode(',',$input['tags']);

        // retira virgula ou espaços em branco entre virgulas EX Tag A, , Tag B,,,
        $arrTags = array_filter($arrTags);

        $arrAtc=[];
        foreach($arrTags as $tg){

            $tag = Tag::where('name', trim($tg))->first();

            //se nao existe cria e depois attacha
            if($tag===null){
                $tag = Tag::create(['name' => trim($tg)]);
            }

            $arrAtc[] = $tag->id;
        }

        if(count($arrAtc))
            $product->tags()->attach($arrAtc);

        return redirect()->route('products');
    }

    /**
     * @param $id
     * @param Category $category
     * @return \Illuminate\View\View
     */
    public function edit($id, Category $category){

        $categories = $category->lists('name','id');

        $product = $this->productModel->find($id);

        return view('products.edit',compact('product','categories'));

    }

    /**
     * @param Requests\ProductRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\ProductRequest $request, $id){

        $input = $request->all();

        $product = $this->productModel->find($id);

        $product->update($request->all());

        $arrTags = explode(',',$input['tags']);

        // retira virgula ou espaços em branco entre virgulas EX Tag A, , Tag B,,,
        $arrTags = array_filter($arrTags);

        $arrSync=[];
        foreach($arrTags as $tg){

            $tag = Tag::where('name', trim($tg))->first();
            //se nao existe cria e depois synca
            if($tag===null){
                $tag = Tag::create(['name' => trim($tg)]);
            }
            $arrSync[] = $tag->id;
        }

        $product->tags()->sync($arrSync);

        return redirect()->route('products');
    }
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id){

        $product = $this->productModel->find($id);

        //deleta todas as imagens relacionadas ao produto
        if(count($product->images)) {
            foreach ($product->images as $image) {
                if (file_exists(public_path() . '/uploads/' . $image->id . '.' . $image->extension)) {
                    Storage::disk('public_local')->delete($image->id . '.' . $image->extension);
                }
                $image->delete();
            }
        }

        //remove as tags do produto
        $product->tags()->detach();

        $product->delete();

        return redirect()->route('products');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function images($id){

        $product = $this->productModel->find($id);

        return view('products.images',compact('product'));

    }


    /**
     * @return \Illuminate\View\View
     */
    public function createImage($id){

        $product = $this->productModel->find($id);

        return view('products.create_image',compact('product'));
    }

    public function storeImage(Requests\ProductImageRequest $request, $id, ProductImage $productImage){

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $image = $productImage::create(['product_id'=>$id,'extension'=>$extension]);

        Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));

        return redirect()->route('products.images',['id'=>$id]);
    }

    public function destroyImage(ProductImage $productImage, $id){

        $image = $productImage->find($id);

        if(file_exists(public_path().'/uploads/'.$image->id.'.'.$image->extension)){
            Storage::disk('public_local')->delete($image->id.'.'.$image->extension);
        }

        $product = $image->product;
        $image->delete();

        return redirect()->route('products.images',['id'=>$product->id]);

    }
}
