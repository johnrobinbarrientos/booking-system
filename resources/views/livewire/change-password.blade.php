<form wire:submit.prevent="changePassword" class="form-horizontal">
    @csrf
    @if ($successMessage)
        <div id="successAlert" class="alert alert-success-soft alert-dismissible show flex items-center mb-2" role="alert">
            {{ $successMessage }} 
            <button wire:model="removeSuccessMessage" type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
         </div>
    @endif
    <div class="mt-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" wire:model="password" class="form-control" />
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mt-3">
        <label for="password_confirmation" class="form-label">Confirm Password
        </label>
        <input type="password" wire:model="password_confirmation" class="form-control" />
        @error('password_confirmation')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex mt-4">
        <button class="btn btn-primary" type="submit">Update</button>
    </div>
</form>
