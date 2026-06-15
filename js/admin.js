import { auth, db } from './firebase-config.js';
import { signInWithEmailAndPassword, signOut, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js";
import { collection, query, orderBy, onSnapshot, doc, deleteDoc } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-firestore.js";

document.addEventListener('DOMContentLoaded', () => {
    
    const loginForm = document.getElementById('login-form');
    const authContainer = document.getElementById('auth-container');
    const dashboardContainer = document.getElementById('dashboard-container');
    const logoutBtn = document.getElementById('logout-btn');
    const authError = document.getElementById('auth-error');
    const bookingsTableBody = document.getElementById('bookings-table-body');
    const searchBar = document.getElementById('search-bar');
    const exportCsvBtn = document.getElementById('export-csv-btn');
    const noRecordsMsg = document.getElementById('no-records-msg');

    let localBookingsCache = [];

    // Apply global UI dark matching based on root system settings
    const currentTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-bs-theme', currentTheme);
    if(currentTheme === 'dark') {
        document.querySelectorAll('.dark-card').forEach(el => el.className = el.className.replace('bg-white text-dark', 'bg-dark text-white'));
    }

    // Session Management Interface
    onAuthStateChanged(auth, (user) => {
        if (user) {
            authContainer.classList.add('d-none');
            dashboardContainer.classList.remove('d-none');
            initializeRealtimeDataStream();
        } else {
            authContainer.classList.remove('d-none');
            dashboardContainer.classList.add('d-none');
            localBookingsCache = [];
        }
    });

    // Login Form Processing Sequence
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('login-email').value.trim();
        const pass = document.getElementById('login-password').value.trim();
        const btn = document.getElementById('login-btn');

        btn.disabled = true;
        btn.innerHTML = "<i class='fas fa-circle-notch fa-spin me-2'></i> Verifying Identity...";
        authError.innerText = "";

        try {
            await signInWithEmailAndPassword(auth, email, pass);
        } catch (error) {
            console.error("Auth security exception block: ", error);
            authError.innerText = "Invalid credentials. Unauthorized administrative entity access denied.";
        } finally {
            btn.disabled = false;
            btn.innerHTML = "Sign In to Dashboard";
        }
    });

    // Terminate Session Execution Handler
    logoutBtn.addEventListener('click', async () => {
        if(confirm("Confirm system operational safe terminal logout procedure?")) {
            await signOut(auth);
        }
    });

    // Real-Time System Synchronization Link Engine
    function initializeRealtimeDataStream() {
        const q = query(collection(db, "service_bookings"), orderBy("timestamp", "desc"));
        
        onSnapshot(q, (snapshot) => {
            localBookingsCache = [];
            snapshot.forEach((doc) => {
                const data = doc.data();
                data.id = doc.id;
                localBookingsCache.push(data);
            });
            renderDashboardMetricsAndTables(localBookingsCache);
        }, (error) => {
            console.error("Realtime structural snapshot link pipeline execution error: ", error);
        });
    }

    // Metric Compilation & UI Render Array Generator Matrix 
    function renderDashboardMetricsAndTables(dataset) {
        // Calculate Metrics
        const totalBookings = dataset.length;
        let pendingCount = 0;
        const uniqueCustomersMap = new Set();
        let todayCount = 0;

        const startOfToday = new Date();
        startOfToday.setHours(0,0,0,0);

        dataset.forEach(item => {
            if(item.status === "Pending") pendingCount++;
            if(item.email) uniqueCustomersMap.add(item.email.toLowerCase());
            
            if(item.timestamp && item.timestamp.toDate) {
                const itemDate = item.timestamp.toDate();
                if(itemDate >= startOfToday) todayCount++;
            }
        });

        // Push Metrics to DOM nodes
        document.getElementById('card-total-bookings').innerText = totalBookings;
        document.getElementById('card-today-requests').innerText = todayCount;
        document.getElementById('card-total-customers').innerText = uniqueCustomersMap.size;
        document.getElementById('card-pending-requests').innerText = pendingCount;

        applyActiveSearchFiltersAndRenderRows();
    }

    // Dynamic Filter Core Array Matching Table Generation Execution
    function applyActiveSearchFiltersAndRenderRows() {
        const queryTerm = searchBar.value.toLowerCase().trim();
        bookingsTableBody.innerHTML = "";
        
        let displayCount = 0;

        localBookingsCache.forEach(item => {
            const matchesSearch = !queryTerm || 
                (item.name && item.name.toLowerCase().includes(queryTerm)) ||
                (item.phone && item.phone.toLowerCase().includes(queryTerm)) ||
                (item.service && item.service.toLowerCase().includes(queryTerm)) ||
                (item.address && item.address.toLowerCase().includes(queryTerm));

            if(matchesSearch) {
                displayCount++;
                let formattedTime = "N/A";
                if(item.timestamp && item.timestamp.toDate) {
                    const d = item.timestamp.toDate();
                    formattedTime = d.toLocaleDateString() + ' ' + d.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                }

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="small fw-semibold text-body">${formattedTime}</td>
                    <td class="fw-bold text-body">${escapeHtml(item.name)}<br><small class="text-muted fw-normal">${escapeHtml(item.email)}</small></td>
                    <td class="text-body">${escapeHtml(item.phone)}</td>
                    <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">${escapeHtml(item.service)}</span></td>
                    <td class="small text-secondary text-truncate" style="max-width: 180px;" title="${escapeHtml(item.address)}">${escapeHtml(item.address)}</td>
                    <td class="small text-secondary text-truncate" style="max-width: 150px;" title="${escapeHtml(item.message)}">${escapeHtml(item.message || '-')}</td>
                    <td><span class="badge bg-warning text-dark px-2 py-1 rounded">${item.status || 'Pending'}</span></td>
                    <td class="text-center">
                        <button class="btn btn-outline-danger btn-sm rounded-circle delete-record-btn" data-id="${item.id}" style="width:32px; height:32px;" title="Purge Record">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                `;
                bookingsTableBody.appendChild(tr);
            }
        });

        // Show/Hide missing matching documentation labels
        if(displayCount === 0) noRecordsMsg.classList.remove('d-none');
        else noRecordsMsg.classList.add('d-none');

        // Bind interactive functional dynamic deletion nodes instantly
        document.querySelectorAll('.delete-record-btn').forEach(btn => {
            btn.addEventListener('click', async () => {
                const targetId = btn.getAttribute('data-id');
                if(confirm("Warning! This will permanently remove this item from the cloud. Proceed?")) {
                    try {
                        await deleteDoc(doc(db, "service_bookings", targetId));
                    } catch(err) {
                        alert("Authorization execution failure mapping internal element destruction.");
                    }
                }
            });
        });
    }

    // Bind real-time input filter adjustments instantly
    searchBar.addEventListener('input', applyActiveSearchFiltersAndRenderRows);

    // CSV Document Processing Data String Exporter Module Framework
    exportCsvBtn.addEventListener('click', () => {
        if(localBookingsCache.length === 0) { alert("Data ledger stack empty. Operation terminated."); return; }
        
        let csvContent = "data:text/csv;charset=utf-8,";
        csvContent += "Booking ID,Timestamp,Client Name,Phone,Email,Requested Service,Site Address,Message Note,Status State\r\n";

        localBookingsCache.forEach(item => {
            let t = ""; if(item.timestamp && item.timestamp.toDate) t = item.timestamp.toDate().toISOString();
            const row = [
                item.id,
                t,
                item.name || "",
                item.phone || "",
                item.email || "",
                item.service || "",
                item.address || "",
                item.message || "",
                item.status || "Pending"
            ].map(v => `"${String(v).replace(/"/g, '""')}"`).join(",");
            csvContent += row + "\r\n";
        });

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `AirMax_System_Dataset_Export_${new Date().toISOString().slice(0,10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    // Sanitization Routine Helper
    function escapeHtml(str) {
        if(!str) return '';
        return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }
});