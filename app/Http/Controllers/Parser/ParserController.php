<?php

namespace App\Http\Controllers\Parser;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\UrlCheck;

use App\Libraries\htmlParse;

use Auth;
use Flash;

use \Gajus\Dindent\Indenter as HTMLbeautifier;
//use Dompdf\Dompdf;
//use Dompdf\Options;
use App\Libraries\pdfcrowd;

class ParserController extends Controller
{
    public function template(){
        if (Auth::check()){
            $url = NULL;
            $summary = NULL;
            return view('parserview.template', compact('summary','url'));
        }
        
        else{
            
            flash()->error('Please login first');
            return redirect('/login');
        }
    }
    
    public function parseurl(UrlCheck $request){
        
        if(Auth::check()){
            $url = $request -> url;
            $pagedata=NULL;
            $parser = new htmlParse;
            try{
                if(!empty($parser)){
                    $html =  $parser -> file_get_html($url);
                
                    if (!empty($html)) {   
                        
                        $content = $html->find('body');
                        if (!empty($content)){
                            
                        foreach($html->find('html') as $element) {
                         $pagedata .=  $element;
                         
                            }
                            
                        }
                        
                        else{
                            flash()->error('Error! Parsing the URL content');
                        }
                    }
                    else{
                        flash()->error('URL does not return proper data');
                    }
             
                    $summary = utf8_encode($pagedata); // to remove the Byte Code from the parsed content
                    
                    $indenter = new HTMLbeautifier();       // HTML Beautifier https://packagist.org/packages/gajus/dindent
                    $summary = $indenter->indent($summary);
                  
                    /* Removed for optimization
                    $session = $request->session();
                    $session->put('summary',$summary);
                    */
                    
                    return view('parserview.template',compact('summary' , 'url'));  
            
            }
            else{
                 flash()->error('URL does not return proper data');
            }
            }
            catch (\Exception $e) {
                $url = NULL;
                $summary = NULL;
                //flash()->error(substr($e,0,150).'....');   // Commented to handle vulnerablities
                flash()->error('There is some issue in parsing the URL. Please try some other URL');
                return view('parserview.template',compact('summary' , 'url'));
            }
        }
        
        else{
            
            flash()->error('Please login first');
            return redirect('/login');
        }
    }
    
    public function download(Request $request){
          if(Auth::check()){
              // Removed for optimization
              //$session = $request ->session();
              //$summary = $session->get('summary');
              //$session->forget('summary');
              $url = $request -> downloadurl;
              $summary_modified = $request -> summary_text;
            try{
              
               // Commented and kept in case of rollback
              //$options = new Options();
              //$options->set('isRemoteEnabled', true);
              //$dompdf = new Dompdf($options);
              //$dompdf->loadHtml($summary);
              //$dompdf->render();
              //$dompdf->stream();
              
                $client = new Pdfcrowd("dheerajalim", env("PDF_CROWD_API"));
            
                // convert a web page and store the generated PDF into a $pdf variable
               
                if ($request->modifieddownload == "Yes"){
                    $pdf = $client->convertHtml($summary_modified);
                }
                else{
                    $pdf = $client->convertURI($url);
                }
                // set HTTP response headers
                header("Content-Type: application/pdf");
                header("Cache-Control: max-age=0");
                header("Accept-Ranges: none");
                header("Content-Disposition: attachment; filename=\"$url.pdf\"");
                         
                echo $pdf; // send the generated PDF 
        
            }
            
            catch (\Exception $e) {
               
               $summary = $request -> summary_text;
               flash()->error('There is some issue with the Parsed URL. Please try some other URL or try using http instead https');
               return view('parserview.template',compact('summary' , 'url'));
            }
            
     
          }
        
        else{
            
            flash()->error('Please login first');
            return redirect('/login');
        }
    }

}
