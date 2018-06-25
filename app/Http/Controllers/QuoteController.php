<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Writer;
use App\Quotes;

class QuoteController extends Controller
{
    public function getIndex($writer = null){
        if (!is_null($writer)) {

           $quote_writer = Writer::where('name', $writer)->first();
           if($quote_writer)
           {
                $quotes = $quote_writer->quotes()->orderBy('created_at', 'desc')->paginate(6);
           }
        }else{
                $quotes  = Quotes::orderBy('created_at', 'desc')->paginate(6);
            }

    	return view('index', ['quotes' => $quotes]);
    }

    public function postQuote(Request $request)
    {
    		$this->validate($request, [
    		'writer' => 'required|max:50|alpha',
    		'quote'	=> 'required|max:500'
    	]);

    	$writerText = ucfirst($request['writer']);
    	$quoteText = lcfirst($request['quote']);

    	$writer = Writer::where('name', $writerText)->first();

    	if (!$writer) {
    		$writer = new Writer();
    		$writer->name = $writerText;
    		$writer->save();
    	}

    	$quote = new Quotes();
    	$quote->quotes = $quoteText;
    	$writer->quotes()->save($quote);

    	return redirect()->route('index')->with([
    		'success' => 'Qoute saved!'
    	]);
    }

    public function getDeleteQuotes($quote_id)
    {
        $quote = Quotes::find($quote_id);
        $search_quote_id = $quote->id;
        $search_writer_id = $quote->writer_id;
        $same_writer_id = Quotes::where('writer_id', $search_writer_id)->get();

        $writer_deleted = false;

        if (count($same_writer_id) === 1 && $search_quote_id) {
            $quote->writer->delete();
            $writer_deleted = true;
        }

        $quote->delete();
        $msg = $writer_deleted ? 'Writer and quote deleted!' : 'Quote deleted!';

        return redirect()->route('index')->with([
            'success' => $msg
        ]);
    }
}
