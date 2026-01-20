
/**
 * Tutorial System Logic - Robust Version
 */
export class TutorialSystem {
    constructor(tutorials) {
        this.tutorials = tutorials;
        this.currentTutorial = null;
        this.currentStepIndex = 0;
        this.overlay = null;
        this.popup = null;
        
        // Bind methods to this
        this.prevStep = this.prevStep.bind(this);
        this.nextStep = this.nextStep.bind(this);
        this.skipTutorial = this.skipTutorial.bind(this);
        this.finishTutorial = this.finishTutorial.bind(this);
        
        this.init();
    }

    init() {
        console.log('Tutorial System Initializing...');
        
        // Create UI elements if they don't exist
        if (!document.getElementById('tutorial-backdrop') || !document.getElementById('tutorial-popup')) {
            this.createUI();
        }

        this.overlay = document.getElementById('tutorial-backdrop');
        this.popup = document.getElementById('tutorial-popup');
        this.highlight = document.getElementById('tutorial-highlight');
        
        // Cache DOM elements
        this.titleEl = document.getElementById('tutorial-title');
        this.descEl = document.getElementById('tutorial-desc');
        this.stepCountEl = document.getElementById('tutorial-step-count');
        this.prevBtn = document.getElementById('tutorial-prev-btn');
        this.nextBtn = document.getElementById('tutorial-next-btn');
        this.skipBtn = document.getElementById('tutorial-skip-btn');
        this.finishBtn = document.getElementById('tutorial-finish-btn');
        this.dontShowCheckbox = document.getElementById('tutorial-dont-show');

        // Bind events
        this.prevBtn.addEventListener('click', this.prevStep);
        this.nextBtn.addEventListener('click', this.nextStep);
        this.skipBtn.addEventListener('click', this.skipTutorial);
        this.finishBtn.addEventListener('click', this.finishTutorial);
        
        // Add window resize listener to update position
        window.addEventListener('resize', () => {
            if (this.currentTutorial && !this.popup.classList.contains('hidden')) {
                this.showStep(false, false);
            }
        });
        window.addEventListener('scroll', () => {
            if (this.currentTutorial && !this.popup.classList.contains('hidden')) {
                this.showStep(false, false);
            }
        }, { passive: true });

        // Check if we should start a tutorial for the current page
        setTimeout(() => this.checkAutoStart(), 500); // Slight delay to ensure DOM is ready
    }

    createUI() {
        console.log('Creating Tutorial UI...');
        const styleHtml = `
            <style id="tutorial-styles">
                @keyframes tutorialPulse {
                    0% { box-shadow: 0 0 0 0 rgba(52,152,219,0.5), 0 0 12px rgba(52,152,219,0.6); }
                    50% { box-shadow: 0 0 0 8px rgba(52,152,219,0.15), 0 0 18px rgba(52,152,219,0.8); }
                    100% { box-shadow: 0 0 0 0 rgba(52,152,219,0.5), 0 0 12px rgba(52,152,219,0.6); }
                }
                #tutorial-highlight {
                    border: 3px solid #3498db;
                    animation: tutorialPulse 1s ease-in-out infinite;
                }
                #tutorial-backdrop {
                    position: fixed;
                    inset: 0;
                    width: 100vw;
                    height: 100vh;
                    pointer-events: none;
                }
                #tutorial-popup {
                    background-color: #ffffff !important;
                    border: 1px solid rgba(254, 218, 96, 0.30) !important;
                    border-left: none !important;
                    border-radius: 28px !important;
                    box-shadow: 0 10px 32px rgba(254, 218, 96, 0.20) !important;
                    max-height: calc(100vh - 2rem);
                    overflow-y: auto;
                    pointer-events: auto;
                }
                #tutorial-progress {
                    position: relative;
                    width: 100%;
                    height: 6px;
                    background: #f3f4f6;
                    border-radius: 999px;
                    overflow: hidden;
                }
                #tutorial-progress-bar {
                    height: 100%;
                    width: 0%;
                    background: linear-gradient(90deg, #3498db, #54a3e3);
                    transition: width 300ms ease;
                }
                #tutorial-title {
                    color: #2E2E2E;
                    font-weight: 700;
                }
                #tutorial-desc {
                    color: #4F4F4F;
                }
                #tutorial-step-count {
                    background-color: #FFF0C2;
                    color: #8C6A08;
                    border-color: rgba(254, 218, 96, 0.50);
                }
                #tutorial-icon {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 28px;
                    height: 28px;
                    margin-right: 8px;
                }
                #tutorial-actions {
                    display: flex;
                    gap: 8px;
                    flex-wrap: wrap;
                }
                #tutorial-actions .btn-primary {
                    background-image: linear-gradient(135deg, #FEDA60, #F5B347) !important;
                    color: #2E2E2E !important;
                    padding: 8px 12px !important;
                    border-radius: 8px !important;
                    font-weight: 700 !important;
                    box-shadow: 0 0 12px rgba(254, 218, 96, 0.35), 0 6px 16px rgba(0,0,0,0.15) !important;
                    border: 1px solid rgba(254, 218, 96, 0.35) !important;
                }
                #tutorial-actions .btn-secondary {
                    background-color: #e5e7eb;
                    color: #111827;
                    padding: 8px 12px;
                    border-radius: 8px;
                    font-weight: 600;
                }
                #tutorial-arrow {
                    background-color: #ffffff !important;
                    border-left-color: rgba(254, 218, 96, 0.30) !important;
                    border-bottom-color: rgba(254, 218, 96, 0.30) !important;
                }
                #tutorial-popup {
                    background-color: #ffffff !important;
                    color: #111827 !important;
                }
                #tutorial-popup #tutorial-desc {
                    color: #4b5563 !important;
                }
                #tutorial-popup .tutorial-checkbox-box {
                    background-color: #ffffff !important;
                }
                #tutorial-popup .tutorial-checkbox-icon {
                    opacity: 0;
                    transition: opacity 150ms ease;
                }
                #tutorial-popup input#tutorial-dont-show:checked + .tutorial-checkbox-box {
                    background-color: #D4AF37 !important;
                    border-color: #D4AF37 !important;
                }
                #tutorial-popup input#tutorial-dont-show:checked + .tutorial-checkbox-box + .tutorial-checkbox-icon {
                    opacity: 1 !important;
                }
            </style>
        `;
        document.head.insertAdjacentHTML('beforeend', styleHtml);

        const backdropHtml = `
            <div id="tutorial-backdrop" class="fixed inset-0 hidden transition-opacity duration-500 opacity-0" style="z-index: 0;">
                <div id="tutorial-highlight" class="absolute rounded-lg transition-all duration-500 pointer-events-none box-content shadow-[0_0_0_9999px_rgba(0,0,0,0.8)]"></div>
            </div>
        `;

        const popupHtml = `
            <div id="tutorial-popup" class="fixed 
                w-[calc(100%-2rem)] left-4 right-4 bottom-4 
                md:w-[400px] md:left-auto md:right-auto md:bottom-auto
                bg-white rounded-[28px] shadow-2xl hidden 
                transition-all duration-500 opacity-0 transform scale-95 pointer-events-auto 
                border border-[#FEDA60]/30" style="z-index: 100000;">
                
                <div class="p-5 md:p-6 relative">
                    <div id="tutorial-progress" class="mb-3">
                        <div id="tutorial-progress-bar"></div>
                    </div>
                    
                    <div class="flex justify-between items-start mb-3 md:mb-4">
                        <div class="flex items-center">
                            <span id="tutorial-icon"></span>
                            <h3 id="tutorial-title" class="text-lg md:text-xl font-bold text-gray-900 leading-tight font-sans"></h3>
                        </div>
                        <span id="tutorial-step-count" class="text-[10px] md:text-xs font-bold px-2 py-1 bg-[#FFF8E1] text-[#B8860B] rounded border border-[#FFE082] tracking-wide"></span>
                    </div>
                    
                    <p id="tutorial-desc" class="text-sm md:text-base text-gray-600 mb-5 md:mb-6 leading-relaxed"></p>
                    <div id="tutorial-actions" class="mb-3"></div>
                    
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center">
                             <label class="cursor-pointer flex items-center gap-3 group select-none">
                                <div class="relative flex items-center">
                                    <input type="checkbox" id="tutorial-dont-show" class="peer sr-only" />
                                    <div class="tutorial-checkbox-box w-5 h-5 border-2 border-gray-300 rounded bg-white peer-checked:bg-[#D4AF37] peer-checked:border-[#D4AF37] transition-colors"></div>
                                    <svg class="tutorial-checkbox-icon absolute w-3 h-3 text-white left-1 top-1 opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-xs md:text-sm font-medium text-gray-500 group-hover:text-gray-800 transition-colors">Jangan tampilkan lagi</span>
                            </label>
                        </div>
                        
                        <div class="flex gap-3 justify-end pt-2 border-t border-gray-100">
                            <button id="tutorial-prev-btn" class="px-3 py-2 text-xs md:text-sm font-semibold text-gray-500 hover:text-gray-800 hover:bg-gray-50 rounded-lg transition-colors">Kembali</button>
                            <button id="tutorial-skip-btn" class="px-3 py-2 text-xs md:text-sm font-semibold text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">Lewati</button>
                            <button id="tutorial-next-btn" class="px-5 py-2 text-xs md:text-sm font-bold text-white bg-[#D4AF37] hover:bg-[#B8860B] rounded-lg shadow-md hover:shadow-lg transition-all active:scale-95 tracking-wide">Lanjut</button>
                            <button id="tutorial-finish-btn" class="px-5 py-2 text-xs md:text-sm font-bold text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-md hover:shadow-lg transition-all active:scale-95 hidden tracking-wide">Selesai</button>
                        </div>
                    </div>

                    <div id="tutorial-arrow" class="hidden md:block absolute w-4 h-4 bg-white transform rotate-45 border-l border-b border-gray-100 -z-10 shadow-sm"></div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('afterbegin', backdropHtml);
        document.body.insertAdjacentHTML('beforeend', popupHtml);
    }

    checkAutoStart() {
        const path = window.location.pathname;
        const urlParams = new URLSearchParams(window.location.search);
        
        // Allow forced reset via URL
        if (urlParams.has('reset-tutorial')) {
            console.log('Resetting all tutorials...');
            Object.keys(this.tutorials).forEach(key => {
                localStorage.removeItem(`tutorial_completed_${key}`);
                localStorage.removeItem(`tutorial_dont_show_${key}`);
                localStorage.removeItem(`tutorial_progress_${key}`);
            });
            localStorage.removeItem('tutorial_resume_key');
            localStorage.removeItem('tutorial_resume_index');
        }
        
        const resumeKey = localStorage.getItem('tutorial_resume_key');
        const resumeIndex = localStorage.getItem('tutorial_resume_index');
        if (resumeKey && this.tutorials[resumeKey]) {
            this.start(resumeKey);
            this.currentStepIndex = parseInt(resumeIndex || '0', 10);
            localStorage.removeItem('tutorial_resume_key');
            localStorage.removeItem('tutorial_resume_index');
            this.showStep();
            return;
        }
        
        // Prefer global onboarding when available and not completed
        const global = this.tutorials['onboarding'];
        if (global) {
            const isOnboardingMatch = global.routes.some(r => path === r);
            let isOnboardingCompleted = localStorage.getItem('tutorial_completed_onboarding');
            const isOnboardingDontShow = localStorage.getItem('tutorial_dont_show_onboarding');

            if (!isOnboardingCompleted) {
                if (global.nextRoute && path === global.nextRoute) {
                    localStorage.setItem('tutorial_completed_onboarding', 'true');
                    localStorage.removeItem('tutorial_progress_onboarding');
                    isOnboardingCompleted = 'true';
                }

                const rawProgress = localStorage.getItem('tutorial_progress_onboarding');
                const progressIndex = rawProgress ? parseInt(rawProgress, 10) : NaN;
                const lastIndex = Array.isArray(global.steps) ? Math.max(0, global.steps.length - 1) : 0;
                const lastStepRoute = global.steps?.[lastIndex]?.route;
                const reachedLastStep = Number.isFinite(progressIndex) && progressIndex >= lastIndex;
                const leftLastStepRoute = lastStepRoute ? path !== lastStepRoute : true;

                if (reachedLastStep && leftLastStepRoute) {
                    localStorage.setItem('tutorial_completed_onboarding', 'true');
                    localStorage.removeItem('tutorial_progress_onboarding');
                    isOnboardingCompleted = 'true';
                }
            }

            if (isOnboardingMatch && !isOnboardingCompleted && !isOnboardingDontShow) {
                console.log('Starting global onboarding');
                this.start('onboarding');
                return;
            }
        }
        
        for (const [key, tutorial] of Object.entries(this.tutorials)) {
            const isMatch = tutorial.routes.some(r => path === r);
            if (!isMatch) continue;
            const isCompleted = localStorage.getItem(`tutorial_completed_${key}`);
            const dontShow = localStorage.getItem(`tutorial_dont_show_${key}`);
            if (!isCompleted && !dontShow) {
                this.start(key);
                return;
            }
        }
    }

    start(tutorialKey) {
        this.currentTutorial = this.tutorials[tutorialKey];
        this.currentTutorialKey = tutorialKey;
        const savedProgress = localStorage.getItem(`tutorial_progress_${tutorialKey}`);
        this.currentStepIndex = savedProgress ? parseInt(savedProgress, 10) || 0 : 0;
        if (this.dontShowCheckbox) {
            this.dontShowCheckbox.checked = localStorage.getItem(`tutorial_dont_show_${tutorialKey}`) === 'true';
        }
        const path = window.location.pathname;
        const stepAtIndex = this.currentTutorial.steps[this.currentStepIndex];
        if (stepAtIndex && stepAtIndex.route && stepAtIndex.route !== path) {
            const idx = this.currentTutorial.steps.findIndex(s => !s.route || s.route === path);
            if (idx !== -1) {
                this.currentStepIndex = idx;
            }
        }
        
        // Show Overlay
        this.overlay.classList.remove('hidden');
        this.popup.classList.remove('hidden');
        
        // Trigger animation
        requestAnimationFrame(() => {
            this.overlay.classList.remove('opacity-0');
            this.popup.classList.remove('opacity-0', 'scale-95');
            this.popup.classList.add('scale-100');
        });
        
        this.showStep();
    }

    showStep(updateContent = true, shouldScrollIntoView = true) {
        if (!this.currentTutorial) return;

        const step = this.currentTutorial.steps[this.currentStepIndex];
        
        // Persist current progress index to avoid rewind between pages
        localStorage.setItem(`tutorial_progress_${this.currentTutorialKey}`, String(this.currentStepIndex));
        
        const desiredRoute = step.route;
        const currentPath = window.location.pathname;
        if (desiredRoute && currentPath !== desiredRoute) {
            const idx = this.currentTutorial.steps.findIndex(s => !s.route || s.route === currentPath);
            if (idx !== -1) {
                this.currentStepIndex = idx;
            }
        }
        // Try to find target, default to body if not found
        let targetEl = document.querySelector(step.target);
        
        if (!targetEl) {
            console.warn(`Target element '${step.target}' not found. Defaulting to center.`);
            targetEl = null;
        }

        if (updateContent) {
            // Update Text
            this.titleEl.textContent = step.title;
            this.descEl.textContent = step.description;
            this.stepCountEl.textContent = `${this.currentStepIndex + 1} / ${this.currentTutorial.steps.length}`;
            const progress = Math.round(((this.currentStepIndex + 1) / this.currentTutorial.steps.length) * 100);
            const progressBar = document.getElementById('tutorial-progress-bar');
            if (progressBar) progressBar.style.width = `${progress}%`;

            const iconEl = document.getElementById('tutorial-icon');
            if (iconEl) {
                iconEl.innerHTML = '';
                const icon = this.getIcon(step.icon);
                if (icon) {
                    iconEl.innerHTML = icon;
                }
            }

            const actionsEl = document.getElementById('tutorial-actions');
            if (actionsEl) {
                actionsEl.innerHTML = '';
                if (Array.isArray(step.actions)) {
                    step.actions.forEach(action => {
                        const btn = document.createElement('button');
                        btn.className = action.variant === 'secondary' ? 'btn-secondary' : 'btn-primary';
                        btn.textContent = action.label;
                        btn.addEventListener('click', () => {
                            if (action.href) {
                                window.location.href = action.href;
                            } else if (typeof action.onClick === 'function') {
                                action.onClick();
                            }
                        });
                        actionsEl.appendChild(btn);
                    });
                }
            }

            // Update Buttons Visibility
            this.prevBtn.style.display = this.currentStepIndex === 0 ? 'none' : 'block';
            
            if (this.currentStepIndex === this.currentTutorial.steps.length - 1) {
                // Last step logic
                if (this.currentTutorial.nextRoute) {
                    // If there is a next tutorial route, show "Next Page" button instead of "Finish"
                    this.nextBtn.textContent = 'Lanjut ke Halaman Berikutnya';
                    this.nextBtn.classList.remove('hidden');
                    this.finishBtn.classList.add('hidden');
                } else {
                    // If no next route, show Finish button
                    this.nextBtn.classList.add('hidden');
                    this.finishBtn.classList.remove('hidden');
                }
            } else {
                // Normal step
                this.nextBtn.textContent = 'Lanjut';
                this.nextBtn.classList.remove('hidden');
                this.finishBtn.classList.add('hidden');
            }
        }

        // Position Logic
        if (targetEl) {
            this.updatePosition(targetEl, step.position || 'bottom', { shouldScrollIntoView });
        } else {
            this.centerPopup();
        }
    }

    updatePosition(target, position, options = {}) {
        const { shouldScrollIntoView = true } = options;
        const rect = target.getBoundingClientRect();

        const buffer = 8;
        const inferZIndexFromClass = (el) => {
            if (!el?.classList) return null;
            for (const cls of Array.from(el.classList)) {
                const m1 = cls.match(/^z-(\d+)$/);
                if (m1) return Number.parseInt(m1[1], 10);
                const m2 = cls.match(/^z-\[(-?\d+)\]$/);
                if (m2) return Number.parseInt(m2[1], 10);
            }
            return null;
        };
        const getZIndexNumber = (el) => {
            if (!el) return null;
            const z = window.getComputedStyle(el).zIndex;
            const n = Number.parseInt(z, 10);
            if (Number.isFinite(n)) return n;
            return inferZIndexFromClass(el);
        };
        const findNavbarElement = () => {
            const candidates = [
                document.getElementById('navbar'),
                document.querySelector('nav'),
                document.querySelector('header'),
                document.querySelector('.navbar'),
                document.querySelector('.main-header'),
            ].filter(Boolean);

            let best = null;
            let bestScore = -Infinity;

            for (const el of candidates) {
                const cs = window.getComputedStyle(el);
                const pos = cs.position;
                if (!['fixed', 'sticky', 'absolute'].includes(pos)) continue;
                const r = el.getBoundingClientRect();
                if (r.height <= 0 || r.width <= 0) continue;
                if (r.bottom <= 0) continue;
                if (r.top > 200) continue;
                const z = getZIndexNumber(el);
                const zScore = typeof z === 'number' ? z : 0;
                const score = 10000 + zScore + (200 - Math.abs(r.top));
                if (score > bestScore) {
                    bestScore = score;
                    best = el;
                }
            }
            return best;
        };

        const navbarEl = findNavbarElement();
        const navbarRect = navbarEl ? navbarEl.getBoundingClientRect() : null;
        const navbarHeight = navbarRect ? Math.max(0, navbarRect.bottom) : 0;
        const navbarZ = navbarEl ? (getZIndexNumber(navbarEl) ?? 50) : 50;

        const backdropZ = Math.max(0, navbarZ - 1);
        const popupZ = Math.max(100000, navbarZ + 10);
        if (this.overlay) this.overlay.style.zIndex = String(backdropZ);
        if (this.popup) this.popup.style.zIndex = String(popupZ);

        const padding = 5;
        this.highlight.style.display = 'block';
        this.highlight.style.top = `${rect.top - padding}px`;
        this.highlight.style.left = `${rect.left - padding}px`;
        this.highlight.style.width = `${rect.width + (padding * 2)}px`;
        this.highlight.style.height = `${rect.height + (padding * 2)}px`;

        const overlapNavbar = rect.top < (navbarHeight + buffer);

        const isMobile = window.innerWidth < 768;

        if (isMobile) {
            // MOBILE: Reset inline styles so CSS classes take over (fixed bottom)
            this.popup.style.top = '';
            this.popup.style.left = '';
            this.popup.style.transform = '';
            // Ensure arrow is hidden on mobile
            const arrow = document.getElementById('tutorial-arrow');
            if(arrow) arrow.style.display = 'none';
            
            // Scroll to target so it's visible behind the overlay
            if (shouldScrollIntoView) {
                target.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return;
        }

        // DESKTOP: Floating positioning logic
        const popupRect = this.popup.getBoundingClientRect();
        const arrow = document.getElementById('tutorial-arrow');
        if(arrow) arrow.style.display = 'block'; // Ensure arrow visible on desktop

        let top, left;
        const gap = 15;
        
        // Reset Arrow classes
        arrow.className = 'hidden md:block absolute w-4 h-4 bg-white transform rotate-45 -z-10 shadow-sm border-gray-100';

        const computePosition = (pos) => {
            let t;
            let l;
            arrow.className = 'hidden md:block absolute w-4 h-4 bg-white transform rotate-45 -z-10 shadow-sm border-gray-100';

            switch (pos) {
            case 'bottom':
                t = rect.bottom + gap;
                l = rect.left + (rect.width / 2) - (popupRect.width / 2);
                arrow.classList.add('top-[-8px]', 'left-1/2', '-translate-x-1/2', 'border-t', 'border-l');
                break;
            case 'top':
                t = rect.top - popupRect.height - gap;
                l = rect.left + (rect.width / 2) - (popupRect.width / 2);
                arrow.classList.add('bottom-[-8px]', 'left-1/2', '-translate-x-1/2', 'border-b', 'border-r');
                break;
            case 'left':
                t = rect.top + (rect.height / 2) - (popupRect.height / 2);
                l = rect.left - popupRect.width - gap;
                arrow.classList.add('right-[-8px]', 'top-1/2', '-translate-y-1/2', 'border-t', 'border-r');
                break;
            case 'right':
                t = rect.top + (rect.height / 2) - (popupRect.height / 2);
                l = rect.right + gap;
                arrow.classList.add('left-[-8px]', 'top-1/2', '-translate-y-1/2', 'border-b', 'border-l');
                break;
            default: // fallback to bottom
                t = rect.bottom + gap;
                l = rect.left + (rect.width / 2) - (popupRect.width / 2);
                break;
            }
            return { top: t, left: l };
        };

        let desiredPosition = position;
        if (overlapNavbar) {
            const spaceBelow = window.innerHeight - (rect.bottom + gap);
            const spaceRight = window.innerWidth - (rect.right + gap);
            const spaceLeft = rect.left - gap;
            if (spaceBelow >= popupRect.height + buffer) desiredPosition = 'bottom';
            else if (spaceRight >= popupRect.width + buffer) desiredPosition = 'right';
            else if (spaceLeft >= popupRect.width + buffer) desiredPosition = 'left';
            else desiredPosition = 'bottom';
        }

        ({ top, left } = computePosition(desiredPosition));

        // 3. Viewport Boundary Detection (Prevent overflow)
        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;
        const sidePadding = 20;
        const verticalPadding = 20;

        // Horizontal adjustment
        if (left < sidePadding) {
            left = sidePadding;
            // Adjust arrow if popup shifted
            if (desiredPosition === 'top' || desiredPosition === 'bottom') {
                const arrowLeft = (rect.left + (rect.width / 2)) - left;
                arrow.style.left = `${arrowLeft}px`;
                arrow.classList.remove('left-1/2', '-translate-x-1/2');
            }
        } else if (left + popupRect.width > windowWidth - sidePadding) {
            left = windowWidth - popupRect.width - sidePadding;
            // Adjust arrow if popup shifted
            if (desiredPosition === 'top' || desiredPosition === 'bottom') {
                const arrowLeft = (rect.left + (rect.width / 2)) - left;
                arrow.style.left = `${arrowLeft}px`;
                arrow.classList.remove('left-1/2', '-translate-x-1/2');
            }
        } else {
             // Reset arrow inline style if centered
             arrow.style.left = '';
        }

        // Vertical adjustment
        if (top < verticalPadding) {
            // Switch to bottom if would overflow top
            top = rect.bottom + gap;
            arrow.className = 'hidden md:block absolute w-4 h-4 bg-white transform rotate-45 -z-10 shadow-sm border-gray-100 top-[-8px] left-1/2 -translate-x-1/2 border-t border-l';
        } else if (top + popupRect.height > windowHeight - verticalPadding) {
            // Switch to top if would overflow bottom
            top = rect.top - popupRect.height - gap;
            arrow.className = 'hidden md:block absolute w-4 h-4 bg-white transform rotate-45 -z-10 shadow-sm border-gray-100 bottom-[-8px] left-1/2 -translate-x-1/2 border-b border-r';
        }

        if (overlapNavbar) {
            top = Math.max(top, navbarHeight + buffer);
        }

        // Final clamp to ensure popup stays within viewport
        top = Math.max(verticalPadding, Math.min(top, windowHeight - popupRect.height - verticalPadding));
        left = Math.max(sidePadding, Math.min(left, windowWidth - popupRect.width - sidePadding));

        this.popup.style.top = `${top}px`;
        this.popup.style.left = `${left}px`;
        this.popup.style.transform = 'none'; // Remove center transform if active

        // 4. Smooth Scroll to target
        if (shouldScrollIntoView) {
            target.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    centerPopup() {
        // Hide highlight if no target
        this.highlight.style.display = 'none';

        const isMobile = window.innerWidth < 768;

        if (isMobile) {
             // Mobile: Reset to CSS defaults (fixed bottom)
             this.popup.style.top = '';
             this.popup.style.left = '';
             this.popup.style.transform = '';
        } else {
            // Desktop: Center in screen
            this.popup.style.top = '50%';
            this.popup.style.left = '50%';
            this.popup.style.transform = 'translate(-50%, -50%)';
        }
        
        // Hide arrow
        const arrow = document.getElementById('tutorial-arrow');
        if(arrow) arrow.style.display = 'none';
    }

    nextStep() {
        if (this.currentStepIndex < this.currentTutorial.steps.length - 1) {
            this.currentStepIndex++;
            localStorage.setItem(`tutorial_progress_${this.currentTutorialKey}`, String(this.currentStepIndex));
            const nextStepObj = this.currentTutorial.steps[this.currentStepIndex];
            const nextRoute = nextStepObj?.route;
            const currentPath = window.location.pathname;
            if (nextRoute && nextRoute !== currentPath) {
                localStorage.setItem('tutorial_resume_key', this.currentTutorialKey);
                localStorage.setItem('tutorial_resume_index', String(this.currentStepIndex));
                window.location.href = nextRoute;
                return;
            }
            this.showStep();
        } else if (this.currentTutorial.nextRoute) {
            // Mark current as completed so it doesn't show again on back navigation
            localStorage.setItem(`tutorial_completed_${this.currentTutorialKey}`, 'true');
            if (this.dontShowCheckbox.checked) {
                localStorage.setItem(`tutorial_dont_show_${this.currentTutorialKey}`, 'true');
            }
            localStorage.removeItem(`tutorial_progress_${this.currentTutorialKey}`);
            // Redirect to next page
            window.location.href = this.currentTutorial.nextRoute;
        }
    }

    prevStep() {
        if (this.currentStepIndex > 0) {
            this.currentStepIndex--;
            localStorage.setItem(`tutorial_progress_${this.currentTutorialKey}`, String(this.currentStepIndex));
            const prevStepObj = this.currentTutorial?.steps?.[this.currentStepIndex];
            const prevRoute = prevStepObj?.route;
            const currentPath = window.location.pathname;
            if (prevRoute && prevRoute !== currentPath) {
                localStorage.setItem('tutorial_resume_key', this.currentTutorialKey);
                localStorage.setItem('tutorial_resume_index', String(this.currentStepIndex));
                window.location.href = prevRoute;
                return;
            }
            this.showStep();
        }
    }

    skipTutorial() {
        if (this.dontShowCheckbox.checked) {
            localStorage.setItem(`tutorial_dont_show_${this.currentTutorialKey}`, 'true');
        }
        localStorage.removeItem(`tutorial_progress_${this.currentTutorialKey}`);
        this.close();
    }

    finishTutorial() {
        localStorage.setItem(`tutorial_completed_${this.currentTutorialKey}`, 'true');
        if (this.dontShowCheckbox.checked) {
            localStorage.setItem(`tutorial_dont_show_${this.currentTutorialKey}`, 'true');
        }
        localStorage.removeItem(`tutorial_progress_${this.currentTutorialKey}`);
        this.close();
    }

    resetTutorial() {
        console.log('Resetting all tutorials...');
        Object.keys(this.tutorials).forEach(key => {
            localStorage.removeItem(`tutorial_completed_${key}`);
            localStorage.removeItem(`tutorial_dont_show_${key}`);
            localStorage.removeItem(`tutorial_progress_${key}`);
        });
        localStorage.removeItem('tutorial_resume_key');
        localStorage.removeItem('tutorial_resume_index');
        this.close();
        // Optionally restart the current tutorial
        setTimeout(() => this.checkAutoStart(), 100);
    }

    close() {
        this.overlay.classList.add('opacity-0');
        this.popup.classList.add('opacity-0', 'scale-95');
        this.popup.classList.remove('scale-100');
        
        setTimeout(() => {
            this.overlay.classList.add('hidden');
            this.popup.classList.add('hidden');
        }, 500);
    }

    getIcon(key) {
        const icons = {
            home: '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#3498db]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-7 9 7v7a2 2 0 01-2 2h-4a2 2 0 01-2-2V9m-6 10H5a2 2 0 01-2-2v-5"/></svg>',
            products: '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#3498db]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-3l-2-2H9L7 5H4a2 2 0 00-2 2v6m18 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4m18 0H2"/></svg>',
            classes: '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#3498db]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422A12.083 12.083 0 0112 21.5c-2.58 0-4.974-.823-6.16-3.422L12 14z"/></svg>',
            gallery: '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#3498db]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4 4 4 8-8M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h12"/></svg>',
            contact: '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#3498db]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h18M3 10h18M7 15h10M10 20h4"/></svg>',
            login: '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#3498db]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"/></svg>'
        };
        return icons[key] || null;
    }
}
