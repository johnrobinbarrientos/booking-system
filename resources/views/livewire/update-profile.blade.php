<form wire:submit.prevent="updateProfile" class="form-horizontal">
    @csrf
    @if ($successMessage)
        <div id="successAlert" class="alert alert-success-soft alert-dismissible show flex items-center mb-2" role="alert">
            {{ $successMessage }} 
            <button wire:model="removeSuccessMessage" type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div>
        <label for="name" class="form-label">Name</label>
        <input wire:model="name" type="text" name="name" class="form-control {{$errors->has('name')}}" placeholder="Name" autofocus
            autocomplete="name" required/>
            @if($errors->has('name'))
            <p class="text-red-500 ">{{$errors->first('name')}}
            </p>
            @endif
    </div>

    <div class="mt-3">
        <label for="email" class="form-label">E-mail Address</label>
        <input wire:model="email" type="email" name="email" id="email" class="form-control  {{$errors->has('email')}}"
            placeholder="E-mail Address" autocomplete="email" required/>
            @if($errors->has('email'))
            <p class="text-red-500">{{$errors->first('email')}}
            </p>
            @endif
        <div class="form-help">
        </div>
    </div>

    <div class="flex mt-4">
        <button class="btn btn-primary" type="submit">Update</button>
    </div>

</form>

