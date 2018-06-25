@extends('layouts.master')

@section('title')
    Quotes - Home
@endsection

@section('styles')
		<link rel="stylesheet" type="text/css" href="{{ URL::to('font/font-awesome.min.css') }}">
@endsection

@section('content')
	@if(!empty(Request::segment(1)))
		<section class="filter-bar">
			Filter has been set! <a href="{{ route('index') }}">show all quotes</a>
		</section>
	@endif

	@if ($errors->any())
			<section class="info-box fail">
			    @foreach($errors->all() as $error)
						{{ $error }}			
				@endforeach	
			</section>
		@endif			
	<section class="quotes">

		@if(Session::has('success'))
			<section class="info-box success">
				{{ Session::get('success') }}
			</section>
		@endif

		@if( count($quotes) == "" )
			<section class="info-box fail">
			   No Quote
			</section>
		@else
			<h1>Latest Quotes</h1>
			@for($i=0; $i < count($quotes); $i++)
			<article class="quote">
				<div class="delete"><a href="{{ route('delete', ['quote_id' => $quotes[$i]->id]) }}">x</a></div>
				"{{ $quotes[$i]->quotes }}"
				<div class="info">created by 
					<a href="{{ route('index', ['writer' => $quotes[$i]->writer->name]) }}">{{ $quotes[$i]->writer->name }}</a> 
						on {{$quotes[$i]->created_at}}
				</div>
			</article>
		@endfor
		@endif
		<div class="pagination">
			@if($quotes->currentPage() !== 1)
				<a href="{{ $quotes->previousPageUrl() }}">Click to see previous</a>
			@endif
			@if($quotes->currentPage() !== $quotes->lastPage() && $quotes->hasPages())
				<a href="{{ $quotes->nextPageUrl() }}">Click to see next</a>
			@endif
		</div>
		
	</section>

	<section class="edit-quote">
		<h1>Add a Quote</h1>
		<form method="post" action="{{ route('create') }}">
			<div class="input-group">
				<label for="writer">Your Name</label>
				<input type="text" name="writer" id="writer" placeholder="Your Name">
			</div>
			<div class="input-group">
				<label for="quote">Your Quote</label>
				<textarea name="quote" id="quote" rows="5" placeholder="Quote"></textarea>
			</div>
			<button type="submit" class="btn">Submit Quote</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		</form>
	</section>

@endsection