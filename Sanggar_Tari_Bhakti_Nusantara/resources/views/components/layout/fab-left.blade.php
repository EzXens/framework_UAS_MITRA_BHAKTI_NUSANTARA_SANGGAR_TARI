<div style="position: fixed; bottom: 20px; left: 20px; z-index: 1000;">
  <button class="btn btn-circle btn-xl" onclick="openTutorialResetModal()">
<svg viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 13V11C5.5 7.68629 8.18629 5 11.5 5H13.5C16.8137 5 19.5 7.68629 19.5 11V13C19.5 16.3137 16.8137 19 13.5 19H11.5C8.18629 19 5.5 16.3137 5.5 13Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M10.5 9.63895C10.5 8.54895 11.4 7.94895 12.747 7.99995C13.7191 8.03367 14.492 8.82731 14.5 9.79995C14.547 10.7095 14.116 11.5776 13.363 12.09C12.723 12.5 12.3847 13.2487 12.5 14" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.5 16.5C12.2243 16.5 12 16.2757 12 16C12 15.7243 12.2243 15.5 12.5 15.5C12.7757 15.5 13 15.7243 13 16C13 16.2757 12.7757 16.5 12.5 16.5Z" fill="#ffffff"></path> <path d="M12.5 15C13.0523 15 13.5 15.4477 13.5 16C13.5 16.5523 13.0523 17 12.5 17C11.9477 17 11.5 16.5523 11.5 16C11.5 15.4477 11.9477 15 12.5 15Z" fill="#ffffff"></path> </g></svg>
  </button>
</div>

<!-- Tutorial Reset Modal -->
<div id="tutorial-reset-modal" class="fixed inset-0 backdrop-blur-sm z-[10000] hidden flex items-center justify-center">
  <div class="bg-black/70 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl">
    <div class="text-center">
      <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 mb-4">
        <svg fill="#000000" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="promo"> <path d="M73,37V26.91a2.51,2.51,0,0,0-3.72-2.18l-21.42,12A2.48,2.48,0,0,0,45.5,35h-11a2.5,2.5,0,0,0-2.45,2H26.5A4.51,4.51,0,0,0,22,41.5v9A4.51,4.51,0,0,0,26.5,55H32V69.5A2.5,2.5,0,0,0,34.5,72h6.59a1.5,1.5,0,0,0,1.06-2.56l-1.71-1.71A1.5,1.5,0,0,1,40,66.67V57h5.5a2.48,2.48,0,0,0,2.36-1.72l21.42,12a2.53,2.53,0,0,0,1.22.32,2.38,2.38,0,0,0,1.26-.35A2.46,2.46,0,0,0,73,65.09V55a5.5,5.5,0,0,0,5-5.47v-7A5.5,5.5,0,0,0,73,37ZM26.5,54A3.5,3.5,0,0,1,23,50.5v-9A3.5,3.5,0,0,1,26.5,38H32V54ZM39.73,68.44l1.71,1.71a.48.48,0,0,1,.11.54.49.49,0,0,1-.46.31H34.5A1.5,1.5,0,0,1,33,69.5V57h6v9.67A2.49,2.49,0,0,0,39.73,68.44ZM45.5,56H33V37.5A1.5,1.5,0,0,1,34.5,36h11A1.5,1.5,0,0,1,47,37.5v17A1.5,1.5,0,0,1,45.5,56ZM48,37.79,69,26V66L48,54.21Zm24,27.3a1.49,1.49,0,0,1-2,1.4v-41a1.49,1.49,0,0,1,2,1.4V65.09ZM77,49.5A4.5,4.5,0,0,1,73,54V38a4.5,4.5,0,0,1,4,4.47Z"></path> <path d="M29.5,41h-4a.5.5,0,0,0,0,1h4a.5.5,0,0,0,0-1Z"></path> <path d="M29.5,44h-4a.5.5,0,0,0,0,1h4a.5.5,0,0,0,0-1Z"></path> <path d="M29.5,47h-4a.5.5,0,0,0,0,1h4a.5.5,0,0,0,0-1Z"></path> <path d="M29.5,50h-4a.5.5,0,0,0,0,1h4a.5.5,0,0,0,0-1Z"></path> </g> </g></svg>
      </div>
      <h3 class="text-lg font-medium text-[#FEDA60] mb-2">Reset Tutorial</h3>
      <p class="text-sm text-white mb-6">
        Apakah Anda ingin mereset semua tutorial? Ini Akan Memulai Ulang Tutorial Dari Awal.
      </p>
      <div class="flex space-x-3">
        <button onclick="closeTutorialResetModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors">
          Batal
        </button>
        <button onclick="confirmTutorialReset()" class="flex-1 bg-[#FEDA60] hover:bg-red-700 text-black font-bold py-2 px-4 rounded-lg transition-colors">
          Reset Tutorial
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Tutorial Success Modal -->
<div id="tutorial-success-modal" class="fixed inset-0 backdrop-blur-sm z-[10000] hidden flex items-center justify-center">
  <div class="bg-black/70 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl">
    <div class="text-center">
      <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
      </div>
      <h3 class="text-lg font-medium text-[#FEDA60]  mb-2">Berhasil!</h3>
      <p class="text-sm text-white mb-6">
        Tutorial telah berhasil direset. Halaman akan di-refresh untuk memulai tutorial dari awal.
      </p>
      <button onclick="refreshPage()" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
        OK, Refresh Halaman
      </button>
    </div>
  </div>
</div>

<script>
function openTutorialResetModal() {
    console.log('Opening modal');
    document.getElementById('tutorial-reset-modal').classList.remove('hidden');
}

function closeTutorialResetModal() {
    document.getElementById('tutorial-reset-modal').classList.add('hidden');
}

function confirmTutorialReset() {
    // Reset tutorial logic
    console.log('Resetting all tutorials...');
    const tutorialKeys = ['onboarding', 'home', 'products', 'classes', 'gallery', 'about', 'contact', 'login_onboarding', 'admin_dashboard', 'user_dashboard'];
    tutorialKeys.forEach(key => {
        localStorage.removeItem(`tutorial_completed_${key}`);
        localStorage.removeItem(`tutorial_dont_show_${key}`);
        localStorage.removeItem(`tutorial_progress_${key}`);
    });
    localStorage.removeItem('tutorial_resume_key');
    localStorage.removeItem('tutorial_resume_index');

    // Close modal
    closeTutorialResetModal();

    // Show success modal
    openTutorialSuccessModal();
}

function openTutorialSuccessModal() {
    console.log('Opening success modal');
    document.getElementById('tutorial-success-modal').classList.remove('hidden');
}

function refreshPage() {
    console.log('Refreshing page...');
    window.location.reload();
}
</script>

