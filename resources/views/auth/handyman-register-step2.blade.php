<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
        <span id="error"></span>

        <form method="POST" action="{{ route('handyman-register-step-2.update', auth()->user()->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
                                  
            <div >
                <x-jet-label for="phone" value="{{ __('Phone') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required />
            </div>
            <div class="mt-4">
                <x-jet-label for="profession" value="{{ __('Profession') }}" />
                <select  name="profession" id="profession" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required >
                    <option selected>Choose a Profession</option>
                    @foreach ($jobTypes as $jobType)
                    <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Address') }}" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
            </div>

            <div class="form-group mt-4" id="work-proof">
                <label for="photo" class="labels mt-4">Add snippets of your previous work </label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            <input type="file"  id="gallery-photo-add" name="file[]" accept="image/*" multiple />
                        </span>
                    </span>
                </div>
                <div class="gallery" id="gallery"></div>
            </div> 
           
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

           <div class="flex items-center justify-end mt-4">
         
                <x-jet-button class="ml-4" id="submit">
                    {{ __('Complete Registration') }}
                </x-jet-button>
            </div> 
        </form>

<script>
$(function(){

$('#work-proof').hide();
$('#profession').change(function(){
    if ($(this).val() == 4 || $(this).val() == 6 || $(this).val() == 5 || $(this).val() == 9)
    {
        $('#work-proof').show();
        $('#work-proof').attr('required',true);
    }else{
        $('#work-proof').hide();
    }
});

$('form').submit(function(){
    if ($('#work-proof').show() && $('#gallery-photo-add').val() === '')
    {
        $('#error').text('Proof of work is required');
        $('#error').css('color','red');
        return false;
    }else{
        $('#error').hide();
        return true;
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
    </x-jet-authentication-card>
</x-guest-layout>
