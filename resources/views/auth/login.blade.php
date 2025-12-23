<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('behin/logo.ico') . '?' . config('app.version') }}">
    <title>سامانه S3TUP — آینده انرژی در دستان شما</title>
    <script src="{{ url('behin/behin-dist/dist/js/tailwind-3.4.17.min.js') }}"></script>
    <link href="{{ url('behin/behin-dist/css/css2.css') }}?family=Vazirmatn:wght@300;400;700&display=swap"
        rel="stylesheet">
    <style>
        html,
        body {
            font-family: 'Vazirmatn', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin-inline: auto
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Hero -->
    <header class="bg-gradient-to-l from-yellow-400 via-yellow-300 to-amber-400 text-gray-900">
        <div class="container px-6 py-12">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="flex-1">
                    <h1 class="text-3xl md:text-4xl font-bold mb-3">پلتفرم S3TUP؛ آینده انرژی در دستان شما ⚡️☀️</h1>
                    <p class="mb-6 text-lg md:text-xl leading-relaxed">
                        به دنیای S3TUP خوش آمدید؛ جایی که رویای شما برای ساخت نیروگاه خورشیدی در کوتاه‌ترین زمان و
                        مطمئن‌ترین مسیر به واقعیت تبدیل می‌شود.
                    </p>

                    <div class="bg-white/80 p-4 rounded-lg shadow mb-6 text-sm leading-7">
                        <ul class="space-y-2">
                            <li>• <strong>مجوزها بدون دغدغه</strong> — تمامی مراحل قانونی و اداری را سریع و مطمئن انجام
                                می‌دهیم.</li>
                            <li>• <strong>نصب حرفه‌ای</strong> — اجرا توسط متخصصان دارای مجوز رسمی.</li>
                            <li>• <strong>تجهیزات اصل با گارانتی</strong> — استفاده از قطعات استاندارد و تکنولوژی روز
                                دنیا.</li>
                            <li>• <strong>خدمات کامل O&M</strong> — بهره‌برداری، نگهداری و تعمیرات زیر نظر سیستم هوشمند.
                            </li>
                            <li>• <strong>پشتیبانی همیشگی</strong> — از اولین قدم تا سال‌ها پس از راه‌اندازی کنار شما
                                هستیم.</li>
                        </ul>
                    </div>

                    <p class="text-md md:text-lg font-semibold text-gray-800 mb-6">
                        S3TUP فقط یک سامانه نیست — مسیری هوشمند و امن برای سرمایه‌گذاری پایدار و ورود به آینده‌ای سبز
                        است.
                    </p>

                    <p class="text-md text-amber-900 font-bold mb-6">💡 امروز انتخاب کنید؛ فردا انرژی پاک و سودآور در
                        اختیار شماست.</p>

                    <div class="flex flex-wrap gap-3 mb-2">
                        <!-- فرم لاگین -->
                        <form id="login-form" method="POST" action="{{ route('otp.send') }}"
                            class="flex flex-col sm:flex-row sm:items-center gap-2 bg-white p-3 rounded-lg shadow w-full">
                            @csrf
                            <input type="text" name="phone"
                                class="w-full sm:flex-1 p-2 border rounded text-center sm:text-right" id="inputMobile"
                                placeholder="شماره موبایل" required dir="ltr" inputmode="numeric" autofocus>
                            <button type="submit" class="w-full sm:w-auto bg-gray-900 text-white px-4 py-2 rounded-lg">
                                ورود
                            </button>
                        </form>
                    </div>

                    <!-- stats -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- ثبت‌نام نصاب‌ها -->
                        <a href="{{ route('installers.apply') }}"
                            class="group block p-4 rounded-lg border border-amber-300 bg-amber-50 hover:bg-amber-100 transition-all duration-300 text-center shadow-sm hover:shadow-md">
                            <div class="flex flex-col items-center">
                                <div
                                    class="bg-amber-400 text-white p-2 rounded-full mb-2 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-solar-panel text-xl"></i>
                                </div>
                                <div class="font-bold text-gray-800">ثبت‌نام نصاب‌ها</div>
                                <div class="text-xs text-gray-600 mt-1">پیوستن به شبکه پیمانکاران خورشیدی</div>
                            </div>
                        </a>

                        <!-- ثبت‌نام اصناف -->
                        <a href="{{ route('landing.sme-registration') }}"
                            class="group block p-4 rounded-lg border border-yellow-300 bg-yellow-50 hover:bg-yellow-100 transition-all duration-300 text-center shadow-sm hover:shadow-md">
                            <div class="flex flex-col items-center">
                                <div
                                    class="bg-yellow-400 text-white p-2 rounded-full mb-2 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-store text-xl"></i>
                                </div>
                                <div class="font-bold text-gray-800">ثبت‌نام اصناف</div>
                                <div class="text-xs text-gray-600 mt-1">تامین برق پایدار واحدهای صنفی</div>
                            </div>
                        </a>

                        <!-- ثبت‌نام صنایع -->
                        <a href="{{ route('landing.industry-registration') }}"
                            class="group block p-4 rounded-lg border border-sky-300 bg-sky-50 hover:bg-sky-100 transition-all duration-300 text-center shadow-sm hover:shadow-md">
                            <div class="flex flex-col items-center">
                                <div
                                    class="bg-sky-400 text-white p-2 rounded-full mb-2 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-industry text-xl"></i>
                                </div>
                                <div class="font-bold text-gray-800">ثبت‌نام صنایع</div>
                                <div class="text-xs text-gray-600 mt-1">
                                    احداث نیروگاه خورشیدی و ذخیره‌سازی انرژی
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

                <div class="flex-1">
                    <div class="rounded-xl overflow-hidden shadow-lg bg-white">
                        <img src="{{ url('behin/slide1.png') }}" alt="پنل خورشیدی" class="w-full h-64 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold mb-2">آغاز پروژه در ۳ مرحله ساده</h3>
                            <ol class="list-decimal pr-4 space-y-2 text-sm mb-6">
                                <li>درخواست آنلاین ثبت کنید</li>
                                <li>پیمانکار مناسب معرفی می‌شود</li>
                                <li>تأمین مالی و اجرای پروژه</li>
                            </ol>

                            <!-- باکس‌ها -->
                            <div class="mt-8 grid grid-cols-3 gap-4 md:grid-cols-3">
                                <div class="bg-white/70 p-4 rounded-lg text-center shadow">
                                    <div class="text-sm">ظرفیت نصب‌شده</div>
                                    <div class="text-2xl font-bold">۱۸ مگاوات</div>
                                </div>
                                <div class="bg-white/70 p-4 rounded-lg text-center shadow">
                                    <div class="text-sm">پیمانکار در سراسر ایران</div>
                                    <div class="text-2xl font-bold">بله</div>
                                </div>
                                <div class="bg-white/70 p-4 rounded-lg text-center shadow">
                                    <div class="text-sm">پروژه‌های تکمیل‌شده</div>
                                    <div class="text-2xl font-bold">۴۸</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container px-6 py-12">
        <!-- Features -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-4">ویژگی‌های اصلی S3TUP</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h4 class="font-semibold mb-2">شبکه گسترده پیمانکاران</h4>
                    <p class="text-sm">دسترسی به پیمانکاران معتبر و تایید‌شده در سراسر ایران.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h4 class="font-semibold mb-2">تسهیلات مالی</h4>
                    <p class="text-sm">امکان دریافت پیشنهادات مالی و تسهیلات برای نصب و راه‌اندازی نیروگاه.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h4 class="font-semibold mb-2">پشتیبانی فنی و مدیریتی</h4>
                    <p class="text-sm">پیگیری پروژه از آغاز تا تحویل و تضمین کیفیت اجرا.</p>
                </div>
            </div>
        </section>

        <!-- How it works -->
        <section id="how" class="mb-12">
            <h2 class="text-2xl font-bold mb-4">نحوه کار</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-gradient-to-tr from-white to-gray-50 rounded-lg shadow">
                    <div class="text-xl font-bold mb-2">۱. ثبت درخواست</div>
                    <p class="text-sm">فرم کوتاه را پر کنید تا تیم ما نیاز شما را بررسی کند.</p>
                </div>
                <div class="p-6 bg-gradient-to-tr from-white to-gray-50 rounded-lg shadow">
                    <div class="text-xl font-bold mb-2">۲. انتخاب پیمانکار</div>
                    <p class="text-sm">پیمانکاران واجد شرایط با شما تماس می‌گیرند و پیشنهاد ارسال می‌کنند.</p>
                </div>
                <div class="p-6 bg-gradient-to-tr from-white to-gray-50 rounded-lg shadow">
                    <div class="text-xl font-bold mb-2">۳. اجرا و پشتیبانی</div>
                    <p class="text-sm">تأمین مالی، اجرا و تست نهایی تا تحویل کامل پروژه.</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-white py-8">
        <div class="container px-6">
            <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                <div>
                    <h4 class="font-bold mb-2">S3TUP</h4>
                    <p class="text-sm">سامانه هوشمند ساخت نیروگاه خورشیدی — از مجوز تا اجرا و پشتیبانی.
                    </p>
                </div>
                <div>
                    <h5 class="font-semibold mb-2">تماس</h5>
                    <p class="text-sm">تلفن: 02191307571</p>
                </div>
                <div>
                    <h5 class="font-semibold mb-2">مجوزها</h5>
                    <a referrerpolicy='origin' target='_blank'
                        href='https://trustseal.enamad.ir/?id=642135&Code=Zmyvcsbjmy4wR9QgoHCBdzNN3L93m4qf'><img
                            referrerpolicy='origin'
                            src='https://trustseal.enamad.ir/logo.aspx?id=642135&Code=Zmyvcsbjmy4wR9QgoHCBdzNN3L93m4qf'
                            alt='' style='cursor:pointer' code='Zmyvcsbjmy4wR9QgoHCBdzNN3L93m4qf'></a>

                </div>
            </div>
            <div class="text-sm text-gray-400 mt-6">© تمامی حقوق محفوظ است.</div>
        </div>
    </footer>

</body>

</html>
