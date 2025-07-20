<div class="d-none d-lg-flex flex-column flex-shrink-0 p-3 font-mono"
     style="width: 280px; height: 100vh; overflow-y: auto; position: fixed; left: 0; top: 0; z-index: 1040; background-color: var(--tansam-footer-blue); color: rgb(243, 229, 171);"
    >
    <div class="header d-flex justify-center align-tems-center">
        <img src="{{ asset('tansam_logo.png') }}" alt="Logo" class="w-12 h-12 mr-2">
        <h3 class="pt-2">TANSAM CMS</h3>
    </div>
    <hr>
    <a class="px-3 py-2 nav-link text-white fw-bold mb-2 d-flex align-tems-center justify-content-between" href="{{ route('users.show') }}">
        <span><i class="bi bi-people-fill"></i>
                Users
        </span>
    </a>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-2">
            <button id="cmsAccordionBtn"
                class="btn w-100 text-start text-white px-3 py-2 fw-bold d-flex align-items-center justify-content-between"
                style="background-color: var(--tansam-footer-blue);"
                type="button" aria-expanded="false">
                <span><i class="bi bi-grid-1x2-fill me-2"></i> CMS</span>
                <i id="cmsAccordionIcon" class="bi bi-chevron-right transition-all duration-300"></i>
            </button>
            <div id="cmsAccordionContent"
                class="overflow-hidden transition-all duration-500"
                style="max-height: 0;">
                <ul class="list-unstyled ms-2 mt-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="nav-link text-white py-2">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('entrepreneurship.list') }}" class="nav-link text-white py-2">
                            <i class="bi bi-lightbulb-fill me-2"></i> Entrepreneurship
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('events.list') }}" class="nav-link text-white py-2">
                            <i class="bi bi-calendar-event-fill me-2"></i> Events
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('hackathons.list') }}" class="nav-link text-white py-2">
                            <i class="bi bi-trophy-fill me-2"></i> Hackathon Events
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('jobs.list') }}" class="nav-link text-white py-2">
                            <i class="bi bi-briefcase-fill me-2"></i> Jobs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('jobApps.show') }}" class="nav-link text-white py-2">
                            <i class="bi bi-file-pdf-fill me-2"></i> Job Applications
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mediaCategories.list') }}" class="nav-link text-white py-2">
                            <i class="bi bi-folder2-open me-2"></i> Media Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mediaItems.list') }}" class="nav-link text-white py-2">
                            <i class="bi bi-collection-play-fill me-2"></i> Media Items
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('news.list') }}" class="nav-link text-white py-2">
                            <i class="bi bi-newspaper me-2"></i> News
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sliders.list') }}" class="nav-link text-white py-2">
                            <i class="bi bi-sliders2-vertical me-2"></i> Sliders
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('workshops.list') }}" class="nav-link text-white py-2">
                            <i class="bi bi-people-fill me-2"></i> Workshops
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item mt-1">
            <a href="{{ route('courseRegs.show') }}" class="nav-link text-white py-2 px-3 fw-bold d-flex align-items-center">
                <i class="bi bi-journal-check me-2"></i> Course Registration
            </a>
        </li>
    </ul>
    <div class="mt-auto pt-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>
</div>

<script>
    const cmsBtn = document.getElementById('cmsAccordionBtn');
    const cmsContent = document.getElementById('cmsAccordionContent');
    const cmsIcon = document.getElementById('cmsAccordionIcon');

    let cmsOpen = localStorage.getItem('cmsAccordionOpen') === 'true';

    window.addEventListener('DOMContentLoaded', () => {
        if (cmsOpen) {
            cmsContent.style.transition = 'none';
            cmsContent.style.maxHeight = cmsContent.scrollHeight + "px";
            cmsIcon.classList.remove('bi-chevron-right');
            cmsIcon.classList.add('bi-chevron-down');
            setTimeout(() => {
                cmsContent.style.transition = '';
            }, 10);
        }
    });

    cmsBtn.addEventListener('click', function() {
        if (!cmsOpen) {
            cmsContent.style.maxHeight = cmsContent.scrollHeight + "px";
            cmsIcon.classList.remove('bi-chevron-right');
            cmsIcon.classList.add('bi-chevron-down');
            cmsOpen = true;
            localStorage.setItem('cmsAccordionOpen', 'true');
        } else {
            cmsContent.style.maxHeight = "0px";
            cmsIcon.classList.remove('bi-chevron-down');
            cmsIcon.classList.add('bi-chevron-right');
            cmsOpen = false;
            localStorage.setItem('cmsAccordionOpen', 'false');
        }
    });
</script>