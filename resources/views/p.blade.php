<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.50.2/dist/full.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="" x-data="{
    cards: [
        {
            title: 'PHP',
            deskripsi: 'Back-End Development',
            'img': 'https://img.icons8.com/officel/84/null/php-logo.png'
        },
        {
            title: 'Laravel',
            deskripsi: 'Back-End Development',
            'img': 'https://buildwithangga.com/themes/front/images/logo/laravel.svg'
        },
        {
            title: 'Laravel Livewire',
            deskripsi: 'Full-Stack Laravel',
            'img': 'https://laracasts.com/images/topics/icons/livewire-logo.svg'
        },
        {
            title: 'Git',
            deskripsi: 'Version Control',
            'img': 'https://laracasts.com/images/topics/icons/git-logo.svg'
        },
    ],
    cards2: [{
            title: 'MySQL',
            deskripsi: 'Database',
            'img': 'https://laracasts.com/images/topics/icons/mysql-logo.svg'
        },
        {
            title: 'Alpine JS',
            deskripsi: 'Front-End Development',
            'img': 'https://laracasts.com/images/topics/icons/alpine-logo.svg'
        },
        {
            title: 'React JS',
            deskripsi: 'Front-End Development',
            'img': 'https://laracasts.com/images/topics/icons/react-logo.svg'
        },
        {
            title: 'Inertia',
            deskripsi: 'Front-End Development',
            'img': 'https://laracasts.com/images/topics/icons/inertia-logo.svg'
        },
    ]

}">


    <nav class="">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center ">
                    <!-- Mobile menu button -->
                    <img class="h-16 lg:h-32 w-auto" src="/img/logo.png" alt="Workflow">

                </div>

                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0">
                        <img class="h-16 lg:h-32 w-auto hilang" src="/img/logo.png" alt="Workflow">
                    </div>

                </div>
                <div class="flex items-center">
                    <button
                        class="p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </button>
                    <label class="swap">
                        <input type="checkbox" />
                        <div class="swap-off btn bg-[#F8E305] text-hitam">WebDev</div>
                        <div class="swap-on btn bg-primary text-dilogo">MusicProd</div>
                    </label>


                </div>
            </div>
        </div>
        </div>

    </nav>


    <section class="py-16">
        <div class="flex justify-center items-center gap-3 px-3">
            <a x-intersect="$el.classList.add('fadeInUp')" target="_blank" href="https://instagram.com/aldiiimf"
                class="">
                <img src="/img/ig1.png" />
            </a>
            <a x-intersect="$el.classList.add('fadeInUp')" target="_blank" href="https://youtube.com/@ALdMFbeat"
                class="">
                <img src="/img/yt2.png" />
            </a>
            <a x-intersect="$el.classList.add('fadeInUp')" target="_blank" href="https://github.com/aldmf26"
                class="">
                <img src="/img/github1.png" />
            </a>
        </div>
        <div class="container flex items-center justify-center md:flex-row">
            <div class="lg:mx-28 text-center md:text-left">
                <div class="m-8 relative space-y-4">
                    <h2 class="lg:text-5xl text-3xl justify-center font-bold text-primary leading-tight mb-4"
                        x-intersect="$el.classList.add('fadeInUp')">Hi, I’m
                        FAhrizALdi</h2>
                    <p class="text-dilogo mb-8 text-2xl text-center" x-intersect="$el.classList.add('fadeInUp')">I Web
                        Developer and Music Producer</p>
                    <img src="/img/hero.png" alt="" class="" x-intersect="$el.classList.add('scale')">
                </div>
            </div>
        </div>
        <div class="box">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </section>

    {{-- skillll --}}
    <section class="py-10">
        <h1 class="text-center lg:text-2xl font-bold py-2" x-intersect="$el.classList.add('fadeInUp')">Technologies and
            tools I'm currently exploring<br> and interested about</h1>
        <hr class="my-5 mx-10 opacity-10 text-primary">
        <div class="mobileHilang">
            <div class="flex justify-center items-center gap-3 px-3">
                <template x-for="card in cards">
                    <div
                        class="bg-baju carousel_items dihover slide transition duration-200 transform hover:scale-105 hover:opacity-75 text-black rounded-lg shadow p-4 flex items-center">
                        <div class="w-auto rounded-full flex-shrink-0">
                            <img x-bind:src="card.img" class="imgCard"
                                x-intersect="$el.classList.add('scale')" />
                        </div>
                    </div>
                </template>

            </div>
            <div class="py-3 flex justify-center items-center gap-3 px-3">
                <template x-for="card in cards2">
                    <div
                        class="bg-baju carousel_items dihover slide transition duration-200 transform hover:scale-105 hover:opacity-75 text-black rounded-lg shadow p-4 flex items-center">
                        <div class="w-auto rounded-full flex-shrink-0">
                            <img x-bind:src="card.img" class="imgCard"
                                x-intersect="$el.classList.add('scale')" />
                        </div>
                    </div>
                </template>

            </div>
        </div>
        <div class="hilang">
            <div class="grid lg:grid-flow-col sm:grid-cols-3 gap-4 px-4 mt-2 carousel">
                <template x-for="card in cards">
                    <div
                        class="bg-baju carousel_items dihover slide transition duration-200 transform hover:scale-105 hover:opacity-75 text-black rounded-lg shadow p-4 flex items-center">
                        <div class="w-auto rounded-full flex-shrink-0">
                            <img x-bind:src="card.img" class="imgCard"
                                x-intersect="$el.classList.add('scale')" />
                        </div>
                        <div class="ml-4" x-intersect="$el.classList.add('fadeInUp')">
                            <h2 class="text-lg font-medium text-black-900"><span x-text="card.title"></span></h2>
                            <p x-text="card.deskripsi"></p>
                        </div>
                    </div>
                </template>

            </div>

            <div class="py-5 grid lg:grid-flow-col sm:grid-cols-3 gap-4 px-4 mt-2 carousel2">
                <template x-for="card in cards2">
                    <div
                        class="bg-baju carousel_items dihover slide transition duration-200 transform hover:scale-105 hover:opacity-75 text-black rounded-lg shadow p-4 flex items-center">
                        <div class="w-auto rounded-full flex-shrink-0">
                            <img x-bind:src="card.img" class="imgCard"
                                x-intersect="$el.classList.add('scale')" />
                        </div>
                        <div class="ml-4" x-intersect="$el.classList.add('fadeInUp')">
                            <h2 class="text-lg font-medium text-black-900"><span x-text="card.title"></span></h2>
                            <p x-text="card.deskripsi"></p>
                        </div>
                    </div>
                </template>

            </div>

        </div>
    </section>
    {{-- ----------- --}}

    <section class="py-10">
        <h1 class="text-center lg:text-2xl font-bold py-2">
            My Coding Projects
        </h1>
        <hr class="my-5 mx-10 opacity-10 text-primary">
        <div class="hilang">
            <div class="flex py-8 px-16">
                <div class="w-1/2 p-6">
                    <img x-intersect="$el.classList.add('fadeInUp')" class="shadow-sm rounded-lg"
                        src="img/upperclass.png" alt="Gambar dengan shadow dan glow">
                </div>
                <div class="w-1/2 p-6">
                    <h2 x-intersect="$el.classList.add('fadeInUp')" class="text-2xl font-bold mb-4 text-primary">
                        Upperclass Indonesia</h2>
                    <p x-intersect="$el.classList.add('fadeInUp')" class="text-secondary leading-relaxed">Aplikasi
                        E-Commerce untuk penjualan barang salon kecantikan dan sarang burung walet.</p>

                    <div x-intersect="$el.classList.add('fadeInUp')" class="flex">
                        <div class="w-1/2 p-6">
                            <p><i class="fa-regular fa-circle-check text-btnBg"></i> Laravel</p>
                            <p><i class="fa-regular fa-circle-check text-btnBg"></i> Jquery</p>
                        </div>
                        <div class="w-1/2 p-6">
                            <p><i class="fa-regular fa-circle-check text-btnBg"></i> Bootstrap</p>
                        </div>
                    </div>
                    <a href="https://upperclassindonesia.com/" target="_blank"
                        x-intersect="$el.classList.add('fadeInUp')"
                        class="leading-relaxed rounded hover:bg-primary bg-baju text-hitam border border-spacing-4 py-2 px-2"><i
                            class="fa-solid fa-link "></i> View Demo</a>
                </div>
            </div>
            <div class="flex py-8 px-16">
                <div class="w-1/2 p-6">
                    <img x-intersect="$el.classList.add('fadeInUp')" class="shadow-sm rounded-lg"
                        src="img/upperclass.png" alt="Gambar dengan shadow dan glow">
                </div>
                <div class="w-1/2 p-6">
                    <h2 x-intersect="$el.classList.add('fadeInUp')" class="text-2xl font-bold mb-4 text-primary">
                        Upperclass Indonesia</h2>
                    <p x-intersect="$el.classList.add('fadeInUp')" class="text-secondary leading-relaxed">Aplikasi
                        E-Commerce untuk penjualan barang salon kecantikan dan sarang burung walet.</p>

                    <div x-intersect="$el.classList.add('fadeInUp')" class="flex">
                        <div class="w-1/2 p-6">
                            <p><i class="fa-regular fa-circle-check text-btnBg"></i> Laravel</p>
                            <p><i class="fa-regular fa-circle-check text-btnBg"></i> Jquery</p>
                        </div>
                        <div class="w-1/2 p-6">
                            <p><i class="fa-regular fa-circle-check text-btnBg"></i> Bootstrap</p>
                        </div>
                    </div>
                    <a href="https://upperclassindonesia.com/" target="_blank"
                        x-intersect="$el.classList.add('fadeInUp')"
                        class="leading-relaxed rounded hover:bg-primary bg-baju text-hitam border border-spacing-4 py-2 px-2"><i
                            class="fa-solid fa-link "></i> View Demo</a>
                </div>
            </div>
        </div>
        <div class="mobileHilang">
            <div class="container flex items-center justify-center md:flex-row py-8">
                <div class="lg:mx-28 text-center md:text-left">
                    <div class="m-8 relative space-y-4">
                        <h2 x-intersect="$el.classList.add('fadeInUp')" class="text-2xl font-bold mb-4 text-primary">
                            Upperclass Indonesia</h2>
                        <img x-intersect="$el.classList.add('fadeInUp')" class="shadow-sm rounded-lg"
                            src="img/upperclass.png" alt="Gambar dengan shadow dan glow">
                        <p x-intersect="$el.classList.add('fadeInUp')" class="text-secondary leading-relaxed">Aplikasi
                            E-Commerce untuk penjualan barang salon kecantikan dan sarang burung walet. </p>
                    </div>
                    <div x-intersect="$el.classList.add('fadeInUp')" class="flex pb-5">
                        <div class="w-1/2">
                            <p><i class="fa-regular fa-circle-check text-btnBg"></i> Laravel</p>
                            <p><i class="fa-regular fa-circle-check text-btnBg"></i> Jquery</p>
                        </div>
                        <div class="w-1/2">
                            <p><i class="fa-regular fa-circle-check text-btnBg"></i> Bootstrap</p>
                        </div>
                    </div>
                    <a href="https://upperclassindonesia.com/" target="_blank"
                        x-intersect="$el.classList.add('fadeInUp')"
                        class="leading-relaxed rounded hover:bg-primary bg-baju text-hitam border border-spacing-4 py-2 px-2"><i
                            class="fa-solid fa-link "></i> View Demo</a>
                </div>
            </div>
            <div class="container flex items-center justify-center md:flex-row py-8">
                <div class="lg:mx-28 text-center md:text-left">
                    <div class="m-8 relative space-y-4">
                        <h2 x-intersect="$el.classList.add('fadeInUp')" class="text-2xl font-bold mb-4 text-primary">
                            Upperclass Indonesia</h2>
                        <img x-intersect="$el.classList.add('fadeInUp')" class="shadow-sm rounded-lg"
                            src="img/upperclass.png" alt="Gambar dengan shadow dan glow">
                        <p x-intersect="$el.classList.add('fadeInUp')" class="text-secondary leading-relaxed">Aplikasi
                            E-Commerce untuk penjualan barang salon kecantikan dan sarang burung walet.</p>
                    </div>
                    <div x-intersect="$el.classList.add('fadeInUp')" class="flex pb-5">
                        <div class="w-1/2">
                            <p><i class="fa-regular fa-circle-check text-btnBg"></i> Laravel</p>
                            <p><i class="fa-regular fa-circle-check text-btnBg"></i> Jquery</p>
                        </div>
                        <div class="w-1/2">
                            <p><i class="fa-regular fa-circle-check text-btnBg"></i> Bootstrap</p>
                        </div>
                    </div>
                    <a href="https://upperclassindonesia.com/" target="_blank"
                        x-intersect="$el.classList.add('fadeInUp')"
                        class="leading-relaxed rounded hover:bg-primary bg-baju text-hitam border border-spacing-4 py-2 px-2"><i
                            class="fa-solid fa-link "></i> View Demo</a>
                </div>
            </div>



        </div>


    </section>
    {{-- btn loadmore --}}
    <div style="margin-top: -50px;" class="pb-5 my-16 mx-16 flex items-center justify-center md:flex-row"
        x-intersect="$el.classList.add('fadeInUp')">
        <button class="btn btn-block btn-outline text-baju hover:bg-secondary">
            Load More
            <i class="fa-solid fa-angles-right ml-2"></i>
        </button>
    </div>

    <section class="py-10">
        <div class="hilang">
            <div class="pb-5 flex items-center justify-center md:flex-row"
                x-intersect="$el.classList.add('fadeInUp')">
                <div class=" max-w-4xl p-8 space-y-3 rounded-xl shadow-lg text-primary ">
                    <h1 class="font-bold text-1xl tracking-wide">Get In Touch</h1>
                    <p class="text-sm pt-2">What is your plan ? Call me</p>
                    <span class="font-bold text-sm"><i class="fa-solid fa-phone text-btnBg mr-3 mb-5 pt-2"></i> +62
                        895
                        4131 11053</span><br>
                    <span class="font-bold text-sm"><i class="fa-solid fa-map-location-dot text-btnBg mr-3 mb-5"></i>
                        Indonesia, Banjarmasin</span><br>
                    <span class="font-bold text-sm"><i class="fa-solid fa-paper-plane text-btnBg mr-3 mb-5"></i>
                        aldimf26@gmail.com</span><br>
                    <div class="flex items-center justify-center px-5">
                        <div>
                            <a x-intersect="$el.classList.add('fadeInUp')" target="_blank"
                                href="https://instagram.com/aldiiimf" class="">
                                <img src="/img/ig1.png" />
                            </a>
                        </div>
                        <div>
                            <a x-intersect="$el.classList.add('fadeInUp')" target="_blank"
                                href="https://youtube.com/@ALdMFbeat" class="">
                                <img src="/img/yt2.png" />
                            </a>
                        </div>
                        <div>
                            <a x-intersect="$el.classList.add('fadeInUp')" target="_blank"
                                href="https://github.com/aldmf26" class="">
                                <img src="/img/github1.png" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-baju p-8 space-y-8 w-1/2 rounded-xl shadow-lg text-black ml-5">
                    <h1 class="font-bold text-1xl tracking-wide">Contact Me</h1>
                    <form action="" class="flex flex-col space-y-4">
                        <div>
                            <label for="" class="text-1xl">Your Name</label>
                        </div>
                        <div>
                            <input placeholder="your name" type="text"
                                class="input input-bordered bg-primary w-full">
                        </div>
                        <div>
                            <label for="" class="text-1xl">Email Address</label>
                        </div>
                        <div>
                            <input placeholder="your email" type="text"
                                class="input input-bordered bg-primary w-full">
                        </div>
                        <div>
                            <label for="" class="text-1xl">Message</label>
                        </div>
                        <div>
                            <textarea class="textarea bg-primary w-full" placeholder="Message"></textarea>
                        </div>
                        <div>
                            <button class="btn text-primary btn-block float-right">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="mobileHilang">
            <div class="container flex items-center justify-center md:flex-row py-8">
                <div class="lg:mx-28 text-center md:text-left">
                    <div class=" max-w-4xl p-8 space-y-3 rounded-xl shadow-lg text-primary ">
                        <h1 class="font-bold text-1xl tracking-wide">Get In Touch</h1>
                        <p class="text-sm pt-2">What is your plan ? Call me</p>
                        <span class="font-bold text-sm"><i class="fa-solid fa-phone text-btnBg mr-3 mb-5 pt-2"></i>
                            +62
                            895
                            4131 11053</span><br>
                        <span class="font-bold text-sm"><i
                                class="fa-solid fa-map-location-dot text-btnBg mr-3 mb-5"></i>
                            Indonesia, Banjarmasin</span><br>
                        <span class="font-bold text-sm"><i class="fa-solid fa-paper-plane text-btnBg mr-3 mb-5"></i>
                            aldimf26@gmail.com</span><br>
                        <div class="flex items-center justify-center px-5">
                            <div>
                                <a x-intersect="$el.classList.add('fadeInUp')" target="_blank"
                                    href="https://instagram.com/aldiiimf" class="">
                                    <img src="/img/ig1.png" />
                                </a>
                            </div>
                            <div>
                                <a x-intersect="$el.classList.add('fadeInUp')" target="_blank"
                                    href="https://youtube.com/@ALdMFbeat" class="">
                                    <img src="/img/yt2.png" />
                                </a>
                            </div>
                            <div>
                                <a x-intersect="$el.classList.add('fadeInUp')" target="_blank"
                                    href="https://github.com/aldmf26" class="">
                                    <img src="/img/github1.png" />
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container flex items-center justify-center md:flex-row py-8">
                <div class="bg-baju w-full p-8 mx-4 rounded-xl shadow-lg text-black ml-5">
                    <h1 class="font-bold text-1xl tracking-wide">Contact Me</h1>
                    <form action="" class="flex flex-col space-y-4">
                        <div>
                            <label for="" class="text-1xl">Your Name</label>
                        </div>
                        <div>
                            <input placeholder="your name" type="text"
                                class="input input-bordered bg-primary w-full">
                        </div>
                        <div>
                            <label for="" class="text-1xl">Email Address</label>
                        </div>
                        <div>
                            <input placeholder="your email" type="text"
                                class="input input-bordered bg-primary w-full">
                        </div>
                        <div>
                            <label for="" class="text-1xl">Message</label>
                        </div>
                        <div>
                            <textarea class="textarea bg-primary w-full" placeholder="Message"></textarea>
                        </div>
                        <div>
                            <button class="btn text-primary btn-block float-right">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-8">
        <div class="hilang">
            <div
                class="w-full container flex items-center justify-center px-14 p-8 space-y-10 space-x-10 text-center  rounded-xl shadow-2xl text-black ml-5">
                <div class="space-y-8">
                    <div>
                        <h1 class="text-2xl text-primary">Favorite Quote <span class="text-secondary text-sm py-2">My
                                favorite motivational quote.</span> </h1>
                    </div>
                    <div>
                        <div class="w-full px-14 p-8 space-y-8 bg-baju rounded-xl shadow-2xl text-black ml-5">
                            <h2 class="text-2xl italic font-bold">"The best way to predict the future is to invent it."
                                <br> <span class="text-sm font-bold">(Cara terbaik untuk memprediksi masa depan adalah
                                    dengan menciptakannya )</span><br> <span class="underline">Alan Kay.</span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobileHilang">
            <div
                class="w-full container items-center justify-center px-14 p-8 space-y-10 space-x-10 text-center  rounded-xl shadow-2xl text-black">
                <div>
                    <h1 class="text-2xl text-primary">Favorite Quote <br> <span class="text-secondary text-sm py-2">My
                            favorite motivational quote.</span> </h1>
                </div>
            </div>
            <div class="p-4 text-center space-y-4 bg-baju rounded-xl shadow-2xl text-black mx-5">
                <h2 class="text-2xl italic font-bold">"The best way to predict the future is to invent it."
                    <br> <span class="text-sm font-bold space-y-0">(Cara terbaik untuk memprediksi masa depan adalah
                        dengan menciptakannya )</span><br> <span class="underline">Alan Kay.</span>
                </h2>
            </div>
        </div>
    </section>
</body>

</html>

