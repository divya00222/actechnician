import { db } from './firebase-config.js';
import { collection, addDoc, serverTimestamp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-firestore.js";

document.addEventListener('DOMContentLoaded', () => {
    
    // Initialize Scroll Animations Framework
    AOS.init({ duration: 800, once: true, offset: 100 });

    // Dynamic Typing Text Effect
    const words = ["Installation", "Repair Specialist", "Gas Refilling", "Maintenance"];
    let i = 0, timer;
    function typingEffect() {
        let word = words[i].split("");
        var loopTyping = function() {
            if (word.length > 0) {
                document.getElementById('typing-text').innerHTML += word.shift();
            } else {
                setTimeout(deletingEffect, 2000);
                return false;
            }
            timer = setTimeout(loopTyping, 120);
        };
        loopTyping();
    }
    function deletingEffect() {
        let word = words[i].split("");
        var loopDeleting = function() {
            if (word.length > 0) {
                word.pop();
                document.getElementById('typing-text').innerHTML = word.join("");
            } else {
                if (words.length > (i + 1)) i++;
                else i = 0;
                setTimeout(typingEffect, 500);
                return false;
            }
            timer = setTimeout(loopDeleting, 60);
        };
        loopDeleting();
    }
    typingEffect();

    // Dark/Light Mode Theme Toggle Control Engine
    const themeToggleBtn = document.getElementById('theme-toggle');
    const htmlElement = document.documentElement;
    
    // Load local cache preference if present
    const cachedTheme = localStorage.getItem('theme') || 'light';
    htmlElement.setAttribute('data-bs-theme', cachedTheme);
    updateThemeIcon(cachedTheme);

    themeToggleBtn.addEventListener('click', () => {
        const currentTheme = htmlElement.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        htmlElement.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeIcon(newTheme);
    });

    function updateThemeIcon(theme) {
        const icon = themeToggleBtn.querySelector('i');
        if (theme === 'dark') {
            icon.className = 'fas fa-sun';
        } else {
            icon.className = 'fas fa-moon';
        }
    }

    // Live Availability Zip Code Checker Engine
    const allowedZipCodes = ["10001", "10002", "10003", "10004", "20001", "90210"];
    const checkZipBtn = document.getElementById('check-zip-btn');
    const zipInput = document.getElementById('zip-input');
    const zipResult = document.getElementById('zip-result');

    checkZipBtn.addEventListener('click', () => {
        const val = zipInput.value.trim();
        if(!val) { zipResult.innerText = "Please enter a valid zip code."; return; }
        if(allowedZipCodes.includes(val)) {
            zipResult.innerHTML = "<span class='text-white'><i class='fas fa-check-circle me-1'></i> Service available! Technicians are nearby.</span>";
        } else {
            zipResult.innerHTML = "<span class='text-dark'><i class='fas fa-exclamation-triangle me-1'></i> Out of region. Call support for exceptions.</span>";
        }
    });

    // Statistics Counter Animation Matrix Engine Interlock
    const counters = document.querySelectorAll('.counter');
    const speed = 150;
    const runCounters = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = Math.ceil(target / speed);
                if (count < target) {
                    counter.innerText = count + inc;
                    setTimeout(updateCount, 15);
                } else {
                    counter.innerText = target + (target > 50 ? "+" : "");
                }
            };
            updateCount();
        });
    };

    // Trigger statistics when section scrolls into viewport bounds
    let counterTriggered = false;
    window.addEventListener('scroll', () => {
        const portfolioSec = document.getElementById('portfolio');
        if(portfolioSec) {
            const topPos = portfolioSec.getBoundingClientRect().top;
            if(topPos < window.innerHeight && !counterTriggered) {
                runCounters();
                counterTriggered = true;
            }
        }
    });

    // Portfolio Category Layout Filter System Engine
    const filterButtons = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const targetFilter = btn.getAttribute('data-filter');

            portfolioItems.forEach(item => {
                const itemCats = item.getAttribute('data-category').split(' ');
                if (targetFilter === 'all' || itemCats.includes(targetFilter)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Lightbox Modal Display System Engine
    const lightboxModal = new bootstrap.Modal(document.getElementById('lightboxModal'));
    const lightboxImg = document.getElementById('lightbox-img');
    document.querySelectorAll('.lightbox-trigger').forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            lightboxImg.setAttribute('src', trigger.getAttribute('data-src'));
            lightboxModal.show();
        });
    });

    // Interlock Booking Click Action across structural nodes
    document.querySelectorAll('.book-action').forEach(btn => {
        btn.addEventListener('click', () => {
            const svc = btn.getAttribute('data-service');
            const selectEl = document.getElementById('form-service');
            if(selectEl && svc) {
                selectEl.value = svc;
            }
        });
    });

    // Floating UI Back To Top Visibility Controls
    const bttBtn = document.getElementById('back-to-top');
    window.addEventListener('scroll', () => {
        if(window.scrollY > 400) bttBtn.classList.add('show');
        else bttBtn.classList.remove('show');
    });
    bttBtn.addEventListener('click', () => window.scrollTo({top:0, behavior:'smooth'}));

    // Online / Offline Status System Verification 
    const statusInd = document.getElementById('status-indicator');
    const statusTxt = document.getElementById('status-text');
    const setStatus = (online) => {
        if(online) {
            statusInd.className = "status-indicator online";
            statusTxt.innerText = "Connected";
            setTimeout(() => statusInd.style.display = 'none', 2000);
        } else {
            statusInd.style.display = 'inline-block';
            statusInd.className = "status-indicator offline";
            statusTxt.innerText = "Offline - Submissions Cached";
        }
    };
    window.addEventListener('online', () => setStatus(true));
    window.addEventListener('offline', () => setStatus(false));

    // Form Booking Firestore Submission Interface
    const bookingForm = document.getElementById('booking-form');
    bookingForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const submitBtn = document.getElementById('submit-booking-btn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = "<i class='fas fa-spinner fa-spin me-2'></i> Submitting Request...";

        const payload = {
            name: document.getElementById('form-name').value.trim(),
            phone: document.getElementById('form-phone').value.trim(),
            email: document.getElementById('form-email').value.trim(),
            service: document.getElementById('form-service').value,
            address: document.getElementById('form-address').value.trim(),
            message: document.getElementById('form-message').value.trim(),
            status: "Pending", // Used by administration console
            timestamp: serverTimestamp()
        };

        try {
            await addDoc(collection(db, "service_bookings"), payload);
            alert("Success! Your booking request has been locked in. Our operational specialist will call you shortly.");
            bookingForm.reset();
        } catch (error) {
            console.error("Firestore database write error sequence: ", error);
            alert("Error saving reservation sequence. Connection failure detected.");
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = "<i class='fas fa-paper-plane me-2'></i> Submit Booking Request";
        }
    });

    // Newsletter Submission Handler stub
    document.getElementById('newsletter-form').addEventListener('submit', (e) => {
        e.preventDefault();
        alert("Thank you for subscribing to AirMax optimization alerts!");
        document.getElementById('newsletter-email').value = "";
    });
});