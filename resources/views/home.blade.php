<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cybcraft | votre identité Numérique</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite('resources/css/app.css')


    <style>
        .height{
            height: 800px;
        }
    </style>
</head>
<body class="bg-white dark:bg-gray-900">
    <header>
        <input type="checkbox" name="hbr" id="hbr" class="hbr peer" hidden aria-hidden="true">
        <nav class="fixed z-20 w-full bg-white/80 dark:bg-gray-900/80 backdrop-blur navbar shadow-md shadow-gray-600/5 peer-checked:navbar-active md:relative md:bg-transparent dark:shadow-none">
            <div class="xl:container m-auto px-6 md:px-12">
                <div class="flex flex-wrap items-center justify-between gap-6 md:py-3 md:gap-0">
                    <div class="w-full flex justify-between lg:w-auto">
                        <a href="#" aria-label="logo" class="flex space-x-2 items-center">
                            <div aria-hidden="true" class="flex space-x-1">
                                <div class="h-4 w-4 rounded-full bg-gray-900 dark:bg-gray-200"></div>
                                <div class="h-6 w-2 bg-primary dark:bg-primaryLight"></div>
                            </div>
                            <span class="text-base font-bold text-gray-600 dark:text-white">Cybcraft</span>
                        </a>
                        <label for="hbr" class="peer-checked:hamburger block relative z-20 p-6 -mr-6 cursor-pointer lg:hidden">
                            <div aria-hidden="true" class="m-auto h-0.5 w-6 rounded bg-gray-900 dark:bg-gray-300 transition duration-300"></div>
                            <div aria-hidden="true" class="m-auto mt-2 h-0.5 w-6 rounded bg-gray-900 dark:bg-gray-300 transition duration-300"></div>
                        </label>
                    </div>
                    <div class="navmenu hidden w-full flex-wrap justify-end items-center mb-16 space-y-8 p-6 border border-gray-100 rounded-3xl shadow-2xl shadow-gray-300/20 bg-white dark:bg-gray-800 lg:space-y-0 lg:p-0 lg:m-0 lg:flex md:flex-nowrap lg:bg-transparent lg:w-7/12 lg:shadow-none dark:shadow-none dark:border-gray-700 lg:border-0">
                        <div class="text-gray-600 dark:text-gray-300 lg:pr-4">
                            <ul class="space-y-6 tracking-wide font-medium text-base lg:text-sm lg:flex lg:space-y-0">
                                <li>
                                    <a href="#" class="block md:px-4 transition hover:text-primary dark:hover:text-primaryLight">
                                        <span>Accueil</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="block md:px-4 transition hover:text-primary dark:hover:text-primaryLight">
                                        <span>Nos Tarifs</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="block md:px-4 transition hover:text-primary dark:hover:text-primaryLight">
                                        <span>Les Temoignages</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="block md:px-4 transition hover:text-primary dark:hover:text-primaryLight">
                                        <span>A Propos</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="w-full space-y-2 border-primary/10 dark:border-gray-700 flex flex-col -ml-1 sm:flex-row lg:space-y-0 md:w-max lg:border-l">
                            <a href="#" class="relative flex h-9 ml-auto items-center justify-center sm:px-6 before:absolute before:inset-0 before:rounded-full focus:before:bg-primary/10 dark:focus:before:bg-primaryLight/10 before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                                <span class="relative text-sm font-semibold text-primary dark:text-primaryLight">Commander</span>                    
                            </a>
                            <a href="{{Route('login')}}" class="relative flex h-9 ml-auto items-center justify-center sm:px-6 before:absolute before:inset-0 before:rounded-full before:bg-primary dark:before:bg-primaryLight before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                                <span class="relative text-sm font-semibold text-primary dark:text-primaryLight">Se Connecter</span>                    
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="pt-32 md:py-12 xl:container m-auto px-6 md:px-12">
        <div aria-hidden="true" class="absolute inset-0 my-auto w-96 h-32 rotate-45 bg-gradient-to-r from-primaryLight to-secondaryLight blur-3xl opacity-50 dark:opacity-20"></div>
        <div class="relative lg:flex lg:items-center lg:gap-12">
            <div class="text-center lg:text-left md:mt-12 lg:mt-0 sm:w-10/12 md:w-2/3 sm:mx-auto lg:mr-auto lg:w-6/12">
                <h1 class="text-gray-900 font-bold text-4xl md:text-6xl lg:text-5xl xl:text-6xl dark:text-white">Build in your way but with our experts <span class="text-primary dark:text-primaryLight">Support.</span></h1>
                <p class="mt-8 text-gray-600 dark:text-gray-300">Odio incidunt nam itaque sed eius modi error totam sit illum. Voluptas doloribus asperiores quaerat aperiam. Quidem harum omnis beatae ipsum soluta!</p>
                
                <div class="mt-12 flex gap-6 lg:gap-12 justify-between grayscale dark:grayscale-0">
                    <img src="./images/clients/airbnb.svg" class="h-8 sm:h-10 w-auto lg:h-12" alt="" />
                    <img src="./images/clients/ge.svg" class="h-8 sm:h-10 w-auto lg:h-12" alt="" />
                    <img src="./images/clients/coty.svg" class="h-8 sm:h-10 w-auto lg:h-12" alt="" />
                    <img src="./images/clients/microsoft.svg" class="h-8 sm:h-10 w-auto lg:h-12" alt="" />
                </div>
            </div>
            <div class="overflow-hidden w-full lg:w-7/12 lg:-mr-16">
                <img src="{{ asset('logo.png') }}" alt="project illustration" height="" width="">
            </div>
        </div>
    </div> 
                                    

    <div class="py-16">
        <div class="xl:container m-auto px-6 text-gray-600 dark:text-gray-300 md:px-12 xl:px-6">
            <h2 class="mb-12 text-center text-2xl font-bold text-gray-800 dark:text-white md:text-4xl">
            What's our customers say
            </h2>
            <div class="grid gap-8 md:grid-rows-2 lg:grid-cols-2">
            <div
                class="row-span-2 rounded-3xl border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-8 text-center shadow-2xl shadow-gray-600/10 dark:shadow-none"
            >
                <div class="flex h-full flex-col justify-center space-y-4 object-cover">
                <img
                    class="mx-auto h-20 w-20 rounded-full"
                    src="https://i.pinimg.com/originals/28/6b/03/286b03b2ad1c09bf52cbcc99a4dabba4.jpg"
                    alt="user avatar"
                    height="220"
                    width="220"
                    loading="lazy"
                />
                <p class="md:text-xl">
                    <span class="font-serif">"</span> Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Quaerat repellat perspiciatis excepturi est. Non ipsum iusto aliquam
                    consequatur repellat provident, omnis ut, sapiente voluptates veritatis cum deleniti
                    repudiandae ad doloribus. <span class="font-serif">"</span>
                </p>
                <div>
                    <h6 class="text-lg font-semibold leading-none">Jane Doe</h6>
                    <span class="text-xs text-gray-500">Product Designer</span>
                </div>
                </div>
            </div>

            <div class="rounded-3xl sm:flex sm:space-x-8 border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-8 text-center shadow-2xl shadow-gray-600/10 dark:shadow-none">
                <img
                class="mx-auto h-20 w-20 rounded-full"
                src="https://i.pinimg.com/originals/28/6b/03/286b03b2ad1c09bf52cbcc99a4dabba4.jpg"
                alt="user avatar"
                height="220"
                width="220"
                loading="lazy"
                />
                <div class="mt-4 space-y-4 text-center sm:mt-0 sm:text-left">
                <p >
                    <span class="font-serif">"</span> Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Quaerat repellat perspiciatis excepturi est. Non ipsum iusto aliquam
                    consequatur repellat provident, omnis ut, sapiente voluptates veritatis cum deleniti
                    repudiandae ad doloribus. <span class="font-serif">"</span>
                </p>
                <div>
                    <h6 class="text-lg font-semibold leading-none">Jane Doe</h6>
                    <span class="text-xs text-gray-500">Product Designer</span>
                </div>
                </div>
            </div>
            <div class="rounded-3xl sm:flex sm:space-x-8 border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-8 text-center shadow-2xl shadow-gray-600/10 dark:shadow-none">
                <img
                class="mx-auto h-20 w-20 rounded-full"
                src="https://i.pinimg.com/originals/28/6b/03/286b03b2ad1c09bf52cbcc99a4dabba4.jpg"
                alt="user avatar"
                height="220"
                width="220"
                loading="lazy"
                />
                <div class="mt-4 space-y-4 text-center sm:mt-0 sm:text-left">
                <p>
                    <span class="font-serif">"</span> Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Quaerat repellat perspiciatis excepturi est. Non ipsum iusto aliquam
                    consequatur repellat provident, omnis ut, sapiente voluptates veritatis cum deleniti
                    repudiandae ad doloribus. <span class="font-serif">"</span>
                </p>
                <div>
                    <h6 class="text-lg font-semibold leading-none">Jane Doe</h6>
                    <span class="text-xs text-gray-500">Product Designer</span>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
                                    

    <footer>
        
        <div class="bg-gradient-to-b from-gray-100 to-transparent pt-1">
            <div class="container m-auto space-y-8 px-6 text-gray-600 dark:text-gray-400 md:px-12 lg:px-20">
            <div class="grid grid-cols-8 gap-6 md:gap-0">
                <div class="col-span-8 border-r border-gray-100 dark:border-gray-800 md:col-span-2 lg:col-span-3">
                <div
                    class="flex items-center justify-between gap-6 border-b border-white dark:border-gray-800 py-6 md:block md:space-y-6 md:border-none md:py-0"
                >
                    <img src="{{ asset('logo.png') }}" alt="logo tailus" width="100" height="42" class="w-32" />
                    <div class="flex gap-6">
                    <a href="#" target="blank" aria-label="github" class="hover:text-cyan-600">
                        <a href="" class="text-3xl link"><i class="fab fa-linkedin text-4xl text-blue-700"></i></a>
                        
                    </a>
                    <a href="#" target="blank" aria-label="twitter" class="hover:text-cyan-600">
                        <a href="" class="text-3xl link"><i class="fab fa-linkedin text-4xl text-blue-700"></i></a>
                    </a>
                    <a href="#" target="blank" aria-label="medium" class="hover:text-cyan-600">
                        <a href="" class="text-3xl link"><i class="fab fa-linkedin text-4xl text-blue-700"></i></a>
                    </a>
                    </div>
                </div>
                </div>
                <div class="col-span-8 md:col-span-6 lg:col-span-5">
                <div class="grid grid-cols-2 gap-6 pb-16 sm:grid-cols-3 md:pl-16">
                    <div>
                    <h6 class="text-lg font-medium text-gray-800 dark:text-gray-200">Company</h6>
                    <ul class="mt-4 list-inside space-y-4">
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">About</a>
                        </li>
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">Customers</a>
                        </li>
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">Enterprise</a>
                        </li>
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">Partners</a>
                        </li>
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">Jobs</a>
                        </li>
                    </ul>
                    </div>
                    <div>
                    <h6 class="text-lg font-medium text-gray-800 dark:text-gray-200">Products</h6>
                    <ul class="mt-4 list-inside space-y-4">
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">About</a>
                        </li>
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">Customers</a>
                        </li>
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">Enterprise</a>
                        </li>
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">Partners</a>
                        </li>
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">Jobs</a>
                        </li>
                    </ul>
                    </div>
                    <div>
                    <h6 class="text-lg font-medium text-gray-800 dark:text-gray-200">Ressources</h6>
                    <ul class="mt-4 list-inside space-y-4">
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">About</a>
                        </li>
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">Customers</a>
                        </li>
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">Enterprise</a>
                        </li>
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">Partners</a>
                        </li>
                        <li>
                        <a href="#" class="transition hover:text-cyan-600">Jobs</a>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="flex justify-between border-t border-gray-100 dark:border-gray-800 py-4 pb-8 md:pl-16">
                    <span>&copy; tailus 2003 - <span id="year"></span> </span>
                    <span>All right reserved</span>
                </div>
                </div>
            </div>
            </div>
        </div>
    </footer>


    <script>
        /*

        window.addEventListener('scroll', e => {
            const header = document.querySelector('#header_')
            e.preventDefault()
            header.classList.toggle('sticky-nav', window.scrollY > 0);
        })

        const toggleMobileMenu = document.querySelector('#hamburger')
        const navbar = document.querySelector('#navbar')

        toggleMobileMenu.addEventListener('click', e => {
            e.preventDefault()
            toggleMobileMenu.querySelector('#line').classList.toggle('rotate-45')
            toggleMobileMenu.querySelector('#line').classList.toggle('translate-y-1.5')

            toggleMobileMenu.querySelector('#line2').classList.toggle('-rotate-45')
            toggleMobileMenu.querySelector('#line2').classList.toggle('-translate-y-1')
            if (navbar.clientHeight === 0) {
                navbar.style.paddingTop = '20px'
                navbar.style.paddingBottom = '20px'
                navbar.style.height = `${parseInt(navbar.scrollHeight) + 60}px`
                return
            }
            navbar.style.height = '0px'
            navbar.style.paddingTop = '0px'
            navbar.style.paddingBottom = '0px'
        })

        */
    </script>
                                    
</body>
</html>
