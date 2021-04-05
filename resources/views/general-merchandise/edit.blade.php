<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a  href="{{ route('gmerchandise') }}" data-toggle="tooltip" data-placement="bottom" title="View History">{{ __('Merchandise ') }} </a>{{ __(' - ') }}
        <a  href="{{ route('gmerchandise.show', $generalMerchandise->id) }}" data-toggle="tooltip" data-placement="bottom" title="View Job">{{ __($generalMerchandise->merchandise->merchandise) }} </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="content">
                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                            @endif

                            <form method="POST" action="{{ route('gmerchandise.update', $generalMerchandise->id) }}" id="gmerchandise-form" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="merchandise" class="labels">What would you like to have done?</label>
                                    <select class="custom-select block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring 
                                        focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="merchandise" required >
                                        <option selected>Choose a merchandise</option>
                                        @foreach ($merchandise as $merchandises)
                                        <option value="{{ $merchandises->id }}" {{ $generalMerchandise->merchandise_id == $merchandises->id ? 'selected' : '' }}>{{ $merchandises->merchandise }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="description" class="labels">Describe Job in details</label>
                                        <textarea class="form-control block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring 
                                            focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" rows="5" id="desc" name="description" 
                                            minlength="30" required >{{ $generalMerchandise->description }}</textarea>
                                        <span id="desc-notice" style="color:red"></span>
                                        <p>Include the size and the scope of the work</p>
                                        <p>At least 30 characters please</p>
                                        
                                    </div>
                                </div>
                                </div> 

                                <div class="form-group">
                                    <label for="timeframe" class="labels">When would you like the job to start?</label><br>
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="customRadio" name="time_frame" value="Ugently" 
                                            {{ $generalMerchandise->time_frame == 'Ugently' ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="customRadio">Ugently</label>
                                    </div>
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="customRadio2" name="time_frame" value="Within 24 hours" 
                                            {{ $generalMerchandise->time_frame == 'Within 24 hours' ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="customRadio2">Within 24 hours</label>
                                    </div> 
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="customRadio3" name="time_frame" value="Within 2 days" 
                                            {{ $generalMerchandise->time_frame == 'Within 2 days' ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="customRadio3">Within 2 days</label>
                                    </div>
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="customRadio4" name="time_frame" value="Within 2 weeks" 
                                            {{ $generalMerchandise->time_frame == 'Within 2 weeks' ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="customRadio4">Within 2 weeks</label>
                                    </div> 
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="customRadio5" name="time_frame" value="Within 1 month" 
                                            {{ $generalMerchandise->time_frame == 'Within 1 month' ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="customRadio5">Within 1 month</label>
                                    </div> 
                                </div> 
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description" class="labels">How much is your budget?</label>
                                            <input type="text" class="form-control block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring 
                                                focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" id="amount" name="amount" 
                                                value="{{ $generalMerchandise->amount }}" required />
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="labels">Phone Number </label>
                                            <input type="text" class="form-control block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring 
                                                focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" id="phone" name="phone" 
                                                value="{{ $generalMerchandise->phone }}" minlength="11" maxlength="11" required />
                                        </div> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="location" class="labels">Location </label>
                                    <input type="text" class="form-control block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring 
                                        focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" id="location" name="location"  
                                        value="{{ $generalMerchandise->location }}"  required />
                                </div> 

                                
                                    
                                </div> 
                                <button type="submit" class="btn btn-primary" id="post">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
  
</x-app-layout>
<script type="text/javascript">
    
$(function() {
    
    $('[data-toggle="tooltip"]').tooltip();
    
    $("form#job-form").submit(function(){

        // validate description
        if($('#desc').val().length < 30){
            $('#desc-notice').html('valid word count of 30 character min');
            return false;
        }else{
            $('#desc-notice').html();
            return true;
        }

    });
   
});
</script>