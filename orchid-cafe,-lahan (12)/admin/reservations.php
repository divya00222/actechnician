<?php
/**
 * Orchid Cafe - Admin: Reservations Management
 */
$page_title = "Reservations";
require_once 'partials/header.php';

// Filter logic
$status_filter = $_GET['status'] ?? '';
$date_filter = $_GET['date'] ?? '';

$query = "SELECT * FROM reservations WHERE 1=1";
$params = [];

if ($status_filter) {
    $query .= " AND status = ?";
    $params[] = $status_filter;
}
if ($date_filter) {
    $query .= " AND reservation_date = ?";
    $params[] = $date_filter;
}

$query .= " ORDER BY reservation_date DESC, reservation_time DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$reservations = $stmt->fetchAll();
?>

<div class="space-y-6">
    <!-- Filters -->
    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-wrap items-end gap-4">
        <form method="GET" class="flex flex-wrap items-end gap-4 flex-1">
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</label>
                <select name="status" class="px-4 py-2 rounded-xl border border-gray-200 bg-gray-50 outline-none focus:border-purple-600 text-sm">
                    <option value="">All Statuses</option>
                    <option value="pending" <?php echo $status_filter == 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="confirmed" <?php echo $status_filter == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                    <option value="cancelled" <?php echo $status_filter == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                    <option value="completed" <?php echo $status_filter == 'completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Date</label>
                <input type="date" name="date" value="<?php echo $date_filter; ?>" class="px-4 py-2 rounded-xl border border-gray-200 bg-gray-50 outline-none focus:border-purple-600 text-sm">
            </div>
            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-purple-700 transition">Filter</button>
            <?php if($status_filter || $date_filter): ?>
                <a href="reservations.php" class="text-xs text-gray-400 hover:text-purple-600 font-bold uppercase tracking-widest">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Reservations Table -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[10px] uppercase tracking-widest font-bold text-gray-400">
                        <th class="px-8 py-5">Guest Info</th>
                        <th class="px-8 py-5">Booking Details</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php foreach ($reservations as $res): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-8 py-6">
                            <p class="font-bold text-gray-800"><?php echo h($res['name']); ?></p>
                            <p class="text-xs text-gray-500"><?php echo h($res['email']); ?></p>
                            <p class="text-xs text-gray-400"><?php echo h($res['phone']); ?></p>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                                <i data-lucide="calendar" class="w-4 h-4 text-gray-400"></i>
                                <?php echo date('M d, Y', strtotime($res['reservation_date'])); ?>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-500 mt-1">
                                <i data-lucide="clock" class="w-4 h-4 text-gray-300"></i>
                                <?php echo date('h:i A', strtotime($res['reservation_time'])); ?>
                                <span class="mx-2 text-gray-200">|</span>
                                <i data-lucide="users" class="w-4 h-4 text-gray-300"></i>
                                <?php echo $res['guests']; ?> Guests
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <?php 
                            $status_classes = [
                                'pending' => 'bg-amber-100 text-amber-700',
                                'confirmed' => 'bg-green-100 text-green-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                                'completed' => 'bg-blue-100 text-blue-700'
                            ];
                            $cls = $status_classes[$res['status']] ?? 'bg-gray-100 text-gray-600';
                            ?>
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest <?php echo $cls; ?>">
                                <?php echo h($res['status']); ?>
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <button onclick="viewReservation(<?php echo htmlspecialchars(json_encode($res)); ?>)" class="text-xs font-bold text-purple-600 hover:underline uppercase tracking-widest">Manage</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($reservations)): ?>
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center text-gray-400 italic">No reservations found for current criteria.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Reservation Modal -->
<div id="res-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h4 class="font-bold text-gray-800">Reservation Details</h4>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600"><i data-lucide="x" class="w-5 h-5"></i></button>
        </div>
        <form action="actions/reservation-status.php" method="POST" class="p-8 space-y-6">
            <input type="hidden" name="id" id="modal-id">
            
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Guest Name</p>
                    <p class="font-bold" id="modal-name"></p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Occasion</p>
                    <p id="modal-occasion"></p>
                </div>
                <div class="col-span-2">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Special Requests</p>
                    <p class="text-gray-600 italic bg-gray-50 p-3 rounded-xl" id="modal-requests"></p>
                </div>
            </div>

            <div class="space-y-4 pt-4 border-t border-gray-100">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Update Status</label>
                    <select name="status" id="modal-status" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Admin Note (Private)</label>
                    <textarea name="admin_note" id="modal-note" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="e.g. Table 4 assigned, requested window seat..."></textarea>
                </div>
            </div>

            <button type="submit" class="w-full bg-purple-600 text-white py-4 rounded-xl font-bold hover:bg-purple-700 transition">Save Changes</button>
        </form>
    </div>
</div>

<script>
function viewReservation(res) {
    document.getElementById('modal-id').value = res.id;
    document.getElementById('modal-name').innerText = res.name;
    document.getElementById('modal-occasion').innerText = res.occasion || 'General';
    document.getElementById('modal-requests').innerText = res.special_requests || 'No special requests.';
    document.getElementById('modal-status').value = res.status;
    document.getElementById('modal-note').value = res.admin_note || '';
    
    document.getElementById('res-modal').classList.remove('hidden');
    lucide.createIcons();
}

function closeModal() {
    document.getElementById('res-modal').classList.add('hidden');
}
</script>

<?php require_once 'partials/footer.php'; ?>
