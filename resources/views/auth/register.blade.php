<x-app-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        <!-- Iamge -->
        <div class="mt-4">
            <x-input-label for="image" :value="__('Image')" />
            <x-text-input id="image" class="block mt-1 w-full border p-4 " type="file" name="image" :value="old('image')" required autocomplete="image" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select onchange="getRole(this)" name="role" id="role" class="border-gray-300 block mt-1 w-full border  focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option>Choisir un rôle</option>
                @foreach ($roles as $role)
                <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
        <!-- Section -->
        <div class="mt-4" id="section" style="display: none;">
            <x-input-label for="section" :value="__('Section')" />
            <x-text-input type="text" name="section" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            <x-input-error :messages="$errors->get('section')" class="mt-2" />
        </div>

        <!-- Profession -->
        <div class="mt-4" id="profession" style="display: none;">
            <x-input-label for="profession" :value="__('Profession')" />
            <x-text-input type="text" name="profession" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            <x-input-error :messages="$errors->get('profession')" class="mt-2" />
        </div>
        <!-- Admin Role -->
        <div class="mt-4" id="adminrole" style="display: none;">
            <x-input-label for="adminrole" :value="__('Admin Role')" />
            <select name="adminrole" id="adminrole" class="border-gray-300 block mt-1 w-full border  focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option>Choisir un rôle</option>
                @foreach ($adminroles as $role)
                <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('adminrole')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>


<script>
    function getRole(select) {
        var role = select.value;
        if (role == "Student") {
            // section
            var sectionDiv = document.getElementById('section');
            sectionDiv.style.display = 'block';
        } else {
            var sectionDiv = document.getElementById('section');
            sectionDiv.style.display = 'none';
        }
        if (role == "Enseignant") {
            // profession
            var professionDiv = document.getElementById('profession');
            professionDiv.style.display = 'block';

        } else {
            var professionDiv = document.getElementById('profession');
            professionDiv.style.display = 'none';
        }
        if (role == "Admin") {
            // adminrole
            var adminroleDiv = document.getElementById('adminrole');
            adminroleDiv.style.display = 'block';
        } else {
            var adminroleDiv = document.getElementById('adminrole');
            adminroleDiv.style.display = 'none';
        }

    }

</script>
