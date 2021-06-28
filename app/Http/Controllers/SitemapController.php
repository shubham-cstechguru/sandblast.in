<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Model\ProductModel as Product;

class SitemapController extends BaseController {
    public function index(Request $request) {
        // Send the headers
        header('Content-type: text/xml');
        header('Pragma: public');
        header('Cache-control: private');
        header('Expires: -1');
        
        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        
        $xml .= '<url>
              <loc>'.url('/').'</loc>
              <priority>1.00</priority>
            </url>';
            
        $products = Product::where('product_is_deleted', 'N')->get();
        
        foreach( $products as $p ) {
            $xml .= '<url>
              <loc>'.url('product/'.$p->product_slug).'</loc>
              <priority>1.00</priority>
            </url>';
        }
        
        $xml .= '</urlset>';
        
        $filename = 'public/sitemap.xml';
        
        $file     = fopen($filename,"w") or exit("Unable to open file!");
        file_put_contents($filename, $xml);
        
        fclose($file);
    }
}
