const profileModal = document.querySelector('#modal-profile');
const profileBtnOk = document.querySelector('#profile-ok-confirm');
const profileBtnCancel = document.querySelector('#profile-cancel');
const profileH2 = document.querySelector('#profile-modal-h2');
const profileP = document.querySelector('#profile-modal-p');
const profilePLong = document.querySelector('#profile-modal-p-long');
const profileIconBadge = document.querySelector('#profile-icon-badge');

document.addEventListener('DOMContentLoaded', () => {
    // dataProfile from <script>
    if (typeof dataProfile !== 'undefined' && dataProfile !== null && dataProfile.status) {
        const resultObj = dataProfile;

        if (profileH2) profileH2.textContent = resultObj.title || 'Notifikasi';
        if (profilePLong) profilePLong.textContent = resultObj.message || '';

        // Update icon badge color based on type
        if (profileIconBadge) {
            profileIconBadge.classList.remove('success', 'warning', 'danger');
            profileIconBadge.classList.add(resultObj.type || 'success');

            // Update SVG icon based on type
            const svgMap = {
                success: '<svg class="w-6 h-6 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>',
                danger: '<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>',
                warning: '<svg class="w-6 h-6 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>'
            };
            profileIconBadge.innerHTML = svgMap[resultObj.type] || svgMap.success;
        }

        // Show the modal
        if (profileModal) profileModal.classList.remove('hidden');

        // OK button → redirect to index
        if (profileBtnOk) {
            profileBtnOk.addEventListener('click', () => {
                if (profileModal) profileModal.classList.add('hidden');
            });
        }

        // Cancel button → just close modal
        if (profileBtnCancel) {
            profileBtnCancel.addEventListener('click', () => {
                if (profileModal) profileModal.classList.add('hidden');
            });
        }
    }
});
