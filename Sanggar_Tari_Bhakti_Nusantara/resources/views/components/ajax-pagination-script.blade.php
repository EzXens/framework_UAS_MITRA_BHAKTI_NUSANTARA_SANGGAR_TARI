<!-- AJAX Pagination Script -->
<script>
let currentUrl = window.location.href.split('?')[0];

function loadPage(page) {
    const url = `${currentUrl}?page=${page}`;
    
    // Show loading state
    const contentContainer = document.getElementById('data-content');
    const paginationContainer = document.getElementById('pagination-container');
    
    if (contentContainer) {
        contentContainer.style.opacity = '0.5';
        contentContainer.style.pointerEvents = 'none';
    }
    
    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.html && contentContainer) {
            contentContainer.innerHTML = data.html;
            contentContainer.style.opacity = '1';
            contentContainer.style.pointerEvents = 'auto';
            document.dispatchEvent(new CustomEvent('ajaxPaginationLoaded'));
        }
        
        if (data.pagination && paginationContainer) {
            paginationContainer.innerHTML = data.pagination;
        }
        
        // Update URL without reload
        history.pushState({ page: page }, '', url);
        
        // Scroll to top of content
        contentContainer?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    })
    .catch(error => {
        console.error('Error loading page:', error);
        if (contentContainer) {
            contentContainer.style.opacity = '1';
            contentContainer.style.pointerEvents = 'auto';
        }
        alert('Terjadi kesalahan saat memuat data. Silakan refresh halaman.');
    });
}

// Handle browser back/forward buttons
window.addEventListener('popstate', function(e) {
    if (e.state && e.state.page) {
        loadPage(e.state.page);
    } else {
        location.reload();
    }
});
</script>
