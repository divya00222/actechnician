<?php
/**
 * Orchid Cafe - Admin: Event Inquiries
 */
$page_title = "Event Inquiries";
require_once 'partials/header.php';

$inquiries = $pdo->query("SELECT * FROM event_inquiries ORDER BY created_at DESC")->fetchAll();
?>

<div class="space-y-6">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[10px] uppercase tracking-widest font-bold text-gray-400">
                        <th class="px-8 py-5">Client Info</th>
                        <th class="px-8 py-5">Event Details</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php foreach ($inquiries as $iq): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-8 py-6">
                            <p class="font-bold text-gray-800"><?php echo h($iq['name']); ?></p>
                            <p class="text-xs text-gray-500"><?php echo h($iq['phone']); ?></p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-semibold text-gray-700"><?php echo h(ucwords($iq['event_type'])); ?></p>
                            <div class="flex items-center gap-3 text-xs text-gray-400 mt-1">
                                <span><i data-lucide="calendar" class="w-3 h-3 inline"></i> <?php echo date('M d, Y', strtotime($iq['event_date'])); ?></span>
                                <span><i data-lucide="users" class="w-3 h-3 inline"></i> <?php echo $iq['guest_count']; ?> pax</span>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest <?php echo $iq['status'] == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700'; ?>">
                                <?php echo h($iq['status']); ?>
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right space-x-2">
                            <button onclick="viewEvent(<?php echo htmlspecialchars(json_encode($iq)); ?>)" class="text-xs font-bold text-purple-600 hover:underline uppercase tracking-widest">Review</button>
                            <button onclick="deleteEvent(<?php echo $iq['id']; ?>)" class="text-red-400 hover:text-red-600 transition"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($inquiries)): ?>
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center text-gray-400 italic">No event inquiries yet.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Event Detail Modal -->
<div id="event-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h4 class="font-bold text-gray-800">Event Inquiry Details</h4>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600"><i data-lucide="x" class="w-5 h-5"></i></button>
        </div>
        <form action="actions/event-status.php" method="POST" class="p-8 space-y-6">
            <input type="hidden" name="id" id="modal-id">
            
            <div class="bg-purple-50 p-4 rounded-2xl space-y-2">
                <p class="text-[10px] font-bold text-purple-400 uppercase tracking-widest">Inquiry Message</p>
                <p class="text-sm text-purple-900 leading-relaxed italic" id="modal-details"></p>
            </div>

            <div class="space-y-4">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Update Status</label>
                    <select name="status" id="modal-status" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                        <option value="pending">Pending</option>
                        <option value="reviewed">Reviewed</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Admin Notes</label>
                    <textarea name="admin_note" id="modal-note" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="Add follow-up notes..."></textarea>
                </div>
            </div>

            <button type="submit" class="w-full bg-purple-600 text-white py-4 rounded-xl font-bold hover:bg-purple-700 transition">Update Inquiry</button>
        </form>
    </div>
</div>

<script>
function viewEvent(iq) {
    document.getElementById('modal-id').value = iq.id;
    document.getElementById('modal-details').innerText = iq.details || 'No additional details provided.';
    document.getElementById('modal-status').value = iq.status;
    document.getElementById('modal-note').value = iq.admin_note || '';
    document.getElementById('event-modal').classList.remove('hidden');
    lucide.createIcons();
}

function closeModal() {
    document.getElementById('event-modal').classList.add('hidden');
}

function deleteEvent(id) {
    if(confirm('Delete this inquiry?')) {
        window.location.href = 'actions/event-delete.php?id=' + id;
    }
}
</script>

<?php require_once 'partials/footer.php'; ?>
