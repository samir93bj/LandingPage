<div
 class="flex flex-col bg-purple-900 h-screen" 
    x-data="{
        showSubscribe : @entangle('showSubscribe') ,
        showSuccess : @entangle('showSuccess')
        }">

        <nav class="pt-5 px-9 flex justify-between text-white">
            <a href="/" class="text-3xl font-bold">

                <x-application-logo
                    class="w-16 h-16 file-current fill-current">
                </x-application-logo>

            </a>
        
            <div class="flex justify-content-end">
                @auth
                    <a href="{{route('dashboard')}}">Dashboard</a>
                @else
                    <a href="{{route('login')}}">Login</a>
                @endauth
            </div>
        </nav>

        <div class="flex items-center container h-full md:container md:w-full">
            <div class="flex md:w-2/3 flex-col items-start">
                <h1 class="font-bold text-white text-5xl leading-tight mb-4">
                    Simple Generic Landing Page Subscribe
                </h1>
                <p class="text-indigo-200 text-xl mb-10">
                    We are just checking the <span class="font-bold underline">TALL</span>  stack.
                     Would you mind subscribing?
                </p>
                <x-button class="py-3 px-8 bg-red-500 hover:bg-red-600"  x-on:click="showSubscribe = true" >
                    Subscribe
                </x-button>
            </div>
        </div>

    <x-modal class="bg-pink-500" trigger="showSubscribe">
        <p class="text-white font-extrabold text-5xl text-center w-full mt-10">
            Lets do it! 
        </p>
 
        <form class="flex flex-col items-center p-24"
        wire:submit.prevent="subscribe">

            <x-input 
                class="px-5 py-3 w-80 border border-blue-400"
                type="email" 
                name="email" 
                placeholder="Email Address"
                wire:model.defer="email"
            ></x-input>

            <span class="text-gray-100 text-xs pt-1">
                {{
                    $errors->has('email') 
                    ? $errors->first('email')
                    : "We will send you a confirmation email."
                }}
            </span>

            <x-button class="px-5 py-3 mt-5 w-80 bg-blue-500 justify-center">
                <span class="animate-spin" wire:loading wire:target="subscribe">&#9696;</span>
                <span wire:loading.remove wire:target="subscribe">GET IN</span> 
            </x-button>
            
        </form>
    </x-modal>
 

{{--MODAL CONFIRMACION  --}}
    <x-modal class="bg-green-500" trigger="showSuccess">
        <p class="animate-pulse text-white font-extrabold text-9xl pt-3 text-center">
            &check; 
         </p>
         <p class="text-white font-extrabold text-5xl text-center mt-5">
             Great!
         </p>
        @if (request()->has('Verifed') && request()->Verifed == 1)
            <p class="text-white text-3xl text-center m-6">
                Thanks for confirming.
            </p>
        @else
            <p class="text-white text-3xl text-center m-6">
                See you in your inbox.
            </p>
        @endif
    </x-modal>
 
</div>  