<?php
/**
 * Orchid Cafe - Admin: Messages Inbox
 */
$page_title = "Contact Messages";
require_once 'partials/header.php';

$messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();
?>

<div class="space-y-6">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[10px] uppercase tracking-widest font-bold text-gray-400">
                        <th class="px-8 py-5">Sender</th>
                        <th class="px-8 py-5">Subject & Message</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php foreach ($messages as $msg): ?>
                    <tr class="hover:bg-gray-50 transition <?php echo $msg['status'] == 'unread' ? 'bg-purple-50/30' : ''; ?>">
                        <td class="px-8 py-6">
                            <p class="font-bold text-gray-800"><?php echo h($msg['name']); ?></p>
                            <p class="text-xs text-gray-400 font-mono"><?php echo h($msg['email']); ?></p>
                            <p class="text-[10px] text-gray-400 mt-1"><?php echo date('M d, Y h:i A', strtotime($msg['created_at'])); ?></p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-xs font-bold text-purple-600 uppercase tracking-widest mb-1"><?php echo h($msg['subject']); ?></p>
                            <p class="text-sm text-gray-600 line-clamp-2"><?php echo h($msg['message']); ?></p>
                        </td>
                        <td class="px-8 py-6 text-right space-x-2">
                            <?php if($msg['status'] == 'unread'): ?>
                                <a href="actions/message-read.php?id=<?php echo $msg['id']; ?>" class="text-[10px] font-bold text-purple-600 hover:underline uppercase tracking-widest">Mark Read</a>
                            <?php else: ?>
                                <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Read</span>
                            <?php endif; ?>
                            <button onclick="deleteMessage(<?php echo $msg['id']; ?>)" class="text-red-400 hover:text-red-600 transition ml-4"><i data-lucide="trash-2" class="w-4 h-4 inline"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($messages)): ?>
                    <tr>
                        <td colspan="3" class="px-8 py-20 text-center text-gray-400 italic">No messages in your inbox.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function deleteMessage(id) {
    if(confirm('Delete this message?')) {
        window.location.href = 'actions/message-delete.php?id=' + id;
    }
}
</script>

<?php require_once 'partials/footer.php'; ?>
