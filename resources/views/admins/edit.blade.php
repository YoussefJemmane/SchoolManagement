<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Edit Un Admin") }}
        </h2>
    </x-slot>

    <div class="flex justify-center py-12 ">
        <div class="border rounded-md bg-white p-[20px]">
            <form method="POST" action="{{ route('admin.update',$admin->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" value="{{ $admin->name }}" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="email" value="{{ $admin->email }}" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Phone -->
                <div class="mt-4">
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" class="block w-full mt-1" type="text" name="phone" :value="old('phone')" required autocomplete="phone" value="{{ $admin->phone }}" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
                <!-- Iamge -->
                <div class="mt-4">
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input id="image" class="block w-full p-4 mt-1 bg-white border " type="file" name="image" :value="old('image')" required autocomplete="image" value="{{ $admin->image }}" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <!-- Admin Role -->
                <div class="mt-4" id="adminrole">
                    <x-input-label for="adminrole" :value="__('Admin Role')" />
                    <select name="adminrole" id="adminrole" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required >
                        <option>Choisir un rôle</option>
                        @foreach ($adminroles as $role)
                        <option value="{{ $role }}"
                            @if ($role == $admin->admins[0]->role)
                                selected
                            @endif
                        >{{ $role }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('adminrole')" class="mt-2" />
                </div>




                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">


                    <x-primary-button class="ms-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </form>

        </div>


    </div>
</x-app-layout>
