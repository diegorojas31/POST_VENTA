<div>
    <!-- Start Pricing Table Area -->
    <section id="pricing" class="pricing-table section">
        

            <div class="row">
                <!-- Pricing Card -->
                <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".4s">
                    <!-- Single Table -->
                    <div class="single-table">
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">Basic</h4>

                            <div class="price">
                                <h2 class="amount"><span class="currency">$</span>19<span class="duration">/month</span>
                                </h2>
                            </div>
                        </div>
                        <!-- End Table Head -->
                        <!-- Start Table Content -->
                        <div class="table-content">
                            <!-- Table List -->
                            <ul class="table-list">
                                <li>2 Cajas y +4 Usuarios</li>
                                <li>Inventario de Ventas</li>
                                <li>Ventas</li>
                                <li>Reportes</li>
                                <li class="disable">Inventario de Produccion</li>
                                <li class="disable">Facturacion Electronica</li>
                            </ul>
                            <!-- End Table List -->
                        </div>
                        <!-- End Table Content -->
 
                                @if (auth()->user()->subscribedToPrice('price_1OAkvWCvUGxvTXJ1RtXwCFjY', 'POST BASICO'))
                                    {{-- Suscrito --}}

                                    @if (auth()->user()->subscription('POST BASICO')->onGraceperiod())
                                        <x-secondary-button wire:click="resumeSubscription"
                                            wire:target="resumeSubscription" wire:loading.attr="disabled">
                                            <x-spinner size="4" wire:target="resumeSubscription" wire:loading />
                                            Reanudar
                                        </x-secondary-button>
                                    @else
                                        <x-danger-button wire:click="cancelSubscription"
                                            wire:target="cancelSubscription" wire:loading.attr="disabled">

                                            <x-spinner size="4" wire:target="cancelSubscription" wire:loading />

                                            Cancelar
                                        </x-danger-button>
                                    @endif
                                @else
                                    <x-button wire:click="newSubscription('price_1OAkvWCvUGxvTXJ1RtXwCFjY')"
                                        wire:target="newSubscription('price_1OAkvWCvUGxvTXJ1RtXwCFjY')"
                                        wire:loading.attr="disabled">

                                        {{-- Animacion de carga --}}
                                        {{-- <div class="justify-center" wire:target="newSubscription('price_1NuHBvDh3Rgs6haXp8bNG24q')"
                                                wire:loading>
                
                                                <div role="status">
                                                    <svg aria-hidden="true"
                                                        class="w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                            fill="currentFill" />
                                                    </svg>
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                
                                            </div> --}}
                                        <x-spinner size="4"
                                            wire:target="newSubscription('price_1OAkvWCvUGxvTXJ1RtXwCFjY')"
                                            wire:loading />
                                        Suscribirse
                                    </x-button>
                                @endif 
    

                        <p class="no-card">No credit card required</p>
                    </div>
                    <!-- End Single Table-->
                </div>
                <!-- Pricing Card -->
                <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".6s">
                    <!-- Single Table -->
                    <div class="single-table middle">
                        <span class="popular">Most Popular</span>
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">Exclusive</h4>

                            <div class="price">
                                <h2 class="amount"><span class="currency">$</span>49<span class="duration">/month</span>
                                </h2>
                            </div>
                        </div>
                        <!-- End Table Head -->
                        <!-- Start Table Content -->
                        <div class="table-content">
                            <!-- Table List -->
                            <ul class="table-list">
                                <li>8 Cajas y Usuario Ilimitado</li>
                                <li>Inventario de Ventas</li>
                                <li>Ventas</li>
                                <li>Reportes</li>
                                <li>Inventario de Produccion</li>
                                <li class="disable">Facturacion Electronica</li>
                            </ul>
                            <!-- End Table List -->
                        </div>
                        <!-- End Table Content -->
                        @if (auth()->user()->subscribedToPrice('price_1OAoBpCvUGxvTXJ183zp8PEy', 'POST BASICO'))
                        {{-- Suscrito --}}

                        @if (auth()->user()->subscription('POST BASICO')->onGraceperiod())
                            <x-secondary-button wire:click="resumeSubscription"
                                wire:target="resumeSubscription" wire:loading.attr="disabled">
                                <x-spinner size="4" wire:target="resumeSubscription" wire:loading />
                                Reanudar
                            </x-secondary-button>
                        @else
                            <x-danger-button wire:click="cancelSubscription"
                                wire:target="cancelSubscription" wire:loading.attr="disabled">

                                <x-spinner size="4" wire:target="cancelSubscription" wire:loading />

                                Cancelar
                            </x-danger-button>
                        @endif
                    @else
                        <x-button wire:click="newSubscription('price_1OAoBpCvUGxvTXJ183zp8PEy')"
                            wire:target="newSubscription('price_1OAoBpCvUGxvTXJ183zp8PEy')"
                            wire:loading.attr="disabled">

                            {{-- Animacion de carga --}}
                            {{-- <div class="justify-center" wire:target="newSubscription('price_1NuHBvDh3Rgs6haXp8bNG24q')"
                                    wire:loading>
    
                                    <div role="status">
                                        <svg aria-hidden="true"
                                            class="w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
    
                                </div> --}}
                            <x-spinner size="4"
                                wire:target="newSubscription('price_1OAoBpCvUGxvTXJ183zp8PEy')"
                                wire:loading />
                            Suscribirse
                        </x-button>
                    @endif 
                        <p class="no-card">No credit card required</p>
                    </div>
                    <!-- End Single Table-->
                </div>
                <!-- Pricing Card -->
                <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".8s">
                    <!-- Single Table -->
                    <div class="single-table">
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">Premium</h4>

                            <div class="price">
                                <h2 class="amount"><span class="currency">$</span>99<span class="duration">/month</span>
                                </h2>
                            </div>
                        </div>
                        <!-- End Table Head -->
                        <!-- Start Table Content -->
                        <div class="table-content">
                            <!-- Table List -->
                            <ul class="table-list">
                                <li>Cajas Ilimitadas y Usuario Ilimitado</li>
                                <li>Inventario de Ventas</li>
                                <li>Ventas</li>
                                <li>Reportes</li>
                                <li>Inventario de Produccion</li>
                                <li>Facturacion Electronica</li>
                            </ul>
                            <!-- End Table List -->
                        </div>
                        <!-- End Table Content -->
                        @if (auth()->user()->subscribedToPrice('price_1OAoEmCvUGxvTXJ1qjeIDTYJ', 'POST BASICO'))
                        {{-- Suscrito --}}

                        @if (auth()->user()->subscription('POST BASICO')->onGraceperiod())
                            <x-secondary-button wire:click="resumeSubscription"
                                wire:target="resumeSubscription" wire:loading.attr="disabled">
                                <x-spinner size="4" wire:target="resumeSubscription" wire:loading />
                                Reanudar
                            </x-secondary-button>
                        @else
                            <x-danger-button wire:click="cancelSubscription"
                                wire:target="cancelSubscription" wire:loading.attr="disabled">

                                <x-spinner size="4" wire:target="cancelSubscription" wire:loading />

                                Cancelar
                            </x-danger-button>
                        @endif
                    @else
                        <x-button wire:click="newSubscription('price_1OAoEmCvUGxvTXJ1qjeIDTYJ')"
                            wire:target="newSubscription('price_1OAoEmCvUGxvTXJ1qjeIDTYJ')"
                            wire:loading.attr="disabled">

                            {{-- Animacion de carga --}}
                            {{-- <div class="justify-center" wire:target="newSubscription('price_1NuHBvDh3Rgs6haXp8bNG24q')"
                                    wire:loading>
    
                                    <div role="status">
                                        <svg aria-hidden="true"
                                            class="w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
    
                                </div> --}}
                            <x-spinner size="4"
                                wire:target="newSubscription('price_1OAoEmCvUGxvTXJ1qjeIDTYJ')"
                                wire:loading />
                            Suscribirse
                        </x-button>
                    @endif 
                        <p class="no-card">No credit card required</p>
                    </div>
                    <!-- End Single Table-->
                </div>
            </div>
        
    </section>
    <!--/ End Pricing Table Area -->
    @if (session('error'))
        <div class="d-flex align-items-center" role="alert">
            {{ session('error') }}
            <button class="btn btn-dark" onclick="this.parentElement.style.display='none'">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

</div>
