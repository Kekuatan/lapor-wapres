<!-- Main Sidebar Container -->

<div >
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
{{--                <a href={{route('product.list')}} class="nav-link">Pembelian Kios</a>--}}
            </li>
            {{--            <li class="nav-item d-none d-sm-inline-block">--}}
            {{--                <a href="#" class="nav-link">Contact</a>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item dropdown">--}}
            {{--                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
            {{--                    Help--}}
            {{--                </a>--}}
            {{--                <div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
            {{--                    <a class="dropdown-item" href="#">FAQ</a>--}}
            {{--                    <a class="dropdown-item" href="#">Support</a>--}}
            {{--                    <div class="dropdown-divider"></div>--}}
            {{--                    <a class="dropdown-item" href="#">Contact</a>--}}
            {{--                </div>--}}
            {{--            </li>--}}
        </ul>

        <!-- SEARCH FORM -->
        {{--        <form class="form-inline ml-3">--}}
        {{--            <div class="input-group input-group-sm">--}}
        {{--                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
        {{--                <div class="input-group-append">--}}
        {{--                    <button class="btn btn-navbar" type="submit">--}}
        {{--                        <i class="fas fa-search"></i>--}}
        {{--                    </button>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </form>--}}

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
{{--                        <li class="nav-item dropdown" >--}}
{{--                            <a  class="nav-link {{($this->getCountUnreadNotification() ? '': 'hidden')}}" data-toggle="dropdown" href="#">--}}
{{--                                <i class="far fa-bell"></i>--}}
{{--                                <span class="badge badge-warning navbar-badge "  > {{($this->getCountUnreadNotification() ?? '')}}</span>--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--                                @foreach($this->getUnreadNotification() ?? [] as $notification)--}}
{{--                                    <a href="#" class="dropdown-item">--}}
{{--                                        <!-- Message Start -->--}}
{{--                                        <div class="media">--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h3 class="dropdown-item-title">--}}
{{--                                                    {{$notification->data['title']}}--}}
{{--                                                    <span class="float-right text-sm text-danger" wire:click.prevent="readOneNotification('{{$notification->id}}')"><i class="fas fa-close"></i></span>--}}
{{--                                                </h3>--}}
{{--                                                <p class="text-sm">{{$notification->data['message']}}</p>--}}
{{--                                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!-- Message End -->--}}
{{--                                    </a>--}}
{{--                                    <div class="dropdown-divider"></div>--}}
{{--                                @endforeach--}}

{{--                                <a href="#" class="dropdown-item dropdown-footer" wire:click.prevent="readAllNotification()">Close all Notification</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
                        <!-- Notifications Dropdown Menu -->
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a class="nav-link" data-toggle="dropdown" href="#">--}}
{{--                                <i class="far fa-bell"></i>--}}
{{--                                <span class="badge badge-warning navbar-badge">15</span>--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--                                <span class="dropdown-header">15 Notifications</span>--}}
{{--                                <div class="dropdown-divider"></div>--}}
{{--                                <a href="#" class="dropdown-item">--}}
{{--                                    <i class="fas fa-envelope mr-2"></i> 4 new messages--}}
{{--                                    <span class="float-right text-muted text-sm">3 mins</span>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-divider"></div>--}}
{{--                                <a href="#" class="dropdown-item">--}}
{{--                                    <i class="fas fa-users mr-2"></i> 8 friend requests--}}
{{--                                    <span class="float-right text-muted text-sm">12 hours</span>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-divider"></div>--}}
{{--                                <a href="#" class="dropdown-item">--}}
{{--                                    <i class="fas fa-file mr-2"></i> 3 new reports--}}
{{--                                    <span class="float-right text-muted text-sm">2 days</span>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-divider"></div>--}}
{{--                                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" wire:click="logout" alt="logout" role="button"><i
                        class="fas fa-sign-out-alt"  style="color: red;"></i></a>

            </li>
        </ul>
    </nav>
    <!-- /.navbar -->



    <!-- Main Sidebar Container -->

</div>



{{--<div class="sticky top-0 z-40"     x-data="{ dropdownOpen:false }">--}}
{{--    <header class="sticky top-0 z-40 flex w-full bg-white drop-shadow-1 dark:bg-boxdark dark:drop-shadow-none">--}}
{{--        <div class="flex flex-grow items-center justify-between px-4 py-4 shadow-2 md:px-6 2xl:px-11">--}}
{{--            <div class="flex items-center gap-2 sm:gap-4 lg:hidden">--}}
{{--                <!-- Hamburger Toggle BTN -->--}}
{{--                <button--}}
{{--                    class="z-99999 block rounded-sm border border-stroke bg-white p-1.5 shadow-sm dark:border-strokedark dark:bg-boxdark lg:hidden"--}}
{{--                    @click.stop="sidebarToggle = !sidebarToggle">--}}
{{--        <span class="relative block h-5.5 w-5.5 cursor-pointer">--}}
{{--          <span class="du-block absolute right-0 h-full w-full">--}}
{{--            <span--}}
{{--                class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-[0] duration-200 ease-in-out dark:bg-white !w-full delay-300"--}}
{{--                :class="{ '!w-full delay-300': !sidebarToggle }"></span>--}}
{{--            <span--}}
{{--                class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-150 duration-200 ease-in-out dark:bg-white !w-full delay-400"--}}
{{--                :class="{ '!w-full delay-400': !sidebarToggle }"></span>--}}
{{--            <span--}}
{{--                class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-200 duration-200 ease-in-out dark:bg-white !w-full delay-500"--}}
{{--                :class="{ '!w-full delay-500': !sidebarToggle }"></span>--}}
{{--          </span>--}}
{{--          <span class="du-block absolute right-0 h-full w-full rotate-45">--}}
{{--            <span--}}
{{--                class="absolute left-2.5 top-0 block h-full w-0.5 rounded-sm bg-black delay-300 duration-200 ease-in-out dark:bg-white !h-0 delay-[0]"--}}
{{--                :class="{ '!h-0 delay-[0]': !sidebarToggle }"></span>--}}
{{--            <span--}}
{{--                class="delay-400 absolute left-0 top-2.5 block h-0.5 w-full rounded-sm bg-black duration-200 ease-in-out dark:bg-white !h-0 dealy-200"--}}
{{--                :class="{ '!h-0 dealy-200': !sidebarToggle }"></span>--}}
{{--          </span>--}}
{{--        </span>--}}
{{--                </button>--}}
{{--                <!-- Hamburger Toggle BTN -->--}}
{{--                <a class="block flex-shrink-0 lg:hidden max-w-30 max-h-96 hidden sm:block" href="index.html">--}}
{{--                    <img src="{{asset('/svg/bc_logo.svg')}}" alt="Logo">--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="hidden sm:block">--}}

{{--            </div>--}}

{{--            <div class="flex items-center gap-3 2xsm:gap-7">--}}
{{--                <ul class="flex items-center gap-2 2xsm:gap-4">--}}
{{--                    <li>--}}
{{--                        <!-- Dark Mode Toggler -->--}}
{{--                        <label :class="darkMode ? 'bg-primary' : 'bg-stroke'"--}}
{{--                               class="relative m-0 block h-7.5 w-14 rounded-full bg-stroke">--}}
{{--                            <input type="checkbox" :value="darkMode" @change="darkMode = !darkMode"--}}
{{--                                   class="absolute top-0 z-50 m-0 h-full w-full cursor-pointer opacity-0">--}}
{{--                            <span :class="darkMode &amp;&amp; '!right-1 !translate-x-full'"--}}
{{--                                  class="absolute left-1 top-1/2 flex h-6 w-6 -translate-y-1/2 translate-x-0 items-center justify-center rounded-full bg-white shadow-switcher duration-75 ease-linear">--}}
{{--              <span class="dark:hidden">--}}
{{--                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                  <path--}}
{{--                      d="M7.99992 12.6666C10.5772 12.6666 12.6666 10.5772 12.6666 7.99992C12.6666 5.42259 10.5772 3.33325 7.99992 3.33325C5.42259 3.33325 3.33325 5.42259 3.33325 7.99992C3.33325 10.5772 5.42259 12.6666 7.99992 12.6666Z"--}}
{{--                      fill="#969AA1"></path>--}}
{{--                  <path--}}
{{--                      d="M8.00008 15.3067C7.63341 15.3067 7.33342 15.0334 7.33342 14.6667V14.6134C7.33342 14.2467 7.63341 13.9467 8.00008 13.9467C8.36675 13.9467 8.66675 14.2467 8.66675 14.6134C8.66675 14.9801 8.36675 15.3067 8.00008 15.3067ZM12.7601 13.4267C12.5867 13.4267 12.4201 13.3601 12.2867 13.2334L12.2001 13.1467C11.9401 12.8867 11.9401 12.4667 12.2001 12.2067C12.4601 11.9467 12.8801 11.9467 13.1401 12.2067L13.2267 12.2934C13.4867 12.5534 13.4867 12.9734 13.2267 13.2334C13.1001 13.3601 12.9334 13.4267 12.7601 13.4267ZM3.24008 13.4267C3.06675 13.4267 2.90008 13.3601 2.76675 13.2334C2.50675 12.9734 2.50675 12.5534 2.76675 12.2934L2.85342 12.2067C3.11342 11.9467 3.53341 11.9467 3.79341 12.2067C4.05341 12.4667 4.05341 12.8867 3.79341 13.1467L3.70675 13.2334C3.58008 13.3601 3.40675 13.4267 3.24008 13.4267ZM14.6667 8.66675H14.6134C14.2467 8.66675 13.9467 8.36675 13.9467 8.00008C13.9467 7.63341 14.2467 7.33342 14.6134 7.33342C14.9801 7.33342 15.3067 7.63341 15.3067 8.00008C15.3067 8.36675 15.0334 8.66675 14.6667 8.66675ZM1.38675 8.66675H1.33341C0.966748 8.66675 0.666748 8.36675 0.666748 8.00008C0.666748 7.63341 0.966748 7.33342 1.33341 7.33342C1.70008 7.33342 2.02675 7.63341 2.02675 8.00008C2.02675 8.36675 1.75341 8.66675 1.38675 8.66675ZM12.6734 3.99341C12.5001 3.99341 12.3334 3.92675 12.2001 3.80008C11.9401 3.54008 11.9401 3.12008 12.2001 2.86008L12.2867 2.77341C12.5467 2.51341 12.9667 2.51341 13.2267 2.77341C13.4867 3.03341 13.4867 3.45341 13.2267 3.71341L13.1401 3.80008C13.0134 3.92675 12.8467 3.99341 12.6734 3.99341ZM3.32675 3.99341C3.15341 3.99341 2.98675 3.92675 2.85342 3.80008L2.76675 3.70675C2.50675 3.44675 2.50675 3.02675 2.76675 2.76675C3.02675 2.50675 3.44675 2.50675 3.70675 2.76675L3.79341 2.85342C4.05341 3.11342 4.05341 3.53341 3.79341 3.79341C3.66675 3.92675 3.49341 3.99341 3.32675 3.99341ZM8.00008 2.02675C7.63341 2.02675 7.33342 1.75341 7.33342 1.38675V1.33341C7.33342 0.966748 7.63341 0.666748 8.00008 0.666748C8.36675 0.666748 8.66675 0.966748 8.66675 1.33341C8.66675 1.70008 8.36675 2.02675 8.00008 2.02675Z"--}}
{{--                      fill="#969AA1"></path>--}}
{{--                </svg>--}}
{{--              </span>--}}
{{--              <span class="hidden dark:inline-block">--}}
{{--                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                  <path--}}
{{--                      d="M14.3533 10.62C14.2466 10.44 13.9466 10.16 13.1999 10.2933C12.7866 10.3667 12.3666 10.4 11.9466 10.38C10.3933 10.3133 8.98659 9.6 8.00659 8.5C7.13993 7.53333 6.60659 6.27333 6.59993 4.91333C6.59993 4.15333 6.74659 3.42 7.04659 2.72666C7.33993 2.05333 7.13326 1.7 6.98659 1.55333C6.83326 1.4 6.47326 1.18666 5.76659 1.48C3.03993 2.62666 1.35326 5.36 1.55326 8.28666C1.75326 11.04 3.68659 13.3933 6.24659 14.28C6.85993 14.4933 7.50659 14.62 8.17326 14.6467C8.27993 14.6533 8.38659 14.66 8.49326 14.66C10.7266 14.66 12.8199 13.6067 14.1399 11.8133C14.5866 11.1933 14.4666 10.8 14.3533 10.62Z"--}}
{{--                      fill="#969AA1"></path>--}}
{{--                </svg>--}}
{{--              </span>--}}
{{--            </span>--}}
{{--                        </label>--}}
{{--                        <!-- Dark Mode Toggler -->--}}
{{--                    </li>--}}

{{--                    <!-- Notification Menu Area -->--}}
{{--                    <li--}}
{{--                        class="relative"--}}
{{--                        x-data="{ dropdownOpen: false, notifying: {{(blank($this->getIsExistUnreadNotification()) ? 'true': 'false')}} }"--}}
{{--                        @click.outside="dropdownOpen = false">--}}
{{--                        <a class="relative flex h-8.5 w-8.5 items-center justify-center rounded-full border-[0.5px] border-stroke bg-gray hover:text-primary dark:border-strokedark dark:bg-meta-4 dark:text-white"--}}
{{--                           href="#" @click.prevent="dropdownOpen = ! dropdownOpen; notifying = false">--}}
{{--            <span--}}
{{--                                :class="!notifying &amp;&amp; 'hidden'"--}}
{{--                wire:poll.10000ms--}}
{{--                class="absolute -top-0.5 right-0 z-1 h-2 w-2 rounded-full bg-meta-1 {{($this->getIsExistUnreadNotification() ? '': 'hidden')}}">--}}
{{--              <span--}}
{{--                  class="absolute -z-1 inline-flex h-full w-full animate-ping rounded-full bg-meta-1 opacity-75"></span>--}}
{{--            </span>--}}

{{--                            <svg class="fill-current duration-300 ease-in-out" width="18" height="18"--}}
{{--                                 viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path--}}
{{--                                    d="M16.1999 14.9343L15.6374 14.0624C15.5249 13.8937 15.4687 13.7249 15.4687 13.528V7.67803C15.4687 6.01865 14.7655 4.47178 13.4718 3.31865C12.4312 2.39053 11.0812 1.7999 9.64678 1.6874V1.1249C9.64678 0.787402 9.36553 0.478027 8.9999 0.478027C8.6624 0.478027 8.35303 0.759277 8.35303 1.1249V1.65928C8.29678 1.65928 8.24053 1.65928 8.18428 1.6874C4.92178 2.05303 2.4749 4.66865 2.4749 7.79053V13.528C2.44678 13.8093 2.39053 13.9499 2.33428 14.0343L1.7999 14.9343C1.63115 15.2155 1.63115 15.553 1.7999 15.8343C1.96865 16.0874 2.2499 16.2562 2.55928 16.2562H8.38115V16.8749C8.38115 17.2124 8.6624 17.5218 9.02803 17.5218C9.36553 17.5218 9.6749 17.2405 9.6749 16.8749V16.2562H15.4687C15.778 16.2562 16.0593 16.0874 16.228 15.8343C16.3968 15.553 16.3968 15.2155 16.1999 14.9343ZM3.23428 14.9905L3.43115 14.653C3.5999 14.3718 3.68428 14.0343 3.74053 13.6405V7.79053C3.74053 5.31553 5.70928 3.23428 8.3249 2.95303C9.92803 2.78428 11.503 3.2624 12.6562 4.2749C13.6687 5.1749 14.2312 6.38428 14.2312 7.67803V13.528C14.2312 13.9499 14.3437 14.3437 14.5968 14.7374L14.7655 14.9905H3.23428Z"--}}
{{--                                    fill=""></path>--}}
{{--                            </svg>--}}
{{--                        </a>--}}

{{--                        <!-- Dropdown Start -->--}}
{{--                        <div x-show="dropdownOpen"--}}
{{--                             class="absolute -right-27 mt-2.5 flex h-90 w-75 flex-col rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark sm:right-0 sm:w-80"--}}
{{--                             style="display: none;">--}}
{{--                            <div class="px-4.5 py-3">--}}
{{--                                <h5 class="text-sm font-medium text-bodydark2"--}}
{{--                                    wire:click.prevent="readOneNotification('aa')">Notification</h5>--}}
{{--                            </div>--}}

{{--                            <ul id="notification-lists" class="flex h-auto flex-col overflow-y-auto">--}}
{{--                                @foreach($this->getUnreadNotification() ?? [] as $notification)--}}

{{--                                    <li id="toast-message-cta-{{$loop->iteration}}"--}}
{{--                                        class="notif-list w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-400 "--}}
{{--                                    >--}}
{{--                                        <div class="flex">--}}
{{--                                                                                                <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese Leos image"/>--}}
{{--                                            <svg class="w-5 h-5 text-red-600 dark:text-blue-500 rotate-45" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />--}}
{{--                                            </svg>--}}

{{--                                            <div class="ms-3 text-sm font-normal">--}}
{{--                                                <span--}}
{{--                                                    class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">--}}
{{--                                                    {{$notification->data['title']}}--}}
{{--                                                </span>--}}
{{--                                                <div--}}
{{--                                                    class="mb-2 text-sm font-normal">{{$notification->data['message']}}</div>--}}
{{--                                                <a href="#" class="inline-flex px-2.5 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Reply</a>--}}
{{--                                            </div>--}}
{{--                                            <a--}}
{{--                                                class="notif-list-close ms-auto -mx-1.5 -my-1.5 bg-white justify-center items-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"--}}
{{--                                                data-dismiss-target="#toast-message-cta-{{$loop->iteration}}"--}}
{{--                                                aria-label="Close"--}}
{{--                                                onclick="readNotif(this, event)"--}}
{{--                                                href="{{route('notification.read',['id'=>$notification->id])}}"--}}
{{--                                            >--}}
{{--                                                <span class="sr-only">Close</span>--}}
{{--                                                <svg class="w-3 h-3" aria-hidden="true"--}}
{{--                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">--}}
{{--                                                    <path stroke="currentColor" stroke-linecap="round"--}}
{{--                                                          stroke-linejoin="round" stroke-width="2"--}}
{{--                                                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>--}}
{{--                                                </svg>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}

{{--                                @endforeach--}}
{{--                            </ul>--}}

{{--                        </div>--}}
{{--                        <!-- Dropdown End -->--}}
{{--                    </li>--}}
{{--                    <!-- Notification Menu Area -->--}}


{{--                </ul>--}}

{{--                <!-- User Area -->--}}
{{--                <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">--}}
{{--                    <a class="flex items-center gap-4" href="#" @click.prevent="dropdownOpen = ! dropdownOpen">--}}
{{--          <span class="hidden text-right lg:block">--}}
{{--            <span class="block text-sm font-medium text-theme-black dark:text-white">{{$user->name}}</span>--}}
{{--            <span class="block text-xs font-medium">{{$user->email}}</span>--}}
{{--          </span>--}}

{{--                        <span class="h-12 w-12 rounded-full">--}}
{{--            <img src="#" alt="User">--}}
{{--          </span>--}}

{{--                        <svg :class="dropdownOpen &amp;&amp; 'rotate-180'" class="hidden fill-current sm:block"--}}
{{--                             width="12" height="8" viewBox="0 0 12 8" fill="none"--}}
{{--                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <path fill-rule="evenodd" clip-rule="evenodd"--}}
{{--                                  d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"--}}
{{--                                  fill=""></path>--}}
{{--                        </svg>--}}
{{--                    </a>--}}

{{--                    <!-- Dropdown Start -->--}}
{{--                    <div x-show="dropdownOpen"--}}
{{--                         class="absolute right-0 mt-4 flex w-62.5 flex-col rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"--}}
{{--                         style="display: none;">--}}
{{--                        <ul class="flex flex-col gap-5 border-b border-stroke px-6 py-7.5 dark:border-strokedark">--}}
{{--                            <li>--}}
{{--                                <a href="{{route('setting.profile')}}"--}}
{{--                                   class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">--}}
{{--                                    <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none"--}}
{{--                                         xmlns="http://www.w3.org/2000/svg">--}}
{{--                                        <path--}}
{{--                                            d="M11 9.62499C8.42188 9.62499 6.35938 7.59687 6.35938 5.12187C6.35938 2.64687 8.42188 0.618744 11 0.618744C13.5781 0.618744 15.6406 2.64687 15.6406 5.12187C15.6406 7.59687 13.5781 9.62499 11 9.62499ZM11 2.16562C9.28125 2.16562 7.90625 3.50624 7.90625 5.12187C7.90625 6.73749 9.28125 8.07812 11 8.07812C12.7188 8.07812 14.0938 6.73749 14.0938 5.12187C14.0938 3.50624 12.7188 2.16562 11 2.16562Z"--}}
{{--                                            fill=""></path>--}}
{{--                                        <path--}}
{{--                                            d="M17.7719 21.4156H4.2281C3.5406 21.4156 2.9906 20.8656 2.9906 20.1781V17.0844C2.9906 13.7156 5.7406 10.9656 9.10935 10.9656H12.925C16.2937 10.9656 19.0437 13.7156 19.0437 17.0844V20.1781C19.0094 20.8312 18.4594 21.4156 17.7719 21.4156ZM4.53748 19.8687H17.4969V17.0844C17.4969 14.575 15.4344 12.5125 12.925 12.5125H9.07498C6.5656 12.5125 4.5031 14.575 4.5031 17.0844V19.8687H4.53748Z"--}}
{{--                                            fill=""></path>--}}
{{--                                    </svg>--}}
{{--                                    My Profile--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <button--}}
{{--                            wire:click.prevent="logout"--}}
{{--                            class="flex items-center gap-3.5 px-6 py-4 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">--}}
{{--                            <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none"--}}
{{--                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path--}}
{{--                                    d="M15.5375 0.618744H11.6531C10.7594 0.618744 10.0031 1.37499 10.0031 2.26874V4.64062C10.0031 5.05312 10.3469 5.39687 10.7594 5.39687C11.1719 5.39687 11.55 5.05312 11.55 4.64062V2.23437C11.55 2.16562 11.5844 2.13124 11.6531 2.13124H15.5375C16.3625 2.13124 17.0156 2.78437 17.0156 3.60937V18.3562C17.0156 19.1812 16.3625 19.8344 15.5375 19.8344H11.6531C11.5844 19.8344 11.55 19.8 11.55 19.7312V17.3594C11.55 16.9469 11.2062 16.6031 10.7594 16.6031C10.3125 16.6031 10.0031 16.9469 10.0031 17.3594V19.7312C10.0031 20.625 10.7594 21.3812 11.6531 21.3812H15.5375C17.2219 21.3812 18.5625 20.0062 18.5625 18.3562V3.64374C18.5625 1.95937 17.1875 0.618744 15.5375 0.618744Z"--}}
{{--                                    fill=""></path>--}}
{{--                                <path--}}
{{--                                    d="M6.05001 11.7563H12.2031C12.6156 11.7563 12.9594 11.4125 12.9594 11C12.9594 10.5875 12.6156 10.2438 12.2031 10.2438H6.08439L8.21564 8.07813C8.52501 7.76875 8.52501 7.2875 8.21564 6.97812C7.90626 6.66875 7.42501 6.66875 7.11564 6.97812L3.67814 10.4844C3.36876 10.7938 3.36876 11.275 3.67814 11.5844L7.11564 15.0906C7.25314 15.2281 7.45939 15.3312 7.66564 15.3312C7.87189 15.3312 8.04376 15.2625 8.21564 15.125C8.52501 14.8156 8.52501 14.3344 8.21564 14.025L6.05001 11.7563Z"--}}
{{--                                    fill=""></path>--}}
{{--                            </svg>--}}
{{--                            Log Out--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <!-- Dropdown End -->--}}
{{--                </div>--}}
{{--                <!-- User Area -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </header>--}}
{{--    <script>--}}
{{--        function readNotif(element, event) {--}}
{{--            console.log('run readNotif')--}}
{{--            event.preventDefault(); // Prevent the default action of the <a> tag--}}
{{--            let parent = element.parentElement.parentElement--}}
{{--            parent.classList.add('notif-list', 'w-full', 'max-w-xs', 'p-4', 'text-gray-500', 'bg-white', 'rounded-lg', 'shadow', 'dark:bg-gray-800', 'dark:text-gray-400', 'transition-opacity', 'duration-300', 'ease-out', 'opacity-0', 'hidden');--}}

{{--            var url = element.getAttribute('href');--}}
{{--            //alert(url)// Get the URL from the href attribute--}}
{{--            var method = 'GET'; // Assuming the default method is GET--}}
{{--            // Perform the AJAX request--}}
{{--            var xhr = new XMLHttpRequest();--}}
{{--            xhr.open(method, url);--}}
{{--            xhr.setRequestHeader('Content-Type', 'application/json');--}}
{{--            xhr.onreadystatechange = function () {--}}
{{--                // if (xhr.readyState === XMLHttpRequest.DONE) {--}}
{{--                //     var result = JSON.parse(xhr.responseText);--}}
{{--                //     if (result.success) {--}}
{{--                //         // toastr.success(result.msg);--}}
{{--                //         // Do other actions on success--}}
{{--                //     } else {--}}
{{--                //         // toastr.error(result.msg);--}}
{{--                //         // Do other actions on failure--}}
{{--                //     }--}}
{{--                // }--}}
{{--            };--}}
{{--            xhr.onerror = function () {--}}
{{--                toastr.error('An error occurred while processing the request.');--}}
{{--            };--}}
{{--            xhr.send();--}}
{{--        }--}}


{{--    </script>--}}
{{--</div>--}}
