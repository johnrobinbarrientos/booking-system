<form class="w-full">
    @csrf
    <div class="intro-y box p-5">
        <div class="p-5">
            <fieldset class="flex w-full">
                <div class="w-1/2 mr-4">
                    <h2 class="text-xl text-primary">User Details</h2>
                    <div class="flex flex-col pt-4">
                        <label for="">Name </label>
                        <input wire:model="user.name" type="text" name="name" class="form-control">
                        @error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="flex flex-col pt-4">
                        <label for="">Email</label>
                        <input wire:model="user.email" type="text" name="email" class="form-control" >
                        @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="relative mt-2 col-span-4">
                        <label for="">Password </label>
                        <input type="{{ $visible ? 'text': 'password'}}" wire:model="password" name="password" class="form-control">
                        @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button @class(['absolute inset-y-0 right-0 pr-3 inline-flex items-center mt-4', 'hidden' => $visible]) wire:click="$toggle('visible')">
                        <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M8.137 15.147c-.71-.857-1.146-1.947-1.146-3.147 0-2.76 2.241-5 5-5 1.201 0 2.291.435 3.148 1.145l1.897-1.897c-1.441-.738-3.122-1.248-5.035-1.248-6.115 0-10.025 5.355-10.842 6.584.529.834 2.379 3.527 5.113 5.428l1.865-1.865zm6.294-6.294c-.673-.53-1.515-.853-2.44-.853-2.207 0-4 1.792-4 4 0 .923.324 1.765.854 2.439l5.586-5.586zm7.56-6.146l-19.292 19.293-.708-.707 3.548-3.548c-2.298-1.612-4.234-3.885-5.548-6.169 2.418-4.103 6.943-7.576 12.01-7.576 2.065 0 4.021.566 5.782 1.501l3.501-3.501.707.707zm-2.465 3.879l-.734.734c2.236 1.619 3.628 3.604 4.061 4.274-.739 1.303-4.546 7.406-10.852 7.406-1.425 0-2.749-.368-3.951-.938l-.748.748c1.475.742 3.057 1.19 4.699 1.19 5.274 0 9.758-4.006 11.999-8.436-1.087-1.891-2.63-3.637-4.474-4.978zm-3.535 5.414c0-.554-.113-1.082-.317-1.562l.734-.734c.361.69.583 1.464.583 2.296 0 2.759-2.24 5-5 5-.832 0-1.604-.223-2.295-.583l.734-.735c.48.204 1.007.318 1.561.318 2.208 0 4-1.792 4-4z"/></svg>
                    </button>
                    <button @class(['absolute inset-y-0 right-0 pr-3 inline-flex items-center mt-4', 'hidden' => ! $visible]) wire:click="$toggle('visible')">
                        <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>
                    </button>
                    </div> 
                    <div class="mt-2">
                        <button type="button" wire:click="generatePassword" class="h-full inline-flex items-center px-4 py-2 btn btn-dark btn-sm">Generate Password</button>
                    </div>

                    <div class="flex flex-col pt-4">
                        <label for="">Password Confirm 
                       </label>
                        <input wire:model="password_confirmation" type="password" name="password_confirmation" class="form-control">
                        @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
            </fieldset>
        </div>

    </div>
    <div class="flex flex-col md:flex-row gap-2 mt-5">
        <a href="{{route('projects.index')}}"
            class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
        <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
    </div>
</form>
