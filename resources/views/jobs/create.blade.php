<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Job Post') }}
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

                            <form method="POST" action="{{ route('jobs.store') }}" id="job-form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="jobtype" class="labels">What would you like to have done?</label>
                                    <select class="custom-select block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring 
                                        focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                        name="jobtype" required >
                                        <option selected>Choose a trade</option>
                                        @foreach ($jobtypes as $jobtype)
                                        <option value="{{ $jobtype->id }}" {{old('jobtype')==$jobtype->id ? 'selected':'' }}>{{ $jobtype->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label for="description" class="labels ">Describe Job in details</label>
                                            <textarea class="form-control description block mt-1 w-full border-gray-300 focus:border-indigo-300 
                                            focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                            rows="5" id="desc" name="description"  required >{{old('description')}}</textarea> 
                                            <p id="jb-details"></p>                                         
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-5">
                                        <h6><b>What makes a good job description</b></h6>
                                        <ul>
                                            <li>Include the size and the scope of the work</li>
                                            <li>Or, describe the problem you're experiencing</li>
                                            <li>Have you already bought materials, or do you want the tradesperson to supply them? (if applicable)</li>
                                        </ul>
                                    </div>
                                </div>
                                 

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
                                </div> 
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="budget" class="labels">How much is your budget?</label>
                                            <input type="text" class="form-control block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                                            focus:ring-opacity-50 rounded-md shadow-sm" id="amount" name="amount" value="{{old('amount')}}" required />
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="labels">Phone Number </label>
                                            <input type="text" class="form-control block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                                            focus:ring-opacity-50 rounded-md shadow-sm" id="phone" name="phone" value="{{old('phone')}}" required />
                                        </div> 
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title" class="labels">Give your job a name (title) </label>
                                            <input type="text" class="form-control block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                                            focus:ring-opacity-50 rounded-md shadow-sm" id="jobtitle" name="jobtitle" value="{{old('jobtitle')}}" required />
                                        </div> 
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="location" class="labels">Location </label>
                                            <input type="text" class="form-control block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                                            focus:ring-opacity-50 rounded-md shadow-sm" id="location" name="location" value="{{old('location')}}" required />
                                        </div> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="photo" class="labels">Add a photo </label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">
                                                Browse… <input type="file"  id="gallery-photo-add" name="file[]" accept="image/*" multiple />
                                            </span>
                                        </span>
                                    </div>
                                    <div class="gallery" id="gallery"></div>
                                </div> 
                                
                                <div class="flex items-center justify-end mt-4">
                                    <x-jet-button class="ml-4">
                                        {{ __('Submit') }}
                                    </x-jet-button>
                                </div>
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

    $('#jb-details').text('At least 30 characters please');

    $('#desc').keyup(function(){
        var char = $(this).val();
        if (char.length > 0 ){
            $('#jb-details').text(char.length+' Character(s) written.')
        }
        
    });

    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img style="height: 200px; width: 200px; padding-right: 5px;" class="img-thumbnail inline">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    
    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});
</script>