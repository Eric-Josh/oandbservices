<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Job Post') }}
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

                            <form method="POST" action="{{ route('jobs.update', $jobs->id) }}" id="job-form" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="jobtype" class="labels">What would you like to have done?</label>
                                    <select class="custom-select" name="jobtype" required >
                                        <option selected>Choose a trade</option>
                                        @foreach ($jobtypes as $jobtype)
                                        <option value="{{ $jobtype->id }}" {{ $jobs->job_id == $jobtype->id ? 'selected' : '' }}>{{ $jobtype->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <label for="description" class="labels">Describe Job in details</label>
                                        <textarea class="form-control" rows="5" id="desc" name="description" required >{{ $jobs->description }}</textarea>
                                        <span id="desc-notice" style="color:red"></span>
                                        <p>At least 30 characters please</p>
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
                                </div> 

                                <div class="form-group">
                                    <label for="timeframe" class="labels">When would you like the job to start?</label><br>
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="customRadio" name="time_frame" value="Ugently" {{ $jobs->time_frame == 'Ugently' ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="customRadio">Ugently</label>
                                    </div>
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="customRadio2" name="time_frame" value="Within 24 hours" {{ $jobs->time_frame == 'Within 24 hours' ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="customRadio2">Within 24 hours</label>
                                    </div> 
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="customRadio3" name="time_frame" value="Within 2 days" {{ $jobs->time_frame == 'Within 2 days' ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="customRadio3">Within 2 days</label>
                                    </div>
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" class="custom-control-input" id="customRadio4" name="time_frame" value="Within 2 weeks" {{ $jobs->time_frame == 'Within 2 weeks' ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="customRadio4">Within 2 weeks</label>
                                    </div> 
                                </div> 
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description" class="labels">How much is your budget?</label>
                                            <input type="text" class="form-control form-control" id="amount" name="amount" value="{{ $jobs->amount }}" required />
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="labels">Phone Number </label>
                                            <input type="text" class="form-control form-control" id="phone" name="phone" value="{{ $jobs->phone }}" required />
                                        </div> 
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title" class="labels">Give your job a name (title) </label>
                                            <input type="text" class="form-control form-control" id="jobtitle" name="jobtitle"  value="{{ $jobs->job_title }}"  required />
                                        </div> 
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="location" class="labels">Location </label>
                                            <input type="text" class="form-control form-control" id="location" name="location"  value="{{ $jobs->location }}"  required />
                                        </div> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="photo" class="labels">Add a photo </label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">
                                                Browse… <input type="file"  id="gallery-photo-add" name="file[]" accept="image" multiple  />
                                            </span>
                                        </span>
                                    </div>
                                    
                                    <div class="gallery" id="gallery">
                                    @if($jobs->photo !='' and $jobs->photo != null)
                                        @foreach(explode('|', $jobs->photo) as $photo) 
                                            <img src="/job-images/{{ $photo }}" id="avail-img" style="height: 200px; width: 200px; padding-right: 5px;" class="img-thumbnail inline" > 
                                        @endforeach
                                    @endif
                                    </div> 
                                </div> 
                                <button type="submit" class="btn btn-primary" id="post">Save</button>
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
    
    $("form#job-form").submit(function(){

        // validate description
        if($('#desc').val().length < 30){
            $('#desc-notice').html('valid word count of 30 character min');
            return false;
        }else{
            $('#desc-notice').html();
            return true;
        }

        // set file input to existing file if no upload
        if( $('#gallery-photo-add').val() == '' && $('img#avail-img').attr('src') !== '' ){

            $('#gallery-photo-add').val($('img#avail-img').attr('src')) ;
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