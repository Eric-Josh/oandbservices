<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"> -->
<style>
div.stars {
  width: 270px;
  display: inline-block;
  
}

input.star { display: none; }

label.star {
  float: right;
  padding: 5px;
  font-size: 30px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

/* label.star:hover { transform: rotate(-15deg) scale(1.3); } */

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers Reviews & Ratings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg">

                <div class="card-columns">
                    @php $i=0; @endphp
                    @foreach($reviews as $review)
                        <div class="card " style="color:#000000; font-size: 15px;">
                            <div class="card-body" >
                                <h4 class="card-title"><b>{{ $review->user->name }}</b><br>{{ $review->created_at->format('d/m/Y') }}</h4>
                                <p>
                                <div class="stars" >
                                <fieldset id="{{'group'.$i}}">
                                    <input class="star star-5"  type="radio"  value="5" {{ $review->stars == 5 ? 'checked' : '' }} disabled/>
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4"  type="radio"  value="4" {{ $review->stars == 4 ? 'checked' : '' }} disabled/>
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3"  type="radio"  value="3" {{ $review->stars == 3 ? 'checked' : '' }} disabled/>
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2"  type="radio"  value="2" {{ $review->stars == 2 ? 'checked' : '' }} disabled/>
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1"  type="radio"  value="1" {{ $review->stars == 1 ? 'checked' : '' }} disabled/>
                                    <label class="star star-1" for="star-1"></label>
                                </fieldset>
                                </div>
                                </p>
                                <p class="card-text">{{ $review->comments }}<p>
                            </div>
                        </div>
                    @php $i++; @endphp
                    @endforeach
                </div>

                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</x-app-layout>