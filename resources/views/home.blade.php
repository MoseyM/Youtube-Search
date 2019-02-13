@extends('layouts.app')

@section('title','Youtube Search')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <input id="search" onkeypress="return searchYoutube(event);" type="text" class="col-md-6 form-control" name="search" placeholder="Search...">
        <div class="col-md-10 row justify-content-center" id="result-box"></div>
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
                            //create a new element
                            var t = document.createElement('div');
                            t.classname = 'col-4';
                            //add thumbnail
                            //add title
                            t.classname = 'col-4';
                            t.innerHTML = "<a href='/video/${current.id.videoId}'>${current.snippet.title}</a>";
                            console.log(t)
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