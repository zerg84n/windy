<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
  use Illuminate\Support\Facades\Storage;
  use Illuminate\Http\File;

class YmlController extends Controller
{
    //
    
    public function export_to_yml (Request $request){
        
     $date = \Carbon\Carbon::now()->format('d-m-Y');   
    $ids = collect($request->input('ids'))->values()->toArray();
    
    $dom = new \DOMDocument('1.0','UTF-8');
    $yml_catalog = $dom->appendChild($dom->createElement('yml_catalog')); 
    $yml_catalog->setAttribute('date',$date);
    
    $shop = $yml_catalog->appendChild($dom->createElement('shop'));
    $shop->appendChild($dom->createElement('name','WindyTech'));
    $shop->appendChild($dom->createElement('company','ООО "ВиндиТек"'));
     $shop->appendChild($dom->createElement('url','https://windytech.ru'));
    $currencies = $shop->appendChild($dom->createElement('currencies'));
    $currency = $currencies->appendChild($dom->createElement('currency'));
    $currency->setAttribute('id',"RUR");
    $currency->setAttribute('rate',"1");
    
    $categories = $shop->appendChild($dom->createElement('categories'));
    $categories_objects = \App\Category::all();
    foreach ($categories_objects as $category_object){
        $category = $categories->appendChild($dom->createElement('category'));
        $category->setAttribute('id',$category_object->id);
        $category->appendChild( 
                $dom->createTextNode($category_object->title)); 
    }
    
    $offers = $shop->appendChild($dom->createElement('offers'));
   
    $selected_products = \App\Product::whereIn('id',$ids)->get();
   
    foreach ($selected_products as $product ){
        
        $offer = $offers->appendChild($dom->createElement('offer'));
        $offer->setAttribute('id',$product->id);
         $offer->setAttribute('available','true');
         $offer->appendChild($dom->createElement('categoryId',$product->category->id));
         
        $offer->appendChild($dom->createElement('name',$product->title));
        $offer->appendChild($dom->createElement('url',  route('products-show', $product)));
        if ($product->getFirstMediaUrl('photos')){
            $offer->appendChild($dom->createElement('picture', url($product->getFirstMediaUrl('photos')) ));
        }
        
         $offer->appendChild($dom->createElement('pickup','true'));
         $offer->appendChild($dom->createElement('delivery','true'));
       if ($product->price_sale){
           $offer->appendChild($dom->createElement('price',$product->price_sale));
           $offer->appendChild($dom->createElement('oldprice',$product->price_original));
       } else {
         
           $offer->appendChild($dom->createElement('price',$product->price_original));
       }
        $description = $offer->appendChild($dom->createElement('description'));
        
       
               $description->appendChild( 
                $dom->createTextNode('<![CDATA['.strip_tags($product->description, '<h3><ul><li><p><br>').']]>')); 
               
        $offer->appendChild($dom->createElement('currencyId',"RUR"));
        
        $offer->appendChild($dom->createElement('vendor',$product->brand?$product->brand->title:'noname'));
        foreach ($product->values() as $value){                    
             $param =  $offer->appendChild($dom->createElement('param',$value->value));  
             $param->setAttribute('name',$value->property->title);    
        }
                                  
      if($product->products->count()>0){
            $ids_str = implode(',',$product->products->pluck('id')->toArray());
            $offer->appendChild($dom->createElement('rec',$ids_str));
      }
        
    }
  
   $dom->formatOutput = true;
   //$content = $dom->saveXML();
    $content = $dom->saveXML($dom->documentElement);
    $xml= str_replace(['&lt;','&gt;'],['<','>'], $content);
    Storage::disk('media')->delete('products.xml');
    Storage::disk('media')->put('products.xml', $xml);
   $url = Storage::disk('media')->url('products.xml');

        return $url;
    }
}
