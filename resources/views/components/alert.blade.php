@php
    $notificationData = null;
    if (session()->has('success')) {
        $notificationData = ['type' => 'success', 'message' => session('success')];
    } elseif (session()->has('error')) {
        $notificationData = ['type' => 'error', 'message' => session('error')];
    } elseif (session()->has('info')) {
        $notificationData = ['type' => 'info', 'message' => session('info')];
    } elseif (session()->has('warning')) {
        $notificationData = ['type' => 'warning', 'message' => session('warning')];
    } elseif (isset($errors) && $errors->any()) {
        $errorList = '<ul>';
        foreach ($errors->all() as $error) {
            $errorList .= '<li class="list-disc list-inside">' . e($error) . '</li>';
        }
        $errorList .= '</ul>';
        $notificationData = ['type' => 'error', 'message' => $errorList];
    }
@endphp

<div id="notification-manager" @if($notificationData) data-notification="{{ json_encode($notificationData) }}" @endif
    class="absolute top-4 left-4 right-4 z-50 space-y-4 mt-12" role="status" aria-live="polite">

    <template x-for="notification in $store.notifications.items" :key="notification.id">
        <div x-show="true" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-4" class="w-full rounded-lg shadow-lg p-4"
            role="alert" :class="{
                'bg-green-50 border-l-4 border-green-500 text-green-800': notification.type === 'success',
                'bg-red-50 border-l-4 border-red-500 text-red-800': notification.type === 'error',
                'bg-blue-50 border-l-4 border-blue-500 text-blue-800': notification.type === 'info',
                'bg-amber-50 border-l-4 border-amber-500 text-amber-800': notification.type === 'warning',
                'bg-gray-50 border-l-4 border-gray-500 text-gray-800': !notification.type
            }">

            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg x-show="notification.type === 'success'" class="w-5 h-5 text-green-500" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg x-show="notification.type === 'error'" class="w-5 h-5 text-red-500" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg x-show="notification.type === 'info'" class="w-5 h-5 text-blue-500" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg x-show="notification.type === 'warning'" class="w-5 h-5 text-amber-500" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.636-1.026 2.242-1.026 2.878 0l5.88 9.508c.632 1.021-.16 2.393-1.438 2.393H3.816c-1.278 0-2.07-1.372-1.438-2.393l5.88-9.508zM10 6a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 6zm0 8a1 1 0 100-2 1 1 0 000 2z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>

                <div class="ml-3 flex-1">
                    <p class="text-sm font-bold" x-text="{
                           'success': 'Sukses',
                           'error': 'Terjadi Kesalahan',
                           'info': 'Informasi',
                           'warning': 'Peringatan'
                       }[notification.type] || 'Notifikasi'"></p>
                    <div class="mt-1 text-sm opacity-90" x-html="notification.message"></div>
                </div>

                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button type="button" @click.prevent.stop="$store.notifications.remove(notification.id)"
                            class="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2"
                            :class="{
                                    'bg-green-50 text-green-500 hover:bg-green-100 focus:ring-offset-green-50 focus:ring-green-600': notification.type === 'success',
                                    'bg-red-50 text-red-500 hover:bg-red-100 focus:ring-offset-red-50 focus:ring-red-600': notification.type === 'error',
                                    'bg-blue-50 text-blue-500 hover:bg-blue-100 focus:ring-offset-blue-50 focus:ring-blue-600': notification.type === 'info',
                                    'bg-amber-50 text-amber-500 hover:bg-amber-100 focus:ring-offset-amber-50 focus:ring-amber-600': notification.type === 'warning',
                                    'bg-gray-50 text-gray-500 hover:bg-gray-100 focus:ring-offset-gray-50 focus:ring-gray-600': !notification.type
                                }">
                            <span class="sr-only">Tutup</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>