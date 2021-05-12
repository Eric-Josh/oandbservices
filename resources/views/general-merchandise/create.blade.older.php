<link rel="stylesheet" type="text/css" href="{{ asset('css/multi-step-form.css') }}">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('General Merchandise - New Job Post') }}
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

                            <form method="POST" action="{{ route('gmerchandise.store') }}" id="gmerchandise-form" >
                                
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active lione">Job Type</li>
                                    <li class="litwo">Delivery Details</li>
                                </ul>
                                <!-- fieldsets -->
	                            <fieldset>
                                @csrf
                                    <div class="form-group">
                                        <label for="merchandise" class="labels">What would you like to have done?</label>
                                        <select class="custom-select block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 
                                            rounded-md shadow-sm" name="merchandise" required >
                                            <option selected>Choose a merchandise</option>
                                            @foreach ($merchandise as $merchandises)
                                            <option value="{{ $merchandises->id }}" {{old('merchandise')==$merchandises->id ? 'selected':'' }}>{{ $merchandises->merchandise }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="labels">Describe Job in details</label>
                                        <textarea class="form-control description block mt-1 w-full border-gray-300 focus:border-indigo-300 
                                                focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                                rows="5" id="desc" name="description" minlength="30" required >{{old('description')}}</textarea>
                                        <span id="desc-notice"></span>
                                        <p id="jb-details"></p>
                                        <p>Include the size and the scope of the work</p>
                                    </div>
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>

                                <fieldset>
                                    <div class="form-group">
                                        <label for="timeframe" class="labels">When would you like the job to start?</label><br>
                                        <div class="custom-control custom-radio ">
                                            <input type="radio" class="custom-control-input" id="customRadio" name="time_frame" value="Ugently" 
                                                {{ (old('time_frame') == 'Ugently') ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="customRadio">Ugently</label>
                                        </div>
                                        <div class="custom-control custom-radio ">
                                            <input type="radio" class="custom-control-input" id="customRadio2" name="time_frame" value="Within 24 hours"
                                                {{ (old('time_frame') == 'Within 24 hours') ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="customRadio2">Within 24 hours</label>
                                        </div> 
                                        <div class="custom-control custom-radio ">
                                            <input type="radio" class="custom-control-input" id="customRadio3" name="time_frame" value="Within 2 days"
                                                {{ (old('time_frame') == 'Within 2 days') ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="customRadio3">Within 2 days</label>
                                        </div>
                                        <div class="custom-control custom-radio ">
                                            <input type="radio" class="custom-control-input" id="customRadio4" name="time_frame" value="Within 2 weeks" 
                                                {{ (old('time_frame') == 'Within 2 weeks') ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="customRadio4">Within 2 weeks</label>
                                        </div> 
                                        <div class="custom-control custom-radio ">
                                            <input type="radio" class="custom-control-input" id="customRadio5" name="time_frame" value="Within 1 month" 
                                                {{ (old('time_frame') == 'Within 1 month') ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="customRadio5">Within 1 month</label>
                                        </div> 
                                    </div> 
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description" class="labels">How much is your budget?</label>
                                                <input type="text" class="form-control block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                                                    focus:ring-opacity-50 rounded-md shadow-sm" id="amount" name="amount" value="{{old('amount')}}" required />
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone" class="labels">Phone Number </label>
                                                <input type="text" class="form-control block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                                                    focus:ring-opacity-50 rounded-md shadow-sm" minlength="11" maxlength="11" id="phone" name="phone" value="{{old('phone')}}" required />
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="location" class="labels">Location </label>
                                        <input type="text" class="form-control block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                                            focus:ring-opacity-50 rounded-md shadow-sm" id="location" name="location" value="{{old('location')}}" required />
                                    </div> 

                                    <div class="flex items-center justify-end mt-4">
                                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                                        
                                        <x-jet-button class="ml-4 submit">
                                            {{ __('submit') }}
                                        </x-jet-button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
  
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="{{ asset('js/multi-step-form.js') }}"></script>
<!-- <script src="https://cdn.tiny.cloud/1/nz91pgequ1i4nogj6arnwzcz01gd4h5d43gbnj6pdvyfdzzx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
<!-- <script>
    tinymce.init({
        selector:'#desc'
    });
</script> -->

<script type="text/javascript">
$(function() {

    $('#jb-details').text('At least 30 characters please');

    $('#desc').keyup(function(){
        var char = $(this).val();
        if (char.length > 0 ){
            $('#jb-details').text(char.length+' Character(s) written.')
        }
    });

    // validate description
    $("form#job-form").submit(function(){
        if($('#desc').val().length < 30){
            $('#desc-notice').text('validate word count of 30 character');
        }else{
            $('#desc-notice').text();
        }
    });
    
});
</script>
