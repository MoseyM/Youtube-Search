@extends('layouts.app')

@section('title','Youtube Search')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <input id="search" onkeypress="return searchYoutube(event);" type="text" class="col-md-6 form-control" name="search" value="{{ session('searchTerm') ?? '' }}" placeholder="Search...">
        <div class="col-md-10 pt-3 row justify-content-center" id="result-box">
            @if(session()->has('searchResults'))
                @foreach(session('searchResults') as $index => $result)
                    <?php $snippet = $result->getSnippet(); ?>
                    <div class="col-sm-3 col-4 pb-1">
                        <img src="{{ $snippet->thumbnails->default->url }}" class="mx-auto d-block">
                        <p class="text-center"><a href="/view/{{ $index }}">{{ $snippet->title }}</a></p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

@push('extra-scripts')
    <script>
        function searchYoutube(event) {
            var inputField = $("input[name='search']");
            if(event.which == 13) {
                // if there is no input alert the user and do nothing else
                if(inputField.val().length == 0) {
                    alert("You're missing a search term.");
                    return false
                }

                //make API call
                $.ajax({
                    method: 'GET', 
                    url: '/search', 
                    data: {'term' : inputField.val()}, 
                    beforeSend: function(xlr) {
                        $('#result-box').html('<i id="makeitshine" class="fas fa-spinner fa-spin"></i>')
                    },
                    success: function(response){ 
                        var resultBox =  $('#result-box');
                        response.map(function(current, index, f) {
                            //create a new div element
                            var t = $("<div class='col-sm-3 col-4 pb-1'>");
                            //create an image element
                            const img = $("<img class='mx-auto d-block'>");
                            img.attr('src',current.snippet.thumbnails.default.url);
                            //create p elem for title
                            const p = $("<p class='text-center'>")
                            //create and append link to p elem
                            $("<a href='/view/"+index+"'></a>").text(current.snippet.title).appendTo(p)
                            //append image and p to div
                            t.append(img)
                            t.append(p)
                            //remove the loader spinner to prevent complete from deleting all results.
                            var elem = document.getElementById('makeitshine');
                            if(elem) {
                                elem.remove();
                            }
                            //append div to result box
                            resultBox.append(t)
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // logging errors 
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    },
                    complete: function(xlr) {
                        var elem = document.getElementById('makeitshine');
                        if(elem) {
                            elem.remove();
                        }
                    }
                });
            }
        }
    </script>
@endpush