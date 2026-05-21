<?php
include_once('./views/comps/header/header.php');
include_once('./views/comps/navbar/nav.php');
?>
<div class="overflow-hidden min-h-screen">
  <div class="max-w-10/12 mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="grid grid-cols-12">

      <!-- SIDEBAR -->
      <aside class="col-span-12 md:col-span-3 lg:col-span-3 overflow-y-auto ">
        <div class="bg-amber-50 py-5 px-4">
            <p class="text-lg font-semibold py-2">General</p>
            <ul class="border-l-px border-slate-200 ">
                <li class="px-4 border-l hover:border-purple-500 transition ease-out duration-300 cursor-pointer font-semibold text-slate-500 hover:text-slate-950">Docs</li>
                <li class="px-4 border-l hover:border-purple-500 transition ease-out duration-300 cursor-pointer font-semibold text-slate-500 hover:text-slate-950">Docs</li>
                <li class="px-4 border-l hover:border-purple-500 transition ease-out duration-300 cursor-pointer font-semibold text-slate-500 hover:text-slate-950">Docs</li>
                <li class="px-4 border-l hover:border-purple-500 transition ease-out duration-300 cursor-pointer font-semibold text-slate-500 hover:text-slate-950">Docs</li>
            </ul>
        </div>
      </aside>

      <!-- CONTENT -->
      <main class="col-span-12 md:col-span-9 lg:col-span-9">
        <div class="bg-indigo-50 py-5 px-4">
            CONTENT
        </div>
      </main>

    </div>

  </div>
</div>

<?php
include_once('./views/comps/footer/footer.php');